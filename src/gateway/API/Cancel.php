<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 21:55
     */

    namespace Gateway\API;


    /**
     * Class Cancel
     *
     * @package Gateway\API
     */
    class Cancel implements \JsonSerializable
    {

        /**
         * @var
         */
        private $jsonRequest;
        /**
         * @var string
         */
        private $transactionId;
        /**
         * @var null
         */
        private $amount;


        /**
         * Cancel constructor.
         *
         * @param Credential $credential
         * @param string $transactionId
         * @param null $amount
         */
        public function __construct(Credential $credential, string $transactionId, $amount = NULL)
        {
            $this->transactionId = $transactionId;
            $this->amount = $amount;

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
                "cancel"       => [
                    "transactionId" => $this->transactionId
                ]
            ];

            if (!empty($this->amount)) {
                $json["transaction-request"]["cancel"]["amount"] = $this->amount;
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

        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

    }