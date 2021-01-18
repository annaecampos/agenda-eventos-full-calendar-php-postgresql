<?php
include("functions.php");
$comand=$_POST['botaoSalvar'];
$nome=$_POST['title'];
$idcor=$_POST['color'];
$datainicio=$_POST['start'];
$datafim=$_POST['end'];

$obj = new Crud_Evento();
$obj->evento_insert($nome,$idcor,$datainicio,$datafim);


$linha = $obj->ultimo_evento_cadastrado_select();

if (isset($_POST['check'])){
	$quantidade = count($_POST['check']);

}
$ativo = $_POST['check'];
$idevento = $linha[0]['id'];

if (isset($_POST['check'])){


	for ($i = 0; $i < $quantidade; $i++) {

		$ativo[$i];
		$obj->evento_pessoa_insert($idevento, $ativo[$i]);
		
		$url='../agenda.php?cad';
		echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
	}

}
else{

	$url='../agenda.php?cad';
	echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");


}


$obj = new Crud_Log();
$idpessoa = $_SESSION['id'];

date_default_timezone_set('America/Sao_Paulo');
$dataatualizacao = date("Y-m-d H:i:s");
$operacao = "INSERÇÃO";
$obj->log_insert($idevento,$idpessoa,$dataatualizacao,$operacao);










?>