<?php

require __DIR__ . '/vendor/autoload.php';

use Lametric\Packagist;

$response = new Packagist\Response();

try {

    $parameters = new Packagist\Validation($_GET);
    $api = new Packagist\Api();
    $api->setParameters($parameters->getParameters());
    
    echo $response->setData($api->getResult());

} catch (Exception $e) {

    echo $response->setUnAuthorized();

}
