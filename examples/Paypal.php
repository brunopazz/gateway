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

        ### CREATE A NEW TRANSACTION
        $transaction = new Transaction();

        // Set ORDER
        $transaction->Order()
            ->setReference("ss")
            ->setTotalAmount(1000);

        // Set PAYMENT
        $transaction->Payment()
            ->setMethod(Paypal::PLUS)//plus or express
            ->setCurrency(Currency::BRAZIL_BRAZILIAN_REAL_BRL)
            ->setCountry("BRA");

        // SET CUSTOMER
        $transaction->Customer()
            ->setCustomerIdentity("999999999")
            ->setName("Bruno Paz")
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
        $response = $gateway->Paypal($transaction);

        // REDIRECT IF NECESSARY (Debit uses)
        if ($response->isRedirect()) {

            if ($transaction->getPayment()->getMethod() == "plus") {
                $response = $response->getResponse();

            } else {
                $response->redirect();

            }

        }


    } catch (Exception $e) {
        print_r($e->getMessage());
    }
?>

<style type="text/css">
    #loader-layer {
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        padding: 0;
        margin: 0;
        top: 0;
        left: 0;
        z-index: 100;
        display: none;
    }

    /* Center the loader */
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 60% !important;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        display: none;
        -webkit-border-radius: 60px !important;
        -moz-border-radius: 60px !important;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>


<div id="paypal-config"
     data-checkout="inline"
     data-checkout-url="http://paypalplussampleshopbr-sandbox-9451.ccg21.dev.paypalcorp.com/PayPalPlusSampleShop-br/checkout-now"
></div>


<form method="post" class="horizontal-form" action="?action=inline"
      id="checkout-form" onSubmit="return false;"
      data-checkout="inline">

    <div class="col-md-12">
        <div id="loader-layer"></div>
        <div id="loader"></div>
        <div class="form-group" id="psp-group">

            <div class="panel">
                <div class="panel-body">
                    <div id="pppDiv"> <!-- the div which id the merchant reaches into the clientlib configuration -->
                        <script type="text/javascript">
                            document.write("iframe is loading...");
                        </script>
                        <noscript>
                            <!-- in case the shop works without javascript and the user has really disabled it and gets to the merchant's checkout page -->
                            <iframe
                                    src="https://www.paypalobjects.com/webstatic/ppplusbr/ppplusbr.min.js/public/pages/pt_BR/nojserror.html"
                                    style="height: 400px; border: none;"></iframe>
                        </noscript>
                    </div>
                </div>
            </div>

        </div>

        <button
                type="submit"
                id="continueButton"
                onclick="ppp.doContinue(); return false;">
            SEND PAYMENT
        </button>
    </div><!-- col -->


</form>

<script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js?ver=3.1.2"></script>
<script>

    var ppp;
    var PAYPAL;
    ppp = PAYPAL.apps.PPP({

        approvalUrl: "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=<?php echo $response["
        processor"]["
        details"]["
        token"]?>",
        buttonLocation: "outside",
        preselection: "none",
        surcharging: true,
        hideAmount: false,
        placeholder: "pppDiv",
        disableContinue: "continueButton",
        enableContinue: "continueButton",

        onContinue: function (rememberedCards, payerId, token, term) {
            console.log(term);
            self.frames[0].location.href = "<?php echo $response["
            processor
            "]["
            details
            "]["
            urlExecute
            "];?>";
            console.log(JSON.stringify('Success'));
        },
        onError: function (err) {
            console.log(err);
        },
        country: "BR",
        language: "pt_BR",
        disallowRememberedCards: "true",
        rememberedCards: "true",
        collectBillingAddress: "false",
        mode: "sandbox",
        useraction: "continue",
        payerEmail: "<?php echo $transaction->getCustomer()->getEmail(); ?>",
        payerPhone: "<?php echo $transaction->getCustomer()->getPhone(); ?>",
        payerFirstName: "<?php echo $transaction->getCustomer()->getName(); ?>",
        payerLastName: "lastname",
        payerTaxId: "",
        payerTaxIdType: "",
        merchantInstallmentSelection: "0",
        merchantInstallmentSelectionOptional: "true",
        hideMxDebitCards: "true",
        iframeHeight: "400"

    });
</script>