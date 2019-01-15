<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;


    /**
     * Class Paypal
     *
     * @package Gateway\API
     */
    class Paypal implements \JsonSerializable
    {

        /**
         * @var
         */

        public const PLUS    = "plus";
        public const EXPRESS = "express";

        private $jsonRequest;

        /**
         * Authorize constructor.
         *
         * @param Transaction $transaction
         * @param Credential $credential
         */
        public function __construct(Transaction $transaction, Credential $credential)
        {
            $transaction->setVerification($credential);
            $this->setJsonRequest($transaction);
            $transaction->getPayment()->unset("groupNumber");
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
                "paypal"       => [
                    "order"     => $transaction->getOrder(),
                    "payment"   => $transaction->getPayment(),
                    "billing"   => $transaction->getCustomer(),
                    "urlReturn" => $transaction->getUrlReturn(),
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