
  <div class="modal-body">
  	<form class="needs-validation" method="POST" novalidate action="classes/pessoa_insert.php">
  		<label for="nome">* Nome</label>
  		<input type="text" class="form-control" name="nome" id="nome" placeholder="" required autofocus maxlength="100">
  		<div class="invalid-feedback">
  			Insira um nome válido.
  		</div>

  		<label for="telefone">* Telefone</label>
  		<input type="tel" class="form-control phone" name="telefone" id="telefone" maxlength="15" placeholder="" required>
  		<div class="invalid-feedback">
  			Insira um telefone válido.
  		</div>
  		<label for="cpf">CPF</label>
  		<input type="cpf" class="form-control cpf" name="cpf" id="cpf" maxlength="15" placeholder="" >
  		<div class="invalid-feedback">
  			Insira um CPF válido.
  		</div>
  		<div class="mb-3">
  			<label for="email">Email </label>
  			<input type="email" class="form-control" name="email" id="email" placeholder="modelo: email@email.com" maxlength="50"> 
  			<div class="invalid-feedback">
  				Insira um email válido.
  			</div>
  		</div>

  		<div class="modal-footer">
  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
  			<button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
  		</div>
  	</form>
  </div>