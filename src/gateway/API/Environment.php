<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-28
     * Time: 01:27
     */

    namespace Gateway\API;


    /**
     * Class Environment
     *
     * @package Gateway\API
     */
    abstract class Environment
    {
        /**
         *
         */
        public const SANDBOX    = "SANDBOX";
        /**
         *
         */
        public const PRODUCTION = "PRODUCTION";

        /**
         *
         */
        private const SANDBOX_URL = "https://evaluation-api.azpay.com.br";
        /**
         *
         */
        private const PRODUCTION_URL = "https://api.azpay.com.br";

        /**
         * @return string
         */
        public static function getSandboxUrl()
        {
            return self::SANDBOX_URL;
        }

        /**
         * @return string
         */
        public static function getProductionUrl()
        {
            return self::PRODUCTION_URL;
        }

    }