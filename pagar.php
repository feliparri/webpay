<?php
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;

include 'vendor/autoload.php';

// Obtenemos los certificados y llaves para utilizar el ambiente de integración de Webpay Normal.
$bag = CertificationBagFactory::integrationWebpayNormal();

$plus = TransbankServiceFactory::normal($bag);

// Para transacciones normales, solo puedes añadir una linea de detalle de transacción.
$plus->addTransactionDetail(10000, 'Orden824201'); // Monto e identificador de la orden

// Debes además, registrar las URLs a las cuales volverá el cliente durante y después del flujo de Webpay
$response = $plus->initTransaction('localhost/response.php', 'localhost/gracias.php');

die($response);
// Utilidad para generar formulario y realizar redirección POST
echo RedirectorHelper::redirectHTML($response->url, $response->token);

?>