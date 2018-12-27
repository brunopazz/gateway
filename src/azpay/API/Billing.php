<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:01
     */

    namespace Azpay\API;


    /**
     * Class Billing
     *
     * @package Azpay\API
     */
    class Billing implements \JsonSerializable
    {

        /**
         * @var
         */
        private $customerIdentity;
        /**
         * @var
         */
        private $name = "";
        /**
         * @var
         */
        private $address = "";
        /**
         * @var
         */
        private $address2 = "";
        /**
         * @var
         */
        private $city = "";
        /**
         * @var
         */
        private $state = "";
        /**
         * @var
         */
        private $postalCode = "";
        /**
         * @var
         */
        private $country = "BRA";
        /**
         * @var
         */
        private $phone = "";
        /**
         * @var
         */
        private $email = "";

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
        public function getCustomerIdentity()
        {
            return $this->customerIdentity;
        }

        /**
         * @param mixed $customerIdentity
         * @return Billing
         */
        public function setCustomerIdentity($customerIdentity)
        {
            $this->customerIdentity = $customerIdentity;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         * @return Billing
         */
        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getAddress()
        {
            return $this->address;
        }

        /**
         * @param mixed $address
         * @return Billing
         */
        public function setAddress($address)
        {
            $this->address = $address;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getAddress2()
        {
            return $this->address2;
        }

        /**
         * @param mixed $address2
         * @return Billing
         */
        public function setAddress2($address2)
        {
            $this->address2 = $address2;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCity()
        {
            return $this->city;
        }

        /**
         * @param mixed $city
         * @return Billing
         */
        public function setCity($city)
        {
            $this->city = $city;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getState()
        {
            return $this->state;
        }

        /**
         * @param mixed $state
         * @return Billing
         */
        public function setState($state)
        {
            $this->state = $state;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getPostalCode()
        {
            return $this->postalCode;
        }

        /**
         * @param mixed $postalCode
         * @return Billing
         */
        public function setPostalCode($postalCode)
        {
            $this->postalCode = $postalCode;
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
         * @return Billing
         */
        public function setCountry($country)
        {
            $this->country = $country;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getPhone()
        {
            return $this->phone;
        }

        /**
         * @param mixed $phone
         * @return Billing
         */
        public function setPhone($phone)
        {
            $this->phone = $phone;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         * @return Billing
         */
        public function setEmail($email)
        {
            $this->email = $email;
            return $this;
        }

    }