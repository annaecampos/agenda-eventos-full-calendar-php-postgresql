<?php

include("functions.php");
$comand= $_POST['botaoAlterar'];
$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha_nova = $_POST['senhanova'];
$senha_confirma = $_POST['senhaconfirma'];
$nivel=$_POST['nivel'];

$obj = new Crud_Pessoa();


$login=$_POST['login'];
//$senha=md5($_POST['senha']);
$tipopessoa=1;

//echo count($troca_senha);

if(($senha_nova=="") && ($senha_confirma==""))
{
	$url='../listar_servidores.php?erro_campos_nulos';
	echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
}
else
{
	if(($senha_nova != $senha_confirma))
	{


		$url='../listar_servidores.php?erro_senhas_nao_coincidem';
		echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
		


	}
	else
	{

		$idsetor=$_POST['idsetor'];
		$senha = md5($senha_nova);
		$obj->servidor_update($id,$nome,$telefone,$cpf,$email,$login,$senha,$tipopessoa,$idsetor,$nivel);


	

	}
}








?>