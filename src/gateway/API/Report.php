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


        public function __construct(Credential $credential, $transactionId)
        {
            $this->transactionId = $transactionId;
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