<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;


    /**
     * Class Payments
     *
     * @package Gateway\API
     */
    class Authorize implements \JsonSerializable
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
                "authorize"    => [
                    "order"     => $transaction->getOrder(),
                    "payment"   => $transaction->getPayment(),
                    "billing"   => $transaction->getCustomer(),
                    "urlReturn" => $transaction->getUrlReturn(),
                    "fraud"     => $transaction->getFraud(),
                    "fraudData" => $transaction->getFraudData(),
                ]
            ];

            return $this->jsonRequest = $json;
        }


        /**
         * @return false|string
         */
        public function toJSON()
        {
            return json_encode($this->removeEmptyValues($this->jsonRequest),
                JSON_PRETTY_PRINT);
        }

        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

        protected function removeEmptyValues(array &$array)
        {
            foreach ($array as $key => &$value) {
                if (is_array($value)) {
                    $value = $this->removeEmptyValues($value);
                }
                if (empty($value)) {
                    unset($array[$key]);
                }
            }

            return $array;
        }


    }