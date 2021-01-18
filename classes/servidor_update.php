<?php

include("functions.php");
$comand= $_POST['botaoAlterar'];
$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$login=$_POST['login'];
$senha = $_POST['senha'];
$tipopessoa=$_POST['tipopessoa'];
$idsetor=$_POST['idsetor'];
$nivel=$_POST['nivel'];

$obj = new Crud_Pessoa();

$obj->servidor_update($id,$nome,$telefone,$cpf,$email,$login,$senha,$tipopessoa,$idsetor,$nivel);


?>