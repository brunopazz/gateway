<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:50
     */
    include_once("../src/gateway/API/Gateway.php");
    include_once("../src/gateway/API/Credential.php");
    include_once("../src/gateway/API/Transaction.php");
    include_once("../src/gateway/API/Order.php");
    include_once("../src/gateway/API/Payment.php");
    include_once("../src/gateway/API/Authorize.php");
    include_once("../src/gateway/API/Sale.php");
    include_once("../src/gateway/API/Customer.php");
    include_once("../src/gateway/API/Request.php");
    include_once("../src/gateway/API/Capture.php");
    include_once("../src/gateway/API/Cancel.php");
    include_once("../src/gateway/API/Report.php");
    include_once("../src/gateway/API/Card.php");
    include_once("../src/gateway/API/Acquirers.php");
    include_once("../src/gateway/API/Methods.php");
    include_once("../src/gateway/API/Brand.php");
    include_once("../src/gateway/API/Environment.php");

    use Azpay\API\Acquirers as Acquirers;
    use Azpay\API\Brand as Brand;
    use Azpay\API\Card as Card;
    use Azpay\API\Credential as Credential;
    use Azpay\API\Customer as Customer;
    use Azpay\API\Environment as Environment;
    use Azpay\API\Gateway as Gateway;
    use Azpay\API\Methods as Methods;
    use Azpay\API\Transaction as Transaction;
    use Exception as Exception;

    $credential = new Credential("1", "d41d8cd98f00b204e9800998ecf8427e", Environment::SANDBOX);
    $gateway = new Gateway($credential);


    if (isset($_GET["TransactionID"])) {
        $response = $gateway->Report($_GET["TransactionID"]);
        print " <br> ";
        print $response->getTransactionID();
        print " - REPORT RETURN- ";
        print $response->getStatus();


        if ($response->canCancel()) {

            $response = $gateway->Cancel($response->getTransactionID());
            print " <br> ";
            print $response->getTransactionID();
            print " - CANCELADO - ";
            print $response->getStatus();
        }

    } else {

        $customer = new Customer();
        $customer->setCustomerIdentity("999999999")
            ->setName("Bruno")
            ->setCpf("30212212212")
            ->setEmail("brunopaz@test.com");


        $token = new Card($credential);
        $tokencard = $token
            ->setBrand(Brand::VISA)
            ->setCardHolder("Bruno paz")
            ->setCardNumber("2223000148400010")
            ->setCardSecurityCode("123")
            ->setCardExpirationDate("202001")
            ->Customer($customer)
            ->Tokenizer();


        $transaction = new Transaction();
        $transaction->setUrlReturn("http://127.0.0.1:8989/debit.php");
        $transaction->setFraud("true");
        $transaction->Order()
            ->setReference("ss")
            ->setTotalAmount(1000);

        $transaction->Payment()
            ->setAcquirer(Acquirers::CIELO_V3)
            ->setMethod(Methods::DEBIT_CARD)
            ->setCurrency("986")
            ->setCountry("BRA")
            ->setNumberOfPayments(1)
            ->setTokenCard($tokencard)
            ->setSoftDescriptor("Bruno paz");
        $transaction->Customer($customer);


        try {
            //$response = $gateway->sale($transaction);
            $response = $gateway->authorize($transaction);
        } catch (Exception $e) {
            var_dump($e->getMessage());
            exit;
        }

        if ($response->isRedirect()) {

            $response->redirect();
            print $response->getTransactionID();
            print " - ";
            print $response->getRedirectUrl();
            print " - ";
            print $response->getStatus();


        } elseif ($response->isAuthorized()) {
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

            $response = $gateway->Cancel($response->getTransactionID());
            print " <br> ";
            print $response->getTransactionID();
            print " - CANCELADO - ";
            print $response->getStatus();
        }


        $response = $gateway->Report($response->getTransactionID());
        print " <br> ";
        print $response->getTransactionID();
        print " - REPORT - ";
        print $response->getStatus();
    }


