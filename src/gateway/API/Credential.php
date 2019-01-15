<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:20
     */

    namespace Gateway\API;

    use Exception;

    /**
     * Class Verification
     *
     * @package Gateway\API
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

        /**
         * @var
         */
        private $env;


        /**
         * Credential constructor.
         *
         * @param $merchantId
         * @param $merchantKey
         * @param $env
         * @throws Exception
         */
        public function __construct($merchantId, $merchantKey, $env)
        {

            $this->setMerchantId($merchantId);
            $this->setMerchantKey($merchantKey);
            $this->setEnv($env);

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
         * @param $merchantId
         * @return $this
         * @throws Exception
         */
        public function setMerchantId($merchantId)
        {
            if (!is_string($merchantId)) {
                throw new Exception('setMerchantId must be a string!');
            }

            if (strlen($merchantId) > 10) {
                throw new Exception('setMerchantId must be less than 11 characters');
            }

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
         * @param $merchantKey
         * @return $this
         * @throws Exception
         */
        public function setMerchantKey($merchantKey)
        {
            if (!is_string($merchantKey)) {
                throw new Exception('setMerchantKey must be a string!');
            }

            if (strlen($merchantKey) > 51) {
                throw new Exception('setMerchantKey must be less than 51 characters');
            }

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
         * @param $env
         * @return $this
         * @throws Exception
         */
        public function setEnv($env)
        {
            if ($env != "SANDBOX" &&
                $env != "PRODUCTION" &&
                $env != "DEVELOP") {
                throw new Exception('setEnv must be SANDBOX or PRODUCTION');
            }

            $this->env = $env;
            return $this;
        }

    }