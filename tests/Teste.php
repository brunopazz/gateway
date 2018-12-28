<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:50
     */
    include_once("../src/azpay/API/Gateway.php");
    include_once("../src/azpay/API/Credential.php");
    include_once("../src/azpay/API/Transaction.php");
    include_once("../src/azpay/API/Order.php");
    include_once("../src/azpay/API/Payment.php");
    include_once("../src/azpay/API/Authorize.php");
    include_once("../src/azpay/API/Sale.php");
    include_once("../src/azpay/API/Billing.php");
    include_once("../src/azpay/API/Request.php");
    include_once("../src/azpay/API/Capture.php");
    include_once("../src/azpay/API/Cancel.php");
    include_once("../src/azpay/API/Report.php");
    include_once("../src/azpay/API/Card.php");
    include_once("../src/azpay/API/Acquirers.php");
    include_once("../src/azpay/API/Methods.php");
    include_once("../src/azpay/API/Brand.php");

    use Azpay\API\Acquirers as Acquirers;
    use Azpay\API\Billing as Billing;
    use Azpay\API\Brand as Brand;
    use Azpay\API\Card as Card;
    use Azpay\API\Credential as Credential;
    use Azpay\API\Gateway as Gateway;
    use Azpay\API\Methods as Methods;
    use Azpay\API\Transaction as Transaction;

    $credential = new Credential("1", "d41d8cd98f00b204e9800998ecf8427e", "sandbox");
    $gateway = new Gateway($credential);

    $billing = new Billing();
    $billing->setCustomerIdentity("1")
        ->setName("Bruno")
        ->setEmail("brunopaz@test.com");


    $token = new Card($credential);
    $tokencard = $token
        ->setBrand(Brand::VISA)
        ->setCardHolder("Bruno paz")
        ->setCardNumber("4111111111111111")
        ->setCardSecurityCode("123")
        ->setCardExpirationDate("202012")
        ->Billing($billing)
        ->Tokenizer();


    $transaction = new Transaction();
    $transaction->setUrlReturn("");
    $transaction->setFraud("true");
    $transaction->Order()
        ->setReference("ss")
        ->setTotalAmount(1000);

    $transaction->Payment()
        ->setAcquirer(Acquirers::CIELO_V3)
        ->setMethod(Methods::CREDIT_CARD_NO_INTEREST)
        ->setCurrency("986")
        ->setCountry("BRA")
        ->setNumberOfPayments(1)
        ->setTokenCard($tokencard)
        ->setSoftDescriptor("Bruno paz");
    $transaction->Billing($billing);


    try {
        $response = $gateway->sale($transaction);
        //$response = $gateway->authorize($transaction);
    } catch (Exception $e) {
        var_dump($e->getMessage());
        exit;
    }


    if ($response->isAuthorized()) {
        print $response->getTransactionID();
        print " - ";
        print $response->getStatus();
    } else {
        print $response->getTransactionID();
        print " - ";
        print $response->getStatus();
    }

    if ($response->canCapture()) {

        $response = $gateway->Capture($transaction, $response->getTransactionID());
        print " <br> ";
        print $response->getTransactionID();
        print " - CAPTURADO - ";
        print $response->getStatus();
    }

    if ($response->canCancel()) {

        $response = $gateway->Cancel($transaction, $response->getTransactionID());
        print " <br> ";
        print $response->getTransactionID();
        print " - CANCELADO - ";
        print $response->getStatus();
    }


    $response = $gateway->Report($transaction, $response->getTransactionID());
    print " <br> ";
    print $response->getTransactionID();
    print " - REPORT - ";
    print $response->getStatus();

