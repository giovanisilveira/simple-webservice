<?php
const WEBSERVICE_LOCATION = 'http://integra.dev/service/password/passwordService.php';
const PRIVATE_KEY = 'abcdefghijklmnopqrstuvwxyz';


$client = new \SoapClient(null,
            array(
                'location' => WEBSERVICE_LOCATION,
                'uri' => WEBSERVICE_LOCATION,
                'soap_version' => SOAP_1_2,
                'trace' => 1
            )
        );

/**
* Cabeçalho de autenticação
*/
$header = new SoapHeader(WEBSERVICE_LOCATION, 'privateKey', PRIVATE_KEY);
$client->__setSoapHeaders($header);

/**
* Chamada do método do webservice
*/
echo $client->__soapCall("changePassword", array('giovani', '123456')) . PHP_EOL;
