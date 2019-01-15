<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 09/07/2018
     * Time: 05:52
     */

    namespace Gateway\API;

    use Exception;

    /**
     * Class Request
     *
     * @package Gateway\API
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
         * @param Credential $credential
         * @throws Exception
         */
        function __construct(Credential $credential)
        {
            if ($credential->getEnv() == "PRODUCTION") {
                $this->baseUrl = Environment::getProductionUrl();
            } elseif ($credential->getEnv() == "SANDBOX") {
                $this->baseUrl = Environment::getSandboxUrl();
            } else {
                throw new Exception('Environment not set');
            }
        }

        /**
         * @return string
         */
        public function getBaseUrl()
        {
            return $this->baseUrl;
        }

        /**
         * @param $url_path
         * @return mixed
         * @throws Exception
         */
        function get($url_path)
        {
            return $this->send($url_path, 'GET');
        }

        /**
         * @param $url_path
         * @param $method
         * @param null $json
         * @return mixed
         * @throws Exception
         */
        private function send($url_path, $method, $json = NULL)
        {

            $response = "";
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
            } elseif ($method == 'GET') {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            }
            curl_setopt($curl, CURLOPT_ENCODING, "");
            curl_setopt_array($curl, $defaultCurlOptions);


            try {
                $response = curl_exec($curl);
            } catch (Exception $e) {
                print "ERROR1";
            }
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 500) {
                throw new Exception("Internal Server Error", CURLINFO_HTTP_CODE);
            }
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) >= 400) {
                throw new Exception(htmlentities(json_decode($response)->result->error->details), CURLINFO_HTTP_CODE);
            }
            if (!$response) {
                print "URL ERROR";
                EXIT;
            }
            curl_close($curl);

            return json_decode($response, true);
        }

        /**
         * @param $url_path
         * @return string
         */
        private function getFullUrl($url_path)
        {
            if (stripos($url_path, $this->baseUrl, 0) === 0) {
                return $url_path;
            }

            return $this->baseUrl . $url_path;
        }

        /**
         * @param $url_path
         * @param $params
         * @return mixed
         * @throws Exception
         */
        function post($url_path, $params)
        {
            return $this->send($url_path, 'POST', $params);
        }

        /**
         * @param $url_path
         * @param $params
         * @return mixed
         * @throws Exception
         */
        function put($url_path, $params)
        {
            return $this->send($url_path, 'PUT', $params);
        }

    }
