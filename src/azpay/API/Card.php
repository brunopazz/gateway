<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-27
     * Time: 16:51
     */

    namespace Azpay\API;


    /**
     * Class Card
     *
     * @package Azpay\API
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
         * @var Credential
         */
        private $credential;

        /**
         * Card constructor.
         *
         * @param $credential
         */
        public function __construct(Credential $credential) { $this->credential = $credential; }

        /**
         * @return bool
         * @throws \Exception
         */
        public function Tokenizer()
        {

            $request = new Request($this->credential);

            $json["transaction-request"] = [
                "version"      => "1.0.0",
                "verification" => [
                    "merchantId"  => $this->credential->getMerchantId(),
                    "merchantKey" => $this->credential->getMerchantKey()
                ],
                "tokencard"    => [
                    "flag"               => $this->getFlag(),
                    "cardHolder"         => $this->getCardHolder(),
                    "cardNumber"         => $this->getCardNumber(),
                    "cardSecurityCode"   => $this->getCardSecurityCode(),
                    "cardExpirationDate" => $this->getCardExpirationDate(),
                    "billing"            => $this->billing
                ]
            ];

            $response = $request->post("/v1/token/add", json_encode($json));

            if (isset($response["TokenCard"])) {
                return $response["TokenCard"];
            } else {
                return false;
            }
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
         * @return Card
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
         * @return Card
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
         * @return Card
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
         * @return Card
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
         * @return Card
         */
        public function setCardExpirationDate($cardExpirationDate)
        {
            $this->cardExpirationDate = $cardExpirationDate;
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
         * @param Billing $billing
         * @return $this
         */
        public function Billing(Billing $billing)
        {
            $this->billing = $billing;
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