<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:38
     */

    namespace Azpay\API;


    class Gateway
    {
        public $authorize;
        public $sale;
        public $capture;
        public $cancel;
        public $report;
        public $json;
        private $version;
        private $verification;
        private $env;
        private $response;


        public function __construct($env) { $this->env = strtoupper($env); }


        public function Authorize(Transaction $transaction)
        {
            $authorize = new Authorize($transaction);
            $request = new Request($this->env);

            $this->response = $request->post("/v1/receiver", $authorize->toJSON());

            return $this;
        }


        public function getResponse()
        {
            return $this->response;
        }

        public function getResponseJson()
        {
            return json_encode($this->response, JSON_PRETTY_PRINT);
        }

        public function isAuthorized()
        {
            if (isset($this->response["status"]) && ($this->response["status"] == 3 || $this->response["status"] == 8)) {
                return true;
            } else {
                return false;
            }
        }

        public function getVersion()
        {
            return $this->version;
        }


        public function setVersion($version)
        {
            $this->version = $version;
            return $this;
        }

        public function getVerification(): Verification
        {
            return $this->verification;
        }

        public function setVerification(Verification $verification): Gateway
        {
            $this->verification = $verification;
            return $this;
        }


    }