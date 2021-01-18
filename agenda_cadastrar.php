

<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header bg-light">
        <h5 class="modal-title text-center">Cadastrar Evento</h5>
        <button type="button" class="close text-whit" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form class="form-horizontal" method="POST" action="classes/evento_insert.php">

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Titulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="title" placeholder="Titulo do Evento" autofocus>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Cor</label>
            <div class="col-sm-10">
              <select name="color" class="form-control" id="color">
               <option value="">Selecione</option>     
               <option style="color:#F1C405;" value="#F1C405">&#9724; Amarelo</option>
               <option style="color:#E67E22;" value="#E67E22">&#9724; Laranja</option> 
               <option style="color:#C0392B;" value="#C0392B">&#9724; Vermelho</option>
               <option style="color:#27AE60;" value="#27AE60">&#9724; Verde</option>
               <option style="color:#298089;" value="#298089">&#9724; Azul Turquesa</option>
               <option style="color:#34495E;" value="#34495E">&#9724; Azul Marinho</option>
               <option style="color:#1C1C1C;" value="#1C1C1C">&#9724; Preto</option>
               <option style="color:#9B59B6;" value="#9B59B6">&#9724; Roxo</option>                
             </select>
           </div>
         </div>

         <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
          <div class="col-sm-10">
            <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
              <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </span>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
          <div class="col-sm-10">
            <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
              <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
              <span class="input-group-addon">
               <span class="glyphicon glyphicon-th"></span>
             </span>
           </div>
         </div>
       </div>

       <hr class="mb-4">
       <label for="inputEmail3" class="col-sm-2 col-form-label">Designado à</label>

       <?php 
       $i = 0;
       while ($i < count($combo)) {
        $id = $combo[$i]['id'];
        $nome = $combo[$i]['nome'];

        echo "<div class='custom-control custom-checkbox'>
        <input type='checkbox' class='custom-control-input' id='$nome' name='check[]' value='$id'>
        <label class='custom-control-label' for='$nome'>$nome</label>
        </div>";

        $i++;
      }

      ?>
      <hr class="mb-4">

      <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
       </div>
     </div>

   </form>
 </div>
</div>
</div>
</div>