<?php

    include("functions.php");
    $comand= $_POST['botaoAlterar'];
    $id = $_POST['id'];
    $nome=$_POST['nome'];
    $obj = new Crud_Setor();
    $obj->setor_update($id,$nome);

?>