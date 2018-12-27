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
        private $flag;
        /**
         * @var
         */
        private $cardHolder;
        /**
         * @var
         */
        private $cardNumber;
        /**
         * @var
         */
        private $cardSecurityCode;
        /**
         * @var
         */
        private $cardExpirationDate;
        /**
         * @var
         */
        private $saveCreditCard = "false";
        /**
         * @var
         */
        private $generateToken = "false";
        /**
         * @var
         */
        private $departureTax = "false";
        /**
         * @var
         */
        private $softDescriptor;
        /**
         * @var
         */
        // private $tokenCard;


        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

        /**
         * @return mixed
         */
        public function getTokenCard()
        {
            return $this->tokenCard;
        }

        /**
         * @param mixed $tokenCard
         * @return Payment
         */
        public function setTokenCard($tokenCard)
        {
            $this->tokenCard = $tokenCard;
            return $this;
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
        public function getFlag()
        {
            return $this->flag;
        }

        /**
         * @param mixed $flag
         * @return Payment
         */
        public function setFlag($flag)
        {
            $this->flag = $flag;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCardHolder()
        {
            return $this->cardHolder;
        }

        /**
         * @param mixed $cardHolder
         * @return Payment
         */
        public function setCardHolder($cardHolder)
        {
            $this->cardHolder = $cardHolder;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCardNumber()
        {
            return $this->cardNumber;
        }

        /**
         * @param mixed $cardNumber
         * @return Payment
         */
        public function setCardNumber($cardNumber)
        {
            $this->cardNumber = $cardNumber;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCardSecurityCode()
        {
            return $this->cardSecurityCode;
        }

        /**
         * @param mixed $cardSecurityCode
         * @return Payment
         */
        public function setCardSecurityCode($cardSecurityCode)
        {
            $this->cardSecurityCode = $cardSecurityCode;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCardExpirationDate()
        {
            return $this->cardExpirationDate;
        }

        /**
         * @param mixed $cardExpirationDate
         * @return Payment
         */
        public function setCardExpirationDate($cardExpirationDate)
        {
            $this->cardExpirationDate = $cardExpirationDate;
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