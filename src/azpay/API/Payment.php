<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Azpay\API;

    /**
     * Class Payments
     *
     * @package Azpay\API
     */
    class Payment implements \JsonSerializable
    {
        /**
         * @var
         */
        private $tokenCard;
        /**
         * @var
         */
        private $acquirer;
        /**
         * @var
         */
        private $method;
        /**
         * @var
         */
        private $amount;
        /**
         * @var
         */
        private $currency;
        /**
         * @var
         */
        private $country = "BRA";
        /**
         * @var
         */
        private $numberOfPayments;
        /**
         * @var
         */
        private $groupNumber = "0";

        /**
         * @var
         */
        private $saveCreditCard;
        /**
         * @var
         */
        private $generateToken;
        /**
         * @var
         */
        private $departureTax;
        /**
         * @var
         */
        private $softDescriptor;


        /**
         * @return mixed
         */
        public function getTokenCard()
        {
            return $this->tokenCard;
        }


        public function setTokenCard($tokenCard)
        {
            $this->tokenCard = $tokenCard;
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
         * @return mixed
         */
        public function getAcquirer()
        {
            return $this->acquirer;
        }

        /**
         * @param mixed $acquirer
         * @return Payment
         */
        public function setAcquirer($acquirer)
        {
            $this->acquirer = $acquirer;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getMethod()
        {
            return $this->method;
        }

        /**
         * @param mixed $method
         * @return Payment
         */
        public function setMethod($method)
        {
            $this->method = $method;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getAmount()
        {
            return $this->amount;
        }

        /**
         * @param mixed $amount
         * @return Payment
         */
        public function setAmount($amount)
        {
            $this->amount = $amount;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCurrency()
        {
            return $this->currency;
        }

        /**
         * @param mixed $currency
         * @return Payment
         */
        public function setCurrency($currency)
        {
            $this->currency = $currency;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCountry()
        {
            return $this->country;
        }

        /**
         * @param mixed $country
         * @return Payment
         */
        public function setCountry($country)
        {
            $this->country = $country;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getNumberOfPayments()
        {
            return $this->numberOfPayments;
        }

        /**
         * @param mixed $numberOfPayments
         * @return Payment
         */
        public function setNumberOfPayments($numberOfPayments)
        {
            $this->numberOfPayments = $numberOfPayments;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getGroupNumber()
        {
            return $this->groupNumber;
        }

        /**
         * @param mixed $groupNumber
         * @return Payment
         */
        public function setGroupNumber($groupNumber)
        {
            $this->groupNumber = $groupNumber;
            return $this;
        }



        /**
         * @return mixed
         */
        public function getSaveCreditCard()
        {
            return $this->saveCreditCard;
        }

        /**
         * @param mixed $saveCreditCard
         * @return Payment
         */
        public function setSaveCreditCard($saveCreditCard)
        {
            $this->saveCreditCard = $saveCreditCard;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getGenerateToken()
        {
            return $this->generateToken;
        }

        /**
         * @param mixed $generateToken
         * @return Payment
         */
        public function setGenerateToken($generateToken)
        {
            $this->generateToken = $generateToken;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getDepartureTax()
        {
            return $this->departureTax;
        }

        /**
         * @param mixed $departureTax
         * @return Payment
         */
        public function setDepartureTax($departureTax)
        {
            $this->departureTax = $departureTax;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getSoftDescriptor()
        {
            return $this->softDescriptor;
        }

        /**
         * @param mixed $softDescriptor
         * @return Payment
         */
        public function setSoftDescriptor($softDescriptor)
        {
            $this->softDescriptor = $softDescriptor;
            return $this;
        }


    }