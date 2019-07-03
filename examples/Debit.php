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
            ->setAcquirer(Acquirers::GLOBAL_PAYMENT)
            ->setMethod(Methods::DEBIT_CARD)
            ->setCurrency(Currency::BRAZIL_BRAZILIAN_REAL_BRL)
            ->setCountry("BRA")
            ->setNumberOfPayments(1)
            ->setSoftDescriptor("Bruno paz")
            ->Card()
            ->setBrand(Brand::VISA)
            ->setCardHolder("Bruno paz")
            ->setCardNumber("4548810000000003")
            ->setCardSecurityCode("123")
            ->setCardExpirationDate("202001");

        // SET CUSTOMER
        $transaction->Customer()
            ->setCustomerIdentity("999999999")
            ->setName("Bruno")
            ->setCpf("30212212212")
            ->setEmail("brunopaz@test.com");

        // SET FRAUD DATA OBJECT
        $transaction->FraudData()
            ->setName("Bruno Paz")
            ->setDocument("30683882828")
            ->setEmail("brunopaz@g.com")
            ->setAddress("Rua test")
            ->setAddress2("Apartamento 23")
            ->setAddressNumber("300")
            ->setPostalCode("08742350")
            ->setCity("São Paulo")
            ->setState("SP")
            ->setCountry("BRASIL")
            ->setPhonePrefix("11")
            ->setPhoneNumber("99999-9999")
            ->setDevice("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36")
            ->setCostumerIP("192.168.0.1")
            ->setItems([
                ["productName" => "Iphone X", "quantity" => 1, "price" => "20.00"],
                ["productName" => "Iphone XL", "quantity" => 12, "price" => "1220.00"]
            ]);

        // Set URL RETURN
        $transaction->setUrlReturn("http://127.0.0.1:8989/return.php");

        // PROCESS - ACTION
        $response = $gateway->authorize($transaction);

        // REDIRECT IF NECESSARY (Debit uses)
        if ($response->isRedirect()) {
            $response->redirect();
        }

        // RESULTED
        if ($response->isAuthorized()) { // Action Authorized
            print "<br>RESULTED: " . $response->getStatus();
        } else { // Action Unauthorized
            print "<br>RESULTED:" . $response->getStatus();
        }

        // CAPTURE
        if ($response->canCapture()) {
            $response = $gateway->Capture($response->getTransactionID());
            print "<br>CAPTURED: " . $response->getStatus();
        }
        // CANCELL
        if ($response->canCancel()) {
            $response = $gateway->Cancel($response->getTransactionID());
            print "<br>CANCELED: " . $response->getStatus();
        }

        // REPORT
        $response = $gateway->Report($response->getTransactionID());
        print "<br>REPORTING: " . $response->getStatus();


    } catch (Exception $e) {
        print_r($e->getMessage());
    }

