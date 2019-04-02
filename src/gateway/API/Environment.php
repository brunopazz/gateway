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
        private const SANDBOX_URL = "https://sandbox-api.gateway.tradeupgroup.com";
        /**
         *
         */
        private const PRODUCTION_URL = "https://api.gateway.tradeupgroup.com";

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
