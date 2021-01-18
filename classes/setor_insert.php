<?php
	include("functions.php");
	$comand=$_POST['botaoSalvar'];
	$nome=$_POST['nome'];
	$obj = new Crud_Setor();
	$obj->setor_insert($nome);

?>