

<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/pessoa_update.php" enctype="multipart/form-data">
		
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" required>

		<label for="nome">Nome</label>
		<input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $campoalterar[0]['nome'] ?>" required autofocus maxlength="100">
		<div class="invalid-feedback">
			Insira um nome válido.
		</div>
		<label for="telefone">Telefone</label>
		<input type="text" class="form-control phone" name="telefone" id="telefone" maxlength="13" placeholder="" value="<?php echo $campoalterar[0]['telefone'] ?>" required>
		<div class="invalid-feedback">
			Insira um telefone válido.
		</div>
		<label for="cpf">CPF</label>
		<input type="tel" class="form-control cpf" name="cpf" id="cpf" maxlength="15" placeholder="" value="<?php echo $campoalterar[0]['cpf'] ?>">
		<div class="invalid-feedback">
			Insira um CPF válido.
		</div>
		<div class="mb-3">
			<label for="email">Email </label>
			<input type="email" class="form-control" name="email" id="email" placeholder="email@email.com" value="<?php echo $campoalterar[0]['email']?>" maxlength="50">
			<div class="invalid-feedback">
				Insira um email válido.
			</div>
		</div>
		

		
		<hr class="mb-4">
		<input type="hidden" class="form-control" name="tipopessoa" id="tipopessoa" placeholder="" >
		<input type="hidden" class="form-control" name="login" id="login" placeholder="" >
		<input type="hidden" class="form-control" name="senha" id="senha" placeholder="" >
		
	</div>
	<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
</form>
</div>