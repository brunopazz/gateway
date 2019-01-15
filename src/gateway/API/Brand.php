<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-28
     * Time: 01:27
     */

    namespace Gateway\API;


    abstract class Brand
    {
        const VISA       = "visa";
        const MASTERCARD = "mastercard";
        const DINERS     = "diners";
        const DISCOVER   = "discover";
        const ELO        = "elo";
        const AMEX       = "amex";
        const AURA       = "aura";
        const JCB        = "jcb";
        const HYPERCARD  = "hypercard";
        const SOROCRED   = "sorocred";
        const CABAL      = "cabal";
        const MAESTRO    = "maestro";
        const HIPER      = "hiper";
        const CREDSYSTEM = "credsystem";
        const BANESCARD  = "banescard";
        const CREDZ      = "credz";
    }