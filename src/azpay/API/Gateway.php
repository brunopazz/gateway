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

        /**
         * Gateway constructor.
         *
         * @param $env
         */
        public function __construct($env) { $this->env = $env; }


        /**
         * @param mixed $authorize
         * @return Gateway
         */
        public function Authorize(Transaction $transaction)
        {
            $this->json = new Authorize($transaction);
            return $this->json;
        }


        /**
         * @return mixed
         */
        public function getVersion()
        {
            return $this->version;
        }

        /**
         * @param mixed $version
         * @return Gateway
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