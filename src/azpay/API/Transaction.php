<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:23
     */

    namespace Azpay\API;


    class Transaction implements \JsonSerializable
    {
        private $version;
        private $verification;
        private $urlReturn;
        private $fraud;
        private $order;
        private $payment;
        private $billing;


        public function __construct($version, $merchantId, $merchantKey)
        {
            $this->version = $version;
            $this->verification = new Verification($merchantId, $merchantKey);
            return $this;

        }

        public function __set($name, $value)
        {
            $this->$name = $value;
            return $this;
        }


        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

        public function toJSON()
        {
            return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
        }

        /**
         * @return mixed
         */
        public function getOrder()
        {
            return $this->order;
        }

        /**
         * @param mixed $order
         * @return Transaction
         */
        public function Order()
        {
            $this->order = new Order();
            return $this->order;
        }

        /**
         * @return mixed
         */
        public function getPayment()
        {
            return $this->payment;
        }

        /**
         * @param mixed $payment
         * @return Transaction
         */
        public function Payment()
        {
            $this->payment = new Payment();
            return $this->payment;
        }

        /**
         * @return mixed
         */
        public function getBilling()
        {
            return $this->billing;
        }

        /**
         * @param mixed $billing
         * @return Transaction
         */
        public function Billing()
        {
            $this->billing = new Billing();
            return $this->billing;
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
         * @return Transaction
         */
        public function setVersion($version)
        {
            $this->version = $version;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getVerification()
        {
            return $this->verification;
        }

        /**
         * @param mixed $verification
         * @return Transaction
         */
        public function setVerification(Verification $verification)
        {
            $this->verification = $verification;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getUrlReturn()
        {
            return $this->urlReturn;
        }

        /**
         * @param mixed $urlReturn
         * @return Transaction
         */
        public function setUrlReturn($urlReturn)
        {
            $this->urlReturn = $urlReturn;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getFraud()
        {
            return $this->fraud;
        }

        /**
         * @param mixed $fraud
         * @return Transaction
         */
        public function setFraud($fraud)
        {
            $this->fraud = $fraud;
            return $this;
        }

    }