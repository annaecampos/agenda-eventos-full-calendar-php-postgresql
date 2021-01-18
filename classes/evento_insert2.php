<?php
include("functions.php");
$datainicio = $_POST['Event'][0];
$datafim = $_POST['Event'][1];
$nome = $_POST['Event'][2];
$cor = $_POST['Event'][3];

$obj = new Crud_Evento();
$obj->evento_insert2($nome,$datainicio,$datafim,$cor);


$linha = $obj->ultimo_evento_cadastrado_select();
$idevento = $linha[0]['id'];



$obj = new Crud_Log();
$idpessoa = $_SESSION['id'];

date_default_timezone_set('America/Sao_Paulo');
$dataatualizacao = date("Y-m-d H:i:s");
$operacao = "INSERÇÃO ARRASTAR";
$obj->log_insert($idevento,$idpessoa,$dataatualizacao,$operacao);



?>