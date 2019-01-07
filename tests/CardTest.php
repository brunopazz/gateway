<?php

    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-28
     * Time: 02:25
     */

    namespace Azpay\API;

    include_once("../src/gateway/API/Credential.php");
    include_once("../src/gateway/API/Card.php");


    use Azpay\API\Card as Card;
    use Azpay\API\Credential as Credential;
    use PHPUnit\Framework\TestCase;

    class CardTest extends TestCase
    {
        protected $card;
        protected $credential;

        public function setUp()
        {
            $this->credential = new Credential("1", "777", "sandbox");
            $this->card = new Card($this->credential);
            $this->assertEquals(1, $this->credential->getMerchantId());

        }

        public function testGetBrand()
        {

        }
    }
