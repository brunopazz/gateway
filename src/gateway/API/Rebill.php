<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;


    /**
     * Class Rebill
     *
     * @package Gateway\API
     */
    class Rebill implements \JsonSerializable
    {

        /**
         *
         */
        public const DAILY = 1;
        /**
         *
         */
        public const WEEKLY = 2;
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
                        "flag"               => $transaction->getPayment()->getCard()->getBrand(),
                        "cardHolder"         => $transaction->getPayment()->getCard()->getCardHolder(),
                        "cardNumber"         => $transaction->getPayment()->getCard()->getCardNumber(),
                        "cardSecurityCode"   => $transaction->getPayment()->getCard()->getCardSecurityCode(),
                        "cardExpirationDate" => $transaction->getPayment()->getCard()->getCardExpirationDate(),
                        "saveCreditCard"     => "true",
                        "generateToken"      => "true",
                        "departureTax"       => "true",
                    ],
                    "billing"           => $transaction->getCustomer(),
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