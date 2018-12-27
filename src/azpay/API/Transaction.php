<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:23
     */

    namespace Azpay\API;

    use Azpay\API\Billing as Billing;
    use Azpay\API\Order as Order;
    use Azpay\API\Payment as Payment;
    use Azpay\API\Verification as Verification;

    /**
     * Class Transaction
     *
     * @package Azpay\API
     */
    class Transaction implements \JsonSerializable
    {
        /**
         * @var
         */
        private $version;
        /**
         * @var \Azpay\API\Verification
         */
        private $verification;
        /**
         * @var
         */
        private $urlReturn;
        /**
         * @var
         */
        private $fraud;
        /**
         * @var
         */
        private $order;
        /**
         * @var
         */
        private $payment;
        /**
         * @var
         */
        private $billing;


        /**
         * Transaction constructor.
         *
         * @param $version
         * @param $merchantId
         * @param $merchantKey
         */
        public function __construct($version, $merchantId, $merchantKey)
        {
            $this->version = $version;
            $this->verification = new Verification($merchantId, $merchantKey);
            return $this;

        }

        /**
         * @param $name
         * @param $value
         * @return $this
         */
        public function __set($name, $value)
        {
            $this->$name = $value;
            return $this;
        }


        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

        /**
         * @return false|string
         */
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
         * @return \Azpay\API\Order
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
         * @return \Azpay\API\Payment
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
         * @return \Azpay\API\Billing
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