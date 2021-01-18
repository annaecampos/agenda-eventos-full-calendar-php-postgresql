

<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/servidor_senha_criar_update.php" enctype="multipart/form-data">
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" required>
		<input type="hidden" class="form-control" name="nome" id="nome" placeholder="" required>
		<input type="hidden" class="form-control" name="telefone" id="telefone" placeholder="" required>
		<input type="hidden" class="form-control" name="cpf" id="cpf" placeholder="" required>
		<input type="hidden" class="form-control" name="email" id="email" placeholder="" required>
		<input type="hidden" class="form-control" name="idsetor" id="idsetor" placeholder="" required>
		<div class="mb-3">
			<label for="login">* Login </label>
			<input type="text" class="form-control" name="login" id="login" value="<?php echo $login?>" <?php echo $required ?>>
			<div class="invalid-feedback">
				Insira um login.
			</div>
		</div>
	
		<div class="mb-3">
			<label for="senha">* Senha Nova </label>
			<input type="password" class="form-control" name="senhanova" id="senhanova" <?php echo $required ?>>
			<div class="invalid-feedback">
				Insira uma senha válida.
			</div>
		</div>
		<div class="mb-3">
			<label for="senha">* Confirma Nova Senha </label>
			<input type="password" class="form-control" name="senhaconfirma" id="senhaconfirma" <?php echo $required ?>>
			<div class="invalid-feedback">
				Insira uma senha válida.
			</div>
		</div>


		<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
	</form>
</div>