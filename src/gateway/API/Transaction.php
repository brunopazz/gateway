<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:23
     */

    namespace Gateway\API;

    use Gateway\API\Credential as Credential;
    use Gateway\API\Customer as Customer;
    use Gateway\API\Fraud as Fraud;
    use Gateway\API\Order as Order;
    use Gateway\API\Payment as Payment;

    /**
     * Class Transaction
     *
     * @package Gateway\API
     */
    class Transaction implements \JsonSerializable
    {
        /**
         * @var
         */
        private $version;
        /**
         * @var \Gateway\API\Credential
         */
        private $verification;
        /**
         * @var
         */
        private $urlReturn;
        /**
         * @var
         */
        private $fraud = "true";
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
         * @var
         */
        private $fraudData;


        /**
         * Transaction constructor.
         */
        public function __construct()
        {
            $this->version = "1.0.0";
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
         * @return \Gateway\API\Credential
         */
        public function getCredential(): \Gateway\API\Credential
        {
            return $this->credential;
        }

        /**
         * @param \Gateway\API\Credential $credential
         * @return Transaction
         */
        public function setCredential(\Gateway\API\Credential $credential): Transaction
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
         * @return \Gateway\API\Order
         */
        public function getOrder()
        {
            return $this->order;
        }


        /**
         * @return \Gateway\API\Order
         */
        public function Order()
        {
            $this->order = new Order();
            return $this->order;
        }

        /**
         * @return \Gateway\API\Payment
         */
        public function getPayment()
        {
            return $this->payment;
        }


        /**
         * @return \Gateway\API\Payment
         * @throws \Exception
         */
        public function Payment()
        {
            $this->payment = new Payment();
            $this->payment->setAmount($this->getOrder()->getTotalAmount());
            return $this->payment;
        }

        /**
         * @return  \Gateway\API\Customer
         */
        public function getCustomer()
        {
            return $this->billing;
        }


        /**
         * @return \Gateway\API\Customer
         */
        public function Customer()
        {
            $this->billing = new Customer();
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
         * @return string
         */
        public function getFraud()
        {
            return $this->fraud;
        }


        /**
         * @param $fraud
         * @return $this
         */
        public function setFraud($fraud)
        {
            $this->fraud = $fraud;
            return $this;
        }

        /**
         * @return Fraud
         */
        public function getFraudData()
        {
            return $this->fraudData;
        }


        /**
         * @return \Gateway\API\Fraud
         */
        public function FraudData()
        {
            $this->fraud = "true";
            $this->fraudData = new Fraud();
            return $this->fraudData;
        }


    }