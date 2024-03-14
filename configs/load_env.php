<?php
// Carregar as variáveis de ambiente do arquivo .env
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
if(!$_ENV['WEBSOCKET_TOKEN']){
    $_ENV['WEBSOCKET_TOKEN'] = 123456;
}
?>