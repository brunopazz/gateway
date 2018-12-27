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
    class Capture implements \JsonSerializable
    {

        /**
         * @var
         */
        private $jsonRequest;
        /**
         * @var
         */
        private $transactionId;
        /**
         * @var null
         */
        private $amount;


        /**
         * Capture constructor.
         *
         * @param Transaction $transaction
         * @param $transactionId
         * @param null $amount
         */
        public function __construct(Transaction $transaction, $transactionId, $amount = NULL)
        {
            $this->transactionId = $transactionId;
            $this->amount = $amount;
            $this->setJsonRequest($transaction);
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
                "capture"      => [
                    "transactionId" => $this->transactionId
                ]
            ];

            if (!empty($this->amount)) {
                $json["transaction-request"]["capture"]["amount"] = $this->amount;
            }

            return $this->jsonRequest = $json;
        }

        /**
         * @return false|string
         */
        public function toJSON()
        {
            return json_encode($this->jsonRequest, JSON_PRETTY_PRINT);
        }

        public function jsonSerialize()
        {
            return get_object_vars($this);
        }


    }