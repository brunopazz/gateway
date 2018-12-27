<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Azpay\API;


    class Report implements \JsonSerializable
    {

        private $jsonRequest;
        private $transactionId;


        public function __construct(Transaction $transaction, $transactionId)
        {
            $this->transactionId = $transactionId;
            $this->setJsonRequest($transaction);
        }


        public function setJsonRequest(Transaction $transaction)
        {

            $json["transaction-request"] = [
                "version"      => $transaction->getVersion(),
                "verification" => $transaction->getVerification(),
                "report"       => [
                    "transactionId" => $this->transactionId
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