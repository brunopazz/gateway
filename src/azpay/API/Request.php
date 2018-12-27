<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 09/07/2018
     * Time: 05:52
     */

    namespace Azpay\API;

    use Exception;

    /**
     * Class Request
     *
     * @package Azpay\API
     */
    class Request
    {
        /**
         * Base url from api
         *
         * @var string
         */
        private $baseUrl = '';

        /**
         * Request constructor.
         *
         * @param Getnet $credentials
         */
        function __construct($env)
        {
            if ($env == "PRODUCTION") {
                $this->baseUrl = 'http://0.0.0.0:8888';
            } elseif ($env == "DEV") {
                $this->baseUrl = 'http://0.0.0.0:8888';
            } elseif ($env == "SANDBOX") {
                $this->baseUrl = 'http://0.0.0.0:8888';
            }
        }

        public function getBaseUrl()
        {
            return $this->baseUrl;
        }

        function get($url_path)
        {
            return $this->send($url_path, 'GET');
        }

        private function send($url_path, $method, $json = NULL)
        {
            $curl = curl_init($this->getFullUrl($url_path));

            $defaultCurlOptions = array(
                CURLOPT_CONNECTTIMEOUT => 60,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 60,
                CURLOPT_HTTPHEADER     => array('Content-Type: application/json; charset=utf-8'),
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => 0
            );

            if ($method == 'POST') {
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            } elseif ($method == 'PUT') {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
            }
            curl_setopt($curl, CURLOPT_ENCODING, "");
            curl_setopt_array($curl, $defaultCurlOptions);


            try {
                $response = curl_exec($curl);
            } catch (Exception $e) {
                print "ERROR";
            }


            if (isset(json_decode($response)->error)) {
                throw new Exception(json_decode($response)->error_description, 100);
            }

            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) >= 400) {
                throw new Exception($response, 100);
            }
            if (!$response) {
                print "ERROR";
                EXIT;
            }
            curl_close($curl);

            return json_decode($response, true);
        }

        private function getFullUrl($url_path)
        {
            if (stripos($url_path, $this->baseUrl, 0) === 0) {
                return $url_path;
            }

            return $this->baseUrl . $url_path;
        }

        function post($url_path, $params)
        {
            return $this->send($url_path, 'POST', $params);
        }


        function put($url_path, $params)
        {
            return $this->send($url_path, 'PUT', $params);
        }

    }
