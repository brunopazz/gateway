<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:23
     */

    namespace Azpay\API;

    use Azpay\API\Credential as Credential;
    use Azpay\API\Customer as Customer;
    use Azpay\API\Order as Order;
    use Azpay\API\Payment as Payment;

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
         * @var \Azpay\API\Credential
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
         * @var
         */
        private $credential;


        /**
         * Transaction constructor.
         */
        public function __construct()
        {
            $this->version = "1.0.0";
            //$this->credential = $credential;
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
         * @return \Azpay\API\Credential
         */
        public function getCredential(): \Azpay\API\Credential
        {
            return $this->credential;
        }

        /**
         * @param \Azpay\API\Credential $credential
         * @return Transaction
         */
        public function setCredential(\Azpay\API\Credential $credential): Transaction
        {
            $this->credential = $credential;
            return $this;
        }


        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            $vars = get_object_vars($this);
            $vars_clear = array_filter($vars, function ($value) {
                return NULL !== $value;
            });

            return $vars_clear;
        }

        /**
         * @return false|string
         */
        public function toJSON()
        {
            return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
        }

        /**
         * @return \Azpay\API\Order
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
         * @return \Azpay\API\Payment
         */
        public function getPayment()
        {
            return $this->payment;
        }


        /**
         * @return \Azpay\API\Payment
         * @throws \Exception
         */
        public function Payment()
        {
            $this->payment = new Payment();
            $this->payment->setAmount($this->getOrder()->getTotalAmount());
            return $this->payment;
        }

        /**
         * @return  \Azpay\API\Customer
         */
        public function getBilling()
        {
            return $this->billing;
        }


        /**
         * @param Customer $billing
         * @return $this
         */
        public function Customer(Customer $billing)
        {
            $this->billing = $billing;
            return $this;
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
        public function setVerification(Credential $verification)
        {
            $this->verification["merchantId"] = $verification->getMerchantId();
            $this->verification["merchantKey"] = $verification->getMerchantKey();
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