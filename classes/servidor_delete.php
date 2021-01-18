<?php

    $id = $_GET['id'];
    include("functions.php");
	$obj = new Crud_Evento();
	$linha = $obj->evento_pessoa_vinculo($id);
	
	if(count($linha) > 0){
		$url='../listar_servidores.php?erro_vinculo';
		echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
	}
	else{
		
		$obj = new Crud_Pessoa();
		$obj->servidor_delete($id);
	}

    

?>