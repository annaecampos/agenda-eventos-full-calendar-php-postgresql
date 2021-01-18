
  <div class="modal-body">
  	<form class="needs-validation" method="POST" novalidate action="classes/servidor_insert.php">
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
  		<label for="setor">* Setor</label>
  		<select class="form-control" name="idsetor" required>
  			<?php

  			$optSetor = "";
  			$i = 0;
  			while ($i < count($combo))
  			{
  				$id = $combo[$i]['id'];
  				$nome = $combo[$i]['nome'];

  				if($id == $item['idsetor'])
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
  		<hr class="mb-4">
  
  		<div>
  			<hr class="mb-4">
  			<div class="mb-3">
  				<label for="login">* Login </label>
  				<input type="text" class="form-control" name="login" id="login" required maxlength="25"> 
  				<div class="invalid-feedback">
  					Insira um login.
  				</div>
  			</div>
  			<div class="mb-3">
  				<label for="login">* Senha </label>
  				<input type="password" class="form-control" name="senha" id="senha" required maxlength="11">
  				<div class="invalid-feedback">
  					Insira uma senha válida.
  				</div>
  			</div>
        <label for="nivel">* Nível de Acesso</label>
      <select class="form-control" name="nivel" required>
        <option value="">selecione..</option>
        <option value="1">Administração</option>
        <option value="2">Juizes</option>
        <option value="3">Relações Públicas</option>
        <option value="4">Somente Visualizar agenda</option>
      </select>
      <div class="invalid-feedback">
        Selecione um acesso.
      </div>
  		</div>
  		<div class="modal-footer">
  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
  			<button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
  		</div>
  	</form>
  </div>