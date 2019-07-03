<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:50
     */

    namespace Gateway\API;

    use Exception as Exception;

    include_once "autoload.php";


    try {
        $credential = new Credential("{{mechantID}}", "{{mechantKEY}}",
            Environment::SANDBOX);
        $gateway    = new Gateway($credential);

        if (isset($_GET["TransactionID"])) {
            $response = $gateway->Report($_GET["TransactionID"]);
            print "<br>" . $response->getStatus();

        }

    } catch (Exception $e) {
        print_r($e->getMessage());
    }

