<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-28
     * Time: 01:27
     */

    namespace Gateway\API;


    /**
     * Class Methods
     *
     * @package Gateway\API
     */
    abstract class Methods
    {
        public const CREDIT_CARD_NO_INTEREST          = 1;
        public const CREDIT_CARD_INTEREST_BY_MERCHANT = 2;
        public const CREDIT_CARD_INTEREST_BY_ISSUER   = 3;
        public const DEBIT_CARD                       = 4;
    }