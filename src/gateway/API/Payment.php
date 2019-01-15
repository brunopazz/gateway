<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;

    use Exception;

    /**
     * Class Payments
     *
     * @package Gateway\API
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
         * @var
         */
        private $card;
        /**
         * @var
         */
        private $expire;
        /**
         * @var
         */
        private $nrDocument;
        /**
         * @var
         */
        private $instructions;

        /**
         * @param $value
         */
        public function unset($value)
        {
            unset($this->$value);
        }

        /**
         * @return mixed
         */
        public function getExpire()
        {
            return $this->expire;
        }

        /**
         * @param mixed $expire
         * @return Payment
         */
        public function setExpire($expire)
        {
            unset($this->groupNumber);
            $this->expire = $expire;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getNrDocument()
        {
            return $this->nrDocument;
        }

        /**
         * @param mixed $nrDocument
         * @return Payment
         */
        public function setNrDocument($nrDocument)
        {
            $this->nrDocument = $nrDocument;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getInstructions()
        {
            return $this->instructions;
        }

        /**
         * @param mixed $instructions
         * @return Payment
         */
        public function setInstructions($instructions)
        {
            $this->instructions = $instructions;
            return $this;
        }

        /**
         * @return  \Gateway\API\Card
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
         * @return Card
         */
        public function Card()
        {
            $this->card = new Card();
            return $this->card;
        }


        /**
         * @return mixed
         */
        public function getCard()
        {
            return $this->card;
        }


        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            unset($this->card);
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
         * @param $acquirer
         * @return $this
         * @throws Exception
         */
        public function setAcquirer($acquirer)
        {
            if (empty($acquirer)) {
                throw new Exception('setAcquirer must be a constant!');
            }
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
         * @param $amount
         * @return $this
         * @throws Exception
         */
        public function setAmount($amount)
        {
            if (!is_integer($amount)) {
                throw new Exception('setAmount must be a integer!');
            }

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
         * @param $currency
         * @return $this
         * @throws Exception
         */
        public function setCurrency($currency)
        {
            if (!is_numeric($currency)) {
                throw new Exception('setCurrency must be a numeric!');
            }
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
         * @param $country
         * @return $this
         * @throws Exception
         */
        public function setCountry($country)
        {
            if (!is_string($country)) {
                throw new Exception('setCountry must be a string!');
            }
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
         * @param $numberOfPayments
         * @return $this
         * @throws Exception
         */
        public function setNumberOfPayments($numberOfPayments)
        {
            if (!is_integer($numberOfPayments)) {
                throw new Exception('setNumberOfPayments must be a integer!');
            }
            if ($numberOfPayments != 1 && $this->getMethod() == Methods::CREDIT_CARD_NO_INTEREST) {
                throw new Exception('setNumberOfPayments must be 1 (one) when use Methods::CREDIT_CARD_NO_INTEREST');
            }

            if ($numberOfPayments != 1 && $this->getMethod() == Methods::DEBIT_CARD) {
                throw new Exception('setNumberOfPayments must be 1 (one) when use Methods::DEBIT_CARD');
            }
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
         * @param $softDescriptor
         * @return $this
         * @throws Exception
         */
        public function setSoftDescriptor($softDescriptor)
        {
            if (!is_string($softDescriptor)) {
                throw new Exception('setSoftDescriptor must be a string!');
            }

            if (strlen($softDescriptor) >= 13) {
                throw new Exception('setSoftDescriptor must be less than 13 characters');

            }
            $this->softDescriptor = $softDescriptor;
            return $this;
        }


    }