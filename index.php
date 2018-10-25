<?php
require 'vendor/autoload.php';

use Moip\Moip;
use Moip\Auth\BasicAuth;

$token = '01010101010101010101010101010101';
$key = 'ABABABABABABABABABABABABABABABABABABABAB';

$moip = new Moip(new BasicAuth($token, $key), Moip::ENDPOINT_SANDBOX);
/* CRIANDO O COMPRADOR */
echo "CRIANDO O COMPRADOR";
try {
    $customer = $moip->customers()->setOwnId(uniqid())
        ->setFullname('Fulano de Tal')
        ->setEmail('fulano@email.com')
        ->setBirthDate('1988-12-30')
        ->setTaxDocument('22222222222')
        ->setPhone(11, 66778899)
        ->addAddress(
            'BILLING',
            'Rua de teste',
            123,
            'Bairro',
            'Sao Paulo',
            'SP',
            '01234567',
            8
        )
        ->addAddress(
            'SHIPPING',
            'Rua de teste do SHIPPING',
            123,
            'Bairro do SHIPPING',
            'Sao Paulo',
            'SP',
            '01234567',
            8
        )
        ->create();
    var_dump($customer);
} catch (Exception $e) {
    var_dump($e->__toString());
}
/* CRIANDO O PEDIDO */
echo "CRIANDO O PEDIDO";
try {
    $order = $moip->orders()->setOwnId(uniqid())
        ->addItem("bicicleta 1", 1, "sku1", 10000)

        ->setShippingAmount(3000)->setAddition(1000)->setDiscount(5000)
        ->setCustomer($customer)
        ->create();
    var_dump($order);
} catch (Exception $e) {
    var_dump($e->__toString());
}
/* CRIANDO O PAGAMENTO */
echo "CRIANDO O PAGAMENTOS<hr>";

echo "PAGAMENTO COM CARTÃO DE CREDITO<hr>";
/*try {
    $holder = $moip->holders()->setFullname('Fulano de Tal')
        ->setBirthDate("1990-10-10")
        ->setTaxDocument('22222222222', 'CPF')
        ->setPhone(11, 66778899, 55)
        ->setAddress('BILLING', 'Avenida Faria Lima', '2927', 'Itaim', 'Sao Paulo', 'SP', '01234000', 'Apt 101');

    $payment = $order->payments()->setCreditCard(12, 21, '4073020000000002', '123', $holder)
        ->execute();
    print_r($payment);
} catch (Exception $e) {
    var_dump($e->__toString());
}
*/
echo "PAGAMENTO COM BOLETO<hr>";
/*try {
    $logo_uri = 'https://cdn.moip.com.br/wp-content/uploads/2016/05/02163352/logo-moip.png';
    $expiration_date = new DateTime();
    $instruction_lines = ['INSTRUÇÃO 1', 'INSTRUÇÃO 2', 'INSTRUÇÃO 3'];
    $payment = $order->payments()
        ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
        ->execute();
    print_r($payment);
} catch (Exception $e) {
    var_dump($e->__toString());
}*/

echo "PAGAMENTO COM CARTÃO DE DEBITO<hr>";
/*try {
    $bank_number = '341';
    $return_uri = 'https://moip.com.br';
    $expiration_date = new DateTime();
    $payment = $order->payments()
        ->setOnlineBankDebit($bank_number, $expiration_date, $return_uri)
        ->execute();
    print_r($payment);
} catch (Exception $e) {
    var_dump($e->__toString());
}*/
