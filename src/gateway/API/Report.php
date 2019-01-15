<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;


    /**
     * Class Report
     *
     * @package Gateway\API
     */
    class Report implements \JsonSerializable
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
         * Report constructor.
         *
         * @param Credential $credential
         * @param $transactionId
         */
        public function __construct(Credential $credential, $transactionId)
        {
            $this->transactionId = $transactionId;
            $this->setJsonRequest($credential);
        }


        /**
         * @param Credential $credential
         * @return mixed
         */
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