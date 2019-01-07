<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-28
     * Time: 01:27
     */

    namespace Azpay\API;


    abstract class Environment
    {
        public const SANDBOX    = "SANDBOX";
        public const PRODUCTION = "PRODUCTION";
        public const DEVELOP    = "DEVELOP";
    }