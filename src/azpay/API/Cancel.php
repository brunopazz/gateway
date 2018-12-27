<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Azpay\API;


    class Cancel implements \JsonSerializable
    {

        private $jsonRequest;
        private $transactionId;
        private $amount;


        public function __construct(Transaction $transaction, $transactionId, $amount = NULL)
        {
            $this->transactionId = $transactionId;
            $this->amount = $amount;
            $this->setJsonRequest($transaction);
        }


        public function setJsonRequest(Transaction $transaction)
        {

            $json["transaction-request"] = [
                "version"      => $transaction->getVersion(),
                "verification" => $transaction->getVerification(),
                "cancel"       => [
                    "transactionId" => $this->transactionId
                ]
            ];

            if (!empty($this->amount)) {
                $json["transaction-request"]["cancel"]["amount"] = $this->amount;
            }

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