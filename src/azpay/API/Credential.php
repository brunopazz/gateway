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
    class Credential implements \JsonSerializable
    {

        /**
         * @var
         */
        private $merchantId;

        /**
         * @var
         */
        private $merchantKey;

        private $env;



        /**
         * Verification constructor.
         *
         * @param $merchantId
         * @param $merchantKey
         */
        public function __construct($merchantId, $merchantKey, $env)
        {
            $this->merchantId = $merchantId;
            $this->merchantKey = $merchantKey;
            $this->env = $env;
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
         * @return Credential
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
         * @return Credential
         */
        public function setMerchantKey($merchantKey)
        {
            $this->merchantKey = $merchantKey;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getEnv()
        {
            return strtoupper($this->env);
        }

        /**
         * @param mixed $env
         * @return Credential
         */
        public function setEnv($env)
        {
            $this->env = $env;
            return $this;
        }

    }