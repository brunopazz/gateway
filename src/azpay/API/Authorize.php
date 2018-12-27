<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Azpay\API;


    /**
     * Class Payments
     *
     * @package Azpay\API
     */
    class Authorize implements \JsonSerializable
    {

        private $jsonRequest;

        public function __construct(Transaction $transaction)
        {
            $this->setJsonRequest($transaction);
        }



        public function getJsonRequest()
        {
            return $this->jsonRequest;
        }


        public function setJsonRequest(Transaction $transaction)
        {

            $json["transaction-request"] = [
                "version"      => $transaction->getVersion(),
                "verification" => $transaction->getVerification(),
                "authorize"    => [
                    "order"     => $transaction->getOrder(),
                    "payment"   => $transaction->getPayment(),
                    "billing"   => $transaction->getBilling(),
                    "urlReturn" => $transaction->getUrlReturn(),
                    "fraud"     => $transaction->getFraud(),
                ]
            ];

            return $this->jsonRequest = $json;
        }


        public function toJSON()
        {
            return json_encode($this->jsonRequest, JSON_PRETTY_PRINT);
        }

        public function jsonSerialize()
        {
            return get_object_vars($this);
        }


    }