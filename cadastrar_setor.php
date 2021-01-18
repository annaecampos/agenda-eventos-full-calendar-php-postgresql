<?php

if($_SESSION['usuarionivel'] == 4){
      //session_destroy();
      header("Location: agenda_somente_visualizar.php"); exit;
  }
?>
<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/setor_insert.php" id="form" name="form">

		<label for="nome">* Nome </label>
		<input type="text" class="form-control" name="nome" id="nome" placeholder="" required autofocus maxlength="100">
		<div class="invalid-feedback">
			Insira um nome válido.
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
		</div>
	</form>
</div>


