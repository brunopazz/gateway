<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-27
     * Time: 16:51
     */

    namespace Azpay\API;

    use Exception;


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

            if (strlen($cardSecurityCode) >= 4) {
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

            if (strlen($cardExpirationDate) >= 6) {
                throw new Exception('setCardExpirationDate must be less than 6 characters - MMYYYY');
            }

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