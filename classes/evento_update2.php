<?php

include("functions.php");

$id = $_POST['Event'][0];
$datainicio = $_POST['Event'][1];
$datafim = $_POST['Event'][2];

$obj = new Crud_Evento();
$obj->evento_update2($id,$datainicio,$datafim);




$obj = new Crud_Log();
$idpessoa = $_SESSION['id'];

date_default_timezone_set('America/Sao_Paulo');
$dataatualizacao = date("Y-m-d H:i:s");
$operacao = "ALTERAÇÃO ARRASTAR";
$obj->log_insert($id,$idpessoa,$dataatualizacao,$operacao);


$url='../agenda.php?alt';
echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");

?>