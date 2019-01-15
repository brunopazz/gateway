<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2019-01-08
     * Time: 19:29
     */

    namespace Gateway\API;


    /**
     * Class Tokenization
     *
     * @package Gateway\API
     */
    class Tokenization implements \JsonSerializable
    {

        /**
         * @var
         */
        private $tokenCard;


        /**
         * Tokenization constructor.
         *
         * @param Credential $credential
         * @param Card $card
         * @param Customer $customer
         * @throws \Exception
         */
        public function __construct(Credential $credential, Card $card, Customer $customer)
        {
            $request = new Request($credential);
            $json["transaction-request"] = [
                "version"      => "1.0.0",
                "verification" => [
                    "merchantId"  => $credential->getMerchantId(),
                    "merchantKey" => $credential->getMerchantKey()
                ],
                "tokencard"    => [
                    "flag"               => $card->getBrand(),
                    "cardHolder"         => $card->getCardHolder(),
                    "cardNumber"         => $card->getCardNumber(),
                    "cardSecurityCode"   => $card->getCardSecurityCode(),
                    "cardExpirationDate" => $card->getCardExpirationDate(),
                    "billing"            => $customer
                ]
            ];

            $response = $request->post("/v1/token/add", json_encode($json));

            if (isset($response["TokenCard"])) {
                $this->tokenCard = $response["TokenCard"];
            }

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
        public function getTokenCard()
        {
            return $this->tokenCard;
        }

        /**
         * @param mixed $tokenCard
         * @return Tokenization
         */
        public function setTokenCard($tokenCard)
        {
            $this->tokenCard = $tokenCard;
            return $this;
        }

    }