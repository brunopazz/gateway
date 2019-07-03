<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:50
     */

    namespace Gateway\API;

    include_once "autoload.php";

    use Exception as Exception;


    try {
        $credential = new Credential("{{mechantID}}", "{{mechantKEY}}",
            Environment::SANDBOX);
        $gateway    = new Gateway($credential);

        ### CREATE A NEW TRANSACTION
        $transaction = new Transaction();

        // Set ORDER
        $transaction->Order()
            ->setReference("ss")
            ->setTotalAmount(1000);

        // Set PAYMENT
        $transaction->Payment()
            ->setAcquirer(Acquirers::BRADESCO_SHOPFACIL);
        // SET CUSTOMER
        $transaction->Customer()
            ->setCustomerIdentity("999999999")
            ->setName("Bruno")
            ->setAddress("Rua teste de varginha")
            ->setAddress2("Apartamento 23")
            ->setPostalCode("08742350")
            ->setCity("São Paulo")
            ->setState("SP")
            ->setCountry("BRASIL")
            ->setCpf("60258170140")
            ->setEmail("brunopaz@test.com");

        // Set URL RETURN
        $transaction->setUrlReturn("http://127.0.0.1:8989/return.php");

        // PROCESS - ACTION
        $response = $gateway->OnlineTransfer($transaction);

        // REDIRECT IF NECESSARY (Debit uses)
        if ($response->isRedirect()) {
            print $response->getRedirectUrl();
            //$response->redirect();
        }

        // RESULTED
        if ($response->isAuthorized()) { // Action Authorized
            print "<br>RESULTED: " . $response->getStatus();
        } else { // Action Unauthorized
            print "<br>RESULTED:" . $response->getStatus();
        }

        // REPORT
        $response = $gateway->Report($response->getTransactionID());
        print "<br>REPORTING: " . $response->getStatus();

    } catch (Exception $e) {
        print_r($e->getMessage());
    }

