<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-27
     * Time: 16:51
     */

    namespace Gateway\API;

    use Exception;


    /**
     * Class Card
     *
     * @package Gateway\API
     */
    class Card implements \JsonSerializable
    {
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
        private $billing;
        /**
         * @var
         */
        private $tokenCard;



        /**
         * @return mixed
         */
        public function getBilling()
        {
            return $this->billing;
        }

        /**
         * @param mixed $billing
         */
        public function setBilling($billing): void
        {
            $this->billing = $billing;
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
         * @return Card
         */
        public function setTokenCard($tokenCard)
        {
            $this->tokenCard = (string)$tokenCard;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getBrand()
        {
            return $this->flag;
        }


        /**
         * @param $flag
         * @return $this
         * @throws Exception
         */
        public function setBrand($flag)
        {
            if (!is_string($flag)) {
                throw new Exception('setBrand must be a string!');
            }
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
         * @param $cardHolder
         * @return $this
         * @throws Exception
         */
        public function setCardHolder($cardHolder)
        {
            if (!is_string($cardHolder)) {
                throw new Exception('setCardHolder must be a string!');
            }

            if (strlen($cardHolder) >= 21) {
                throw new Exception('setCardHolder must be less than 21 characters');

            }
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
         * @param $cardNumber
         * @return $this
         * @throws Exception
         */
        public function setCardNumber($cardNumber)
        {
            if (!is_string($cardNumber)) {
                throw new Exception('setCardNumber must be a string!');
            }

            if (strlen($cardNumber) >= 19) {
                throw new Exception('setCardNumber must be less than 19 characters');
            }
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
         * @param $cardSecurityCode
         * @return $this
         * @throws Exception
         */
        public function setCardSecurityCode($cardSecurityCode)
        {
            if (!is_string($cardSecurityCode)) {
                throw new Exception('setCardSecurityCode must be a string!');
            }

            if (strlen($cardSecurityCode) > 4) {
                throw new Exception('setCardSecurityCode must be less than 4 characters');
            }

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
         * @param $cardExpirationDate
         * @return $this
         * @throws Exception
         */
        public function setCardExpirationDate($cardExpirationDate)
        {
            if (!is_string($cardExpirationDate)) {
                throw new Exception('setCardExpirationDate must be a string!');
            }

            if (strlen($cardExpirationDate) >= 7) {
                throw new Exception('setCardExpirationDate must be less than 7 characters - MMYYYY');
            }

            $this->cardExpirationDate = $cardExpirationDate;
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
         * @param Customer $customer
         * @return $this
         */
        public function Customer($customer)
        {
            $this->billing = $customer;
            return $this;
        }

        /**
         * @return false|string
         */
        public function toJSON()
        {
            return json_encode($this, JSON_PRETTY_PRINT);
        }

    }