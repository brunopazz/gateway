<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:11
     */

    namespace Gateway\API;


    /**
     * Class Fraud
     *
     * @package Gateway\API
     */
    class Fraud implements \JsonSerializable
    {
        /**
         * @var
         */
        private $operator = "";
        /**
         * @var
         */
        private $method = "";
        /**
         * @var
         */
        private $costumerIP;
        /**
         * @var
         */
        private $device;
        /**
         * @var
         */
        private $name;
        /**
         * @var
         */
        private $document;
        /**
         * @var
         */
        private $phonePrefix;
        /**
         * @var
         */
        private $phoneNumber;
        /**
         * @var
         */
        private $address;
        /**
         * @var
         */
        private $addressNumber;
        /**
         * @var
         */
        private $address2;
        /**
         * @var
         */
        private $city;
        /**
         * @var
         */
        private $state;
        /**
         * @var
         */
        private $postalCode;
        /**
         * @var
         */
        private $country;
        /**
         * @var
         */
        private $email;
        /**
         * @var
         */
        private $itens;

        /**
         * @return mixed
         */
        public function getItems()
        {
            return $this->itens;
        }


        /**
         * @param Items $itens
         * @return $this
         */
        public function setItems(array $itens)
        {
            foreach ($itens as $item) {
                $this->itens["item"][] = $item;
            }


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
        public function getOperator()
        {
            return $this->operator;
        }

        /**
         * @param mixed $operator
         * @return Fraud
         */
        public function setOperator($operator)
        {
            $this->operator = $operator;
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
         * @return Fraud
         */
        public function setMethod($method)
        {
            $this->method = $method;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getCostumerIP()
        {
            return $this->costumerIP;
        }

        /**
         * @param mixed $costumerIP
         * @return Fraud
         */
        public function setCostumerIP($costumerIP)
        {
            $this->costumerIP = $costumerIP;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getDevice()
        {
            return $this->device;
        }

        /**
         * @param mixed $device
         * @return Fraud
         */
        public function setDevice($device)
        {
            $this->device = $device;
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
         * @return Fraud
         */
        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getDocument()
        {
            return $this->document;
        }

        /**
         * @param mixed $document
         * @return Fraud
         */
        public function setDocument($document)
        {
            $this->document = $document;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getPhonePrefix()
        {
            return $this->phonePrefix;
        }

        /**
         * @param mixed $phonePrefix
         * @return Fraud
         */
        public function setPhonePrefix($phonePrefix)
        {
            $this->phonePrefix = $phonePrefix;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getPhoneNumber()
        {
            return $this->phoneNumber;
        }

        /**
         * @param mixed $phoneNumber
         * @return Fraud
         */
        public function setPhoneNumber($phoneNumber)
        {
            $this->phoneNumber = $phoneNumber;
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
         * @return Fraud
         */
        public function setAddress($address)
        {
            $this->address = $address;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getAddressNumber()
        {
            return $this->addressNumber;
        }

        /**
         * @param mixed $addressNumber
         * @return Fraud
         */
        public function setAddressNumber($addressNumber)
        {
            $this->addressNumber = $addressNumber;
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
         * @return Fraud
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
         * @return Fraud
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
         * @return Fraud
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
         * @return Fraud
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
         * @return Fraud
         */
        public function setCountry($country)
        {
            $this->country = $country;
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
         * @return Fraud
         */
        public function setEmail($email)
        {
            $this->email = $email;
            return $this;
        }

    }