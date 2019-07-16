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
    class Sale extends Authorize
    {

        /**
         * @var
         */
        private $jsonRequest;


        /**
         * @param Transaction $transaction
         * @return mixed
         */
        public function setJsonRequest(Transaction $transaction)
        {

            $json["transaction-request"] = [
                "version"      => $transaction->getVersion(),
                "verification" => $transaction->getVerification(),
                "sale"         => [
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


    }