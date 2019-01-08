<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:50
     */
    include_once "autoload.php";

    use Azpay\API\Credential as Credential;
    use Azpay\API\Environment as Environment;
    use Azpay\API\Gateway as Gateway;

    try {
        $credential = new Credential("1", "d41d8cd98f00b204e9800998ecf8427e", Environment::SANDBOX);
        $gateway = new Gateway($credential);

        if (isset($_GET["TransactionID"])) {
            $response = $gateway->Report($_GET["TransactionID"]);
            print "<br>" . $response->getStatus();
            if ($response->canCancel()) {
                $response = $gateway->Cancel($response->getTransactionID());
                print "<br>" . $response->getStatus();
            }
        }

    } catch (Exception $e) {
        print_r($e->getMessage());
    }

