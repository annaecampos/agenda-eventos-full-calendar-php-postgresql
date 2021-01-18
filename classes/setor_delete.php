<?php

    $id = $_GET['id'];
    include("functions.php");
 
	$obj = new Crud_Pessoa();
	$linha = $obj->servidor_setor_vinculo($id);
	
	if(count($linha) > 0){
		$url='../listar_setor.php?erro_vinculo';
		echo("<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>");
	}
	else{
		   $obj = new Crud_Setor();
		   $obj->setor_delete($id);
	}

?>