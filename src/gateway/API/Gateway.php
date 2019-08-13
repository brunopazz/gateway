<?php
/**
 * Created by PhpStorm.
 * User: brunopaz
 * Date: 2018-12-26
 * Time: 22:38
 */

namespace Gateway\API;

/**
 * Class Gateway
 *
 * @package Gateway\API
 */
class Gateway
{
    /**
     * @var
     */
    public $json;
    /**
     * @var
     */
    private $version;
    /**
     * @var
     */
    private $verification;
    /**
     * @var Credential
     */
    private $credential;
    /**
     * @var
     */
    private $response;

    /**
     * Gateway constructor.
     *
     * @param Credential $credential
     */
    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    /**
     * @param Transaction $transaction
     *
     * @return $this
     * @throws \Exception
     */
    public function Authorize(Transaction $transaction)
    {
        $authorize = new Authorize($transaction, $this->credential);

        $token = new Tokenization($this->credential,
            $transaction->getPayment()->getCard(),
            $transaction->getCustomer());
        $transaction->getPayment()->setTokenCard($token->getTokenCard());


        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $authorize->toJSON());

        return $this;
    }

    /**
     * @param Transaction $transaction
     *
     * @return $this
     * @throws \Exception
     */
    public function Sale(Transaction $transaction)
    {
        $sale = new Sale($transaction, $this->credential);

        $token = new Tokenization($this->credential,
            $transaction->getPayment()->getCard(),
            $transaction->getCustomer());
        $transaction->getPayment()->setTokenCard($token->getTokenCard());

        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @param Transaction $transaction
     *
     * @return $this
     * @throws \Exception
     */
    public function Rebill(Transaction $transaction)
    {
        $sale = new Rebill($transaction, $this->credential);

        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @param string $transactionId
     * @param int null $amount
     *
     * @return $this
     * @throws \Exception
     */
    public function Capture(string $transactionId, int $amount = null)
    {
        $sale           = new Capture($this->credential, $transactionId,
            $amount);
        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @param string $transactionId
     * @param int null $amount
     *
     * @return $this
     * @throws \Exception
     */
    public function Cancel(string $transactionId, int $amount = null)
    {

        $sale           = new Cancel($this->credential, $transactionId,
            $amount);
        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @param string $transactionId
     *
     * @return $this
     * @throws \Exception
     */
    public function Report(string $transactionId)
    {
        $sale           = new Report($this->credential, $transactionId);
        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @param Transaction $transaction
     *
     * @return $this
     * @throws \Exception
     */
    public function Boleto(Transaction $transaction)
    {
        $sale           = new Boleto($transaction, $this->credential);
        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @param Transaction $transaction
     *
     * @return $this
     * @throws \Exception
     */
    public function OnlineTransfer(Transaction $transaction)
    {
        $sale           = new OnlineTransfer($transaction, $this->credential);
        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }


    public function Paypal(Transaction $transaction)
    {
        $sale           = new Paypal($transaction, $this->credential);
        $request        = new Request($this->credential);
        $this->response = $request->post("/v1/receiver", $sale->toJSON());

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return false|string
     */
    public function getResponseJson()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    /**
     * @return string
     */
    public function getTransactionID()
    {
        if (isset($this->response["transactionId"])) {
            return $this->response["transactionId"];
        }

        return "UNKNOWN";
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        switch ($this->response["status"]) {
            case "0":
                return "WAITING FOR PAYMENT";
            case "1":
                return "AUTHENTICATED";
            case "2":
                return "UNAUTHORIZED";
            case "3":
                return "AUTHORIZED";
            case "4":
                return "UNAUTHORIZED";
            case "5":
                return "IN CANCELLING";
            case "6":
                return "CANCELLED";
            case "7":
                return "IN CAPTURING";
            case "8":
                return "AUTHORIZED";
            case "9":
                return "UNAUTHORIZED";
            case "10":
                return "RECURRING DONE";
            case "11":
                return "BOLETO";
            case "12":
            case "56":
                return "PARTIAL CANCELLED";
        }

        return "UNKNOWN";
    }

    /**
     * @return bool
     */
    public function isAuthorized()
    {
        if (isset($this->response["status"]) && $this->response["status"] == 10) {
            if ($this->response["processor"]["payments"]["1"]["payment"]["status"] == 8) {
                return true;
            }
        }
        if (isset($this->response["status"]) && ($this->response["status"] == 3 || $this->response["status"] == 8)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        if (isset($this->response["status"]) && isset($this->response["processor"]["urlAuthentication"]) && ($this->response["status"] == 0)) {
            return true;
        } elseif (isset($this->response["processor"]["urlBoleto"])) {
            return true;
        } elseif (isset($this->response["processor"]["Boleto"]["details"]["urlBoleto"])) {
            return true;
        } elseif (isset($this->response["processor"]["Transfer"]["urlTransfer"])) {
            return true;
        } elseif (isset($this->response["processor"]["urlReturn"])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     */
    public function redirect()
    {
        header('Location: '.$this->getRedirectUrl());
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        if (isset($this->response["processor"]["urlAuthentication"])) {
            return $this->response["processor"]["urlAuthentication"];
        }

        if (isset($this->response["processor"]["Boleto"]["details"]["urlBoleto"])) {
            return $this->response["processor"]["Boleto"]["details"]["urlBoleto"];
        }

        if (isset($this->response["processor"]["urlBoleto"])) {
            return $this->response["processor"]["urlBoleto"];
        }

        if (isset($this->response["processor"]["Transfer"]["urlTransfer"])) {
            return $this->response["processor"]["Transfer"]["urlTransfer"];
        }

        if (isset($this->response["processor"]["urlReturn"])) {
            return $this->response["processor"]["urlReturn"];
        }

        return "";
    }

    /**
     * @return string
     */
    public function getBoletoUrl()
    {


        if (isset($this->response["processor"]["Boleto"]["details"]["urlBoleto"])) {
            return $this->response["processor"]["Boleto"]["details"]["urlBoleto"];
        }

        if (isset($this->response["processor"]["urlBoleto"])) {
            return $this->response["processor"]["urlBoleto"];
        }

        return "";
    }

    /**
     * @return bool
     */
    public function canCapture()
    {
        if (isset($this->response["status"]) && ($this->response["status"] == 3)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function canCancel()
    {
        if (isset($this->response["status"]) && ($this->response["status"] == 3 || $this->response["status"] == 8)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Credential
     */
    public function getVerification(): Credential
    {
        return $this->verification;
    }

    /**
     * @param Credential $verification
     *
     * @return Gateway
     */
    public function setVerification(Credential $verification): Gateway
    {
        $this->verification = $verification;

        return $this;
    }
}