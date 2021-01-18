<?php

include("functions.php");
$comand= $_POST['botaoAlterar'];
$id = $_POST['id'];
$nome=$_POST['title'];
$idcor=$_POST['color'];
$datainicio=$_POST['start'];
$datafim=$_POST['end'];

if (isset($_POST['delete'])){

	$obj = new Crud_Evento();
	$obj->evento_pessoa_delete($id);
	$obj->evento_delete($id);


$obj = new Crud_Log();
 session_start();

$idpessoa = $_SESSION['id'];

date_default_timezone_set('America/Sao_Paulo');
$dataatualizacao = date("Y-m-d H:i:s");
$operacao = "EXCLUSÃO";
$obj->log_insert($id,$idpessoa,$dataatualizacao,$operacao);

$url='../agenda.php?excluir';
echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");



}
else{
$obj = new Crud_Evento();

$obj->evento_update($id,$nome,$idcor,$datainicio,$datafim);



$teste = $obj->evento_select($id);

if(count($teste) > 0)
{

	$obj->evento_pessoa_delete($id);

}


if (isset($_POST['check'])){
	$quantidade = count($_POST['check']);
}
$ativo = $_POST['check'];
$idevento = $_POST['id'];

if (isset($_POST['check'])){

	for ($i = 0; $i < $quantidade; $i++) {

		$ativo[$i];
		$obj->evento_pessoa_insert($idevento, $ativo[$i]);


	}

}

$url='../agenda.php?alt';
echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");



$obj = new Crud_Log();
$idpessoa = $_SESSION['id'];

date_default_timezone_set('America/Sao_Paulo');
$dataatualizacao = date("Y-m-d H:i:s");
$operacao = "ALTERAÇÃO";
$obj->log_insert($id,$idpessoa,$dataatualizacao,$operacao);
}

?>