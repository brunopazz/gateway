<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-28
     * Time: 01:07
     */

    namespace Azpay\API;


    abstract class Acquirers
    {
        public const CIELO_BUY_PAGE_LOJA         = 1;
        public const CIELO_BUY_PAGE_CIELO        = 2;
        public const REDE_KOMERCI_WEBSERVICE     = 3;
        public const REDE_KOMERCI_INTEGRADO      = 4;
        public const VERANCARD                   = 5;
        public const ELAVON                      = 6;
        public const PAGSEGURO                   = 7;
        public const PAYPAL_EXPRESS_CHECKOUT     = 8;
        public const PAGSEGURO_CHECKOUT_EXPRESSO = 9;
        public const BRADESCO                    = 10;
        public const ITAÚ                        = 11;
        public const BANCO_DO_BRASIL             = 12;
        public const BANCO_SANTANDER             = 13;
        public const CAIXA_BOLETO_SEM_REGISTRO   = 14;
        public const CAIXA_BOLETO_SINCO          = 15;
        public const CAIXA_BOLETO_SIGCB          = 16;
        public const HSBC                        = 17;
        public const STONE                       = 20;
        public const SNAPCARD                    = 21;
        public const GETNET                      = 22;
        public const PAGCOIN                     = 23;
        public const GLOBAL_PAYMENT              = 24;
        public const FIRSTDATA                   = 25;
        public const CIELO_V3                    = 26;
        public const REDE_E_REDE                 = 27;
        public const ADIQ                        = 28;
        public const PAYPAL_PLUS                 = 29;
        public const GETNET_V1                   = 30;

    }