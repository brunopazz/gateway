<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:38
     */

    namespace Azpay\API;


    /**
     * Class Gateway
     *
     * @package Azpay\API
     */
    class Gateway
    {
        /**
         * @var
         */
        public $authorize;
        /**
         * @var
         */
        public $sale;
        /**
         * @var
         */
        public $capture;
        /**
         * @var
         */
        public $cancel;
        /**
         * @var
         */
        public $report;
        /**
         * @var
         */
        public $json;
        /**
         * @var
         */
        private $version;
        /**
         * @var
         */
        private $verification;
        /**
         * @var string
         */
        private $env;
        /**
         * @var
         */
        private $response;


        /**
         * Gateway constructor.
         *
         * @param $env
         */
        public function __construct($env) { $this->env = strtoupper($env); }


        /**
         * @param Transaction $transaction
         * @return $this
         * @throws \Exception
         */
        public function Authorize(Transaction $transaction)
        {
            $authorize = new Authorize($transaction);
            $request = new Request($this->env);

            $this->response = $request->post("/v1/receiver", $authorize->toJSON());

            return $this;
        }

        /**
         * @param Transaction $transaction
         * @return $this
         * @throws \Exception
         */
        public function Sale(Transaction $transaction)
        {
            $sale = new Sale($transaction);
            $request = new Request($this->env);
            $this->response = $request->post("/v1/receiver", $sale->toJSON());

            return $this;
        }

        /**
         * @return mixed
         */
        public function getResponse()
        {
            return $this->response;
        }

        /**
         * @return false|string
         */
        public function getResponseJson()
        {
            return json_encode($this->response, JSON_PRETTY_PRINT);
        }

        /**
         * @return bool
         */
        public function isAuthorized()
        {
            if (isset($this->response["status"]) && ($this->response["status"] == 3 || $this->response["status"] == 8)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * @return mixed
         */
        public function getVersion()
        {
            return $this->version;
        }


        /**
         * @param $version
         * @return $this
         */
        public function setVersion($version)
        {
            $this->version = $version;
            return $this;
        }

        /**
         * @return Verification
         */
        public function getVerification(): Verification
        {
            return $this->verification;
        }

        /**
         * @param Verification $verification
         * @return Gateway
         */
        public function setVerification(Verification $verification): Gateway
        {
            $this->verification = $verification;
            return $this;
        }


    }