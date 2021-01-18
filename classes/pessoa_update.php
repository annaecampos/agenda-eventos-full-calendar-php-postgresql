<?php

include("functions.php");
$comand= $_POST['botaoAlterar'];
$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$tipopessoa=$_POST['tipopessoa'];

$obj = new Crud_Pessoa();

$obj->pessoa_update($id,$nome,$telefone,$cpf,$email,$tipopessoa);


?>