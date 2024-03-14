<?php

 /*  
  * Constantes de parâmetros para configuração da conexão  
  */ 
 //header('Content-Type: text/html; charset=utf-8');
 date_default_timezone_set('America/Sao_Paulo');
   
    define('HOST', '10.0.0.7');  
    define('DBNAME', 'sandy');  
    define('CHARSET', 'utf8');  
    define('USER', 'ederbatera');  
    define('PASSWORD', 'Mion@03122022');

 class Conexao {  

   /*  
    * Atributo estático para instância do PDO  
    */  
   private static $pdo;

   /*  
    * Escondendo o construtor da classe  
    */ 
   private function __construct() {  
     //  
   } 
 
   /*  
    * Método estático para retornar uma conexão válida  
    * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão  
    */  
   public static function getInstance() {  
     if (!isset(self::$pdo)) {  
       try {  
         $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  
         self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, $opcoes);  
       } catch (PDOException $e) {  
         print "Erro: " . $e->getMessage();  
       }  
     }  
     return self::$pdo;  
   }  
 }