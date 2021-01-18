

<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/servidor_update.php" enctype="multipart/form-data">
		
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
		<label for="setor">* Setor</label>
		<select class="form-control" name="idsetor" id="idsetor" required value="<?php echo $campoalterar[0]['idsetor'] ?>">
			<?php

			$optSetor = "";
			$i = 0;
			while ($i < count($combo))
			{
				$id = $combo[$i]['id'];
				$nome = $combo[$i]['nome'];

				if($id == $campoalterar[0]['idsetor'])
				{
					$optSetor = $optSetor. "<option value='$id' selected>$nome</option>";
				}
				else
				{
					$optSetor = $optSetor. "<option value='$id'>$nome</option>";
				}
				$i++;
			}
			?>
			<option value="">selecione..</option>
			<?php echo $optSetor; ?>
		</select>

		<div class="invalid-feedback">
			Selecione um setor.
		</div>

			<label for="nivel">* Nível de Acesso</label>
      <select class="form-control" name="nivel" id="nivel" required value="<?php echo $campoalterar[0]['nivel'] ?>">
        <option value="">selecione..</option>
        <option value="1">Administração</option>
        <option value="2">Juizes</option>
        <option value="3">Relações Públicas</option>
        <option value="4">Somente Visualizar agenda</option>
      </select>
      <div class="invalid-feedback">
        Selecione um acesso.
      </div>
		
		<hr class="mb-4">
		<input type="hidden" class="form-control" name="tipopessoa" id="tipopessoa" placeholder="" >
		<input type="hidden" class="form-control" name="login" id="login" placeholder="" >
		<input type="hidden" class="form-control" name="senha" id="senha" placeholder="" >
		
	</div>
	<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
</form>
</div>