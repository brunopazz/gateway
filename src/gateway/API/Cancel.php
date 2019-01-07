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


        public function __construct(Credential $credential, string $transactionId, $amount = NULL)
        {
            $this->transactionId = $transactionId;
            $this->amount = $amount;
            $this->setJsonRequest($credential);
        }


        public function setJsonRequest(Credential $credential)
        {

            $json["transaction-request"] = [
                "version"      => "1.0.0",
                "verification" => [
                    "merchantId"  => $credential->getMerchantId(),
                    "merchantKey" => $credential->getMerchantKey()
                ],
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