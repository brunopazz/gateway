<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:20
     */

    namespace Azpay\API;


    /**
     * Class Verification
     *
     * @package Azpay\API
     */
    class Verification implements \JsonSerializable
    {

        /**
         * @var
         */
        private $merchantId;

        /**
         * @var
         */
        private $merchantKey;


        /**
         * Verification constructor.
         *
         * @param $merchantId
         * @param $merchantKey
         */
        public function __construct($merchantId, $merchantKey)
        {
            $this->merchantId = $merchantId;
            $this->merchantKey = $merchantKey;
        }

        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

        /**
         * @return mixed
         */
        public function getMerchantId()
        {
            return $this->merchantId;
        }

        /**
         * @param mixed $merchantId
         * @return Verification
         */
        public function setMerchantId($merchantId)
        {
            $this->merchantId = $merchantId;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getMerchantKey()
        {
            return $this->merchantKey;
        }

        /**
         * @param mixed $merchantKey
         * @return Verification
         */
        public function setMerchantKey($merchantKey)
        {
            $this->merchantKey = $merchantKey;
            return $this;
        }

    }