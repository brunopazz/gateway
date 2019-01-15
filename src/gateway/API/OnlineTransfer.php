<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;


    /**
     * Class OnlineTransfer
     *
     * @package Gateway\API
     */
    class OnlineTransfer implements \JsonSerializable
    {

        /**
         * @var
         */
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
            $transaction->getPayment()->unset("amount");
            $transaction->getPayment()->unset("country");
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
                "onlineDebit"  => [
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