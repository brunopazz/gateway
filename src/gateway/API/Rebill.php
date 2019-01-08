<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Azpay\API;


    /**
     * Class Rebill
     *
     * @package Azpay\API
     */
    class Rebill implements \JsonSerializable
    {

        /**
         *
         */
        public const DAILY   = 1;
        /**
         *
         */
        public const WEEKLY  = 2;
        /**
         *
         */
        public const MONTHLY = 3;
        /**
         *
         */
        public const YEARLY = 4;
        /**
         * @var
         */
        private $jsonRequest;

        /**
         * Rebill constructor.
         *
         * @param Transaction $transaction
         * @param Credential $credential
         */
        public function __construct(Transaction $transaction, Credential $credential)
        {
            $transaction->setVerification($credential);
            $this->setJsonRequest($transaction);
        }


        /**
         * @return mixed
         */
        public function getJsonRequest()
        {
            return $this->jsonRequest;
        }


        /**
         * @param Transaction $transaction
         * @return mixed
         */
        public function setJsonRequest(Transaction $transaction)
        {

            $json["transaction-request"] = [
                "version"      => $transaction->getVersion(),
                "verification" => $transaction->getVerification(),
                "rebill"       => [
                    "order"             => $transaction->getOrder(),
                    "paymentCreditCard" => [
                        "acquirer"           => $transaction->getPayment()->getAcquirer(),
                        "amount"             => $transaction->getPayment()->getAmount(),
                        "currency"           => $transaction->getPayment()->getCurrency(),
                        "country"            => $transaction->getPayment()->getCountry(),
                        "numberOfPayments"   => $transaction->getPayment()->getNumberOfPayments(),
                        "groupNumber"        => $transaction->getPayment()->getGroupNumber(),
                        "flag"               => $transaction->getPayment()->getTokenCard()->getBrand(),
                        "cardHolder"         => $transaction->getPayment()->getTokenCard()->getCardHolder(),
                        "cardNumber"         => $transaction->getPayment()->getTokenCard()->getCardNumber(),
                        "cardSecurityCode"   => $transaction->getPayment()->getTokenCard()->getCardSecurityCode(),
                        "cardExpirationDate" => $transaction->getPayment()->getTokenCard()->getCardExpirationDate(),
                        "saveCreditCard"     => "true",
                        "generateToken"      => "true",
                        "departureTax"       => "true",
                    ],
                    "billing"           => $transaction->getBilling(),
                    "urlReturn"         => $transaction->getUrlReturn(),
                ]
            ];

            return $this->jsonRequest = $json;
        }


        /**
         * @return false|string
         */
        public function toJSON()
        {
            return json_encode($this->jsonRequest, JSON_PRETTY_PRINT);
        }

        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }


    }