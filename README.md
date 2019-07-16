# Gateway de Pagamento - SDK PHP

Modalidades de pagamentos:
- Cartão de crédito
- Cartão de débito
- Paypal Plus
- Paypal Express Chekout
- Pagseguro
- Boleto bancário (Bradesco Shop Fácil e Itaú Shopline)
- Transferência eletronica bancária (Itaú Shopline)

Recursos disponíveis
- Parcelamento de pagamentos
- Pagamentos agendados ( recorrências )
- Análise de antifraude
- Tokenização de cartões

---

## Cartão de crédito (Exemplo) 
```php
 namespace Gateway\API;

    include_once "autoload.php";

    use Exception as Exception;

    try {
        $credential = new Credential("{{INSERT_MERCHANT_ID}}", "{{INSERT_TOKEN}}", Environment::SANDBOX);
        $gateway = new Gateway($credential);

        ### CREATE A NEW TRANSACTION
        $transaction = new Transaction();

        // Set ORDER
        $transaction->Order()
            ->setReference("ss")
            ->setTotalAmount(1000);

        // Set PAYMENT
        $transaction->Payment()
            ->setAcquirer(Acquirers::CIELO_V3)
            ->setMethod(Methods::CREDIT_CARD_INTEREST_BY_ISSUER)
            ->setCurrency(Currency::BRAZIL_BRAZILIAN_REAL_BRL)
            ->setCountry("BRA")
            ->setNumberOfPayments(2)
            ->setSoftDescriptor("Bruno paz")
            ->Card()
                ->setBrand(Brand::VISA)
                ->setCardHolder("Bruno paz")
                ->setCardNumber("2223000148400010")
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
        #$response = $gateway->sale($transaction);
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

```
---

## Credencias de acesso

```php
$credential = new Credential("{MERCHANTID}", "{MERCHANTKEY}", Environment::SANDBOX);
```
## Autenticação

```php
$gateway = new Gateway($credential);
```

### Ambientes disponíveis

| Nome|Descrição|Constante de uso|
|---|---|---|
|TESTES| Ambiente de testes| Environment::SANDBOX|
|PRODUÇÃO| Ambiente de produção| Environment::PRODUCTION|

### Criando um nova transação de pagamento

```php
$transaction = new Transaction();
```

### Informando um pedido
- setReference é usado como referência do pedido
- setTotalAmount deve ser em centavos
```php
// Set ORDER
$transaction->Order()
            ->setReference("Pedido123")
            ->setTotalAmount(1000);
```

### Informando os dados do comprador
- setCustomerIdentity é usado como referência do comprador (Deve ser único)
```php
$transaction->Customer()
    ->setCustomerIdentity("999999999")
    ->setName("Bruno")
    ->setCpf("30212212212")
    ->setEmail("bruno@brunopaz.com");
```

### Informando a forma de pagamento
- setAcquirer define qual a operadora a ser utilizado, verifique tabela abaixo
- setMethod define qual o método de pagamento a ser processado, verifique tabela abaixo
- setNumberOfPayments define o parcelamento ( usado para Cartão de Crédito)
- setSoftDescriptor texto a ser exibido na fatura do cartão do comprador
```php

// Set PAYMENT
$transaction->Payment()
    ->setAcquirer(Acquirers::CIELO_V3)
    ->setMethod(Methods::CREDIT_CARD_INTEREST_BY_ISSUER)
    ->setCurrency(Currency::BRAZIL_BRAZILIAN_REAL_BRL)
    ->setCountry("BRA")
    ->setNumberOfPayments(2)
    ->setSoftDescriptor("Bruno paz")
    ->Card()
            ->setBrand(Brand::VISA)
            ->setCardHolder("Bruno paz")
            ->setCardNumber("2223000148400010")
            ->setCardSecurityCode("123")
            ->setCardExpirationDate("202001");
```
### Informando a URL de retorno
A URL de retorno é utlizada para receber um POST e redirecionar o usuário a após a conclusão da operaçñao de pagamento
```php
// Set URL RETURN
$transaction->setUrlReturn("http://127.0.0.1:8989/return.php");
```

## Tipos de operações financeiras
### Autorização (Pre-auth)
```php
$response = $gateway->Authorize($transaction);
```

### Venda Direta (auth)
```php
$response = $gateway->Sale($transaction);
```

### Captura (Capture)
```php
$response = $gateway->Capture("{TransactionID}");
```

### Cancelamento (Cancel | Void)
```php
$response = $gateway->sale("{TransactionID}");
```

### Tranferência Bancária (Transfer)
```php
$response = $gateway->OnlineTransfer($transaction);
```

### Boleto Bancário (Payment Bank Slip)
```php
$response = $gateway->Boleto($transaction);
```

### Paypal
```php
$response = $gateway->Paypal($transaction);
```

### Pagamento agendado ( Recorrência)
```php
$response = $gateway->Rebill($transaction);
```

### Códigos das operadoras
|Operadora|Constante|
|---|---|
|CIELO BUY PAGE LOJA|Acquirers::CIELO_BUY_PAGE_LOJA|
|CIELO BUY PAGE CIELO|Acquirers::CIELO_BUY_PAGE_CIELO|        
|CIELO V3.0 (recente)|Acquirers::CIELO_V3|                    
|REDE KOMERCI WEBSERVICE|Acquirers::REDE_KOMERCI_WEBSERVICE|     
|REDE: E-REDE (recente)|Acquirers::REDE_E_REDE|                 
|PAGSEGURO|Acquirers::PAGSEGURO|                   
|PAYPAL: EXPRESS CHECKOUT|Acquirers::PAYPAL_EXPRESS_CHECKOUT|     
|PAYPAL: PLUS|Acquirers::PAYPAL_PLUS|                 
|PAGSEGURO: CHECKOUT EXPRESSO|Acquirers::PAGSEGURO_CHECKOUT_EXPRESSO| 
|BRADESCO (deprecado)|Acquirers::BRADESCO|                    
|BRADESCO: SHOPFACIL (recente)|Acquirers::BRADESCO_SHOPFACIL|          
|ITAU: SHOPLINE|Acquirers::ITAU_SHOPLINE|               
|STONE|Acquirers::STONE|                       
|ELAVON|Acquirers::ELAVON|                      
|GETNET E-commerce|Acquirers::GETNET|                      
|GETNET V1.0 (recente)|Acquirers::GETNET_V1|                   
|GLOBAL PAYMENT|Acquirers::GLOBAL_PAYMENT|              
|FIRST DATA BIN|Acquirers::FIRSTDATA|                   
|ADIQ|Acquirers::ADIQ|
|WORLDPAY|Acquirers::WORLDPAY|      
|GRANITO|Acquirers::GRANITO|      
|SIXBANK|Acquirers::SIXBANK|                          

### Códigos das bandeiras de cartões
|Nome|Constante|
|---|---|
|VISA|Brand::VISA      |      
|MASTERCARD|Brand::MASTERCARD|
|DINERS|Brand::DINERS    |    
|DISCOVER|Brand::DISCOVER  |  
|ELO|Brand::ELO       |       
|AMEX|Brand::AMEX      |      
|AURA|Brand::AURA      |      
|JCB|Brand::JCB       |       
|HYPERCARD|Brand::HYPERCARD | 
|SOROCRED|Brand::SOROCRED  |  
|CABAL|Brand::CABAL     |     
|MAESTRO|Brand::MAESTRO   |   
|HIPER|Brand::HIPER     |     
|CREDSYSTEM|Brand::CREDSYSTEM|
|BANESCARD|Brand::BANESCARD | 
|CREDZ|Brand::CREDZ|

### Métodos de pagamentos
|Método de pagamento|Constante|
|---|---|
|A Vista (Crédito)|Methods::CREDIT_CARD_NO_INTEREST|         
|Parcelamento loja (Crédito)|Methods::CREDIT_CARD_INTEREST_BY_MERCHANT|
|Parcelamento Emissor (Crédito)|Methods::CREDIT_CARD_INTEREST_BY_ISSUER|  
|Cartão de débito|Methods::DEBIT_CARD|

---
## Outros exemplos de modalidades de pagamentos
|Modalidades de pagamentos|Código-fonte|
|---|---|
|Boleto Bancário|[source / example](examples/Boleto.php)|
|Cartão de Crédito|[source / example](examples/Credit.php)|
|Cartão de Débito|[source / example](examples/Debit.php)|
|Paypal|[source / example](examples/Paypal.php)|
|Recorrência|[source / example](examples/Rebill.php)|
|Transfência eletrônica|[source / example](examples/OnlineTransfer.php)|


                


