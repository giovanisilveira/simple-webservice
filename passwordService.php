<?php
/**
* URL do WebService
*/
const WEBSERVICE_LOCATION = 'http://integra.dev/service/password/passwordService.php';

/**
* Chave de autenticação
*/
const PRIVATE_KEY = 'abcdefghijklmnopqrstuvwxyz';

/**
* flag de autenticação
*/
$insecure = true;



$server = new SoapServer(null, array(
        'location' => WEBSERVICE_LOCATION,
        'uri' => WEBSERVICE_LOCATION,
        'soap_version' => SOAP_1_2
        )
    );

/**
* Registrando métodos do webservice
*/
$server->addFunction("privateKey");
$server->addFunction("changePassword");

$server->handle();


/**
* Serviços
*/
function changePassword($login, $newPassword) {
    global $insecure;
    if ($insecure) return;

    $commandOut = shell_exec(sprintf('samba-tool user setpassword %s --newpassword=%s', $login, $newPassword));
    return preg_match('/^(?=.*password)(?=.*ok).*/i', $commandOut);
}

function privateKey($key) {
    global $insecure;

    if ($key == PRIVATE_KEY)
        $insecure = false;
}
