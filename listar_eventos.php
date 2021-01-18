<html>
<head>

  <?php
  include ("header.php");
  $id = $_GET['id'];
  $obj = new Crud_Evento();

  $linha =$obj->evento_select_table();

  if (!isset($_SESSION['id'])) {
        // Destrói a sessão por segurança
    session_destroy();
        // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
  }




if($_SESSION['usuarionivel'] == 4){
      //session_destroy();
      header("Location: agenda_somente_visualizar.php"); exit;
  }


  ?>

  <meta charset='utf-8' />
  <link href='css/bootstrap.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link href='css/personalizado.css' rel='stylesheet'/>
  <link href='css/dashboard.css' rel='stylesheet'/>

  <script src='js/moment.min.js'></script>
  <script src='js/jquery.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src='locale/pt-br.js'></script>
</head>
<body class="bg-light">
 <div class="container-fluid">
  <div class="row">

   <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h4 class="h4">Eventos Anual </h4>
      <div class="btn-toolbar mb-2 mb-md-0">

      </div>

    </div>
    <?php 
    if (isset($_GET["excluir"])){
      echo $mensagem_sucesso_excluir;
    }
    if (isset($_GET["cad"])){
      echo $mensagem_sucesso_cadastrar;
    }
    if (isset($_GET["alt"])){
      echo $mensagem_sucesso_alterar;
    }
    ?>
    <div class="card">
      <div class="card-body">

        <hr class="mb-4">

        <div class="content-list">
          <div class="row content-list-head">
            <form class="col-md-auto">
              <div class="input-group input-group-round">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                   <i data-feather="filter"></i>
                 </span>
               </div>
               <input type="text" id="search" class="form-control filter-list-input" placeholder="Buscar um evento" aria-label="Filter Projects" aria-describedby="filter-projects" id="inputBusca">
             </div>
           </form>
         </div>
       </div>
       <div class="table-responsive">
        <table class="table table-bordered table-striped" id=tabela> 
          <thead class="thead-dark" id="tabela">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Título</th>
              <th scope="col">Data início</th>
              <th scope="col">Data fim</th>

            </tr>
          </thead>
          <tbody>
            <?php

            $id_linha = $linha[0]['id'];
            $id_ultimo = $ultimo[0]['id'];
            if(($id_linha = $id_ultimo) && (isset($_GET["cad"]))){

             echo "<tr class='table-success'>";

           }
           else{"<tr>";}

           $i =0;
           while ($i < count($linha)) {
            ?>

            <th scope="row"><?php echo $linha[$i]['id'] ?></th>
            <td><?php echo  $linha[$i]['nome'] ?></td>
            <td><?php echo $linha[$i]['datainicio'] ?></td>
            <td><?php echo $linha[$i]['datafim'] ?></td>

          </tr>
          <?php
          $i++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</main>
</div>
</div>
</div>
<script>
  $(document).ready(function(){
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tabela tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script type="text/javascript">

 $('.modal').on('shown.bs.modal', function(event) {
   $(this).find('[autofocus]').focus();
 });

</script>

<script src="https://unpkg.com/feather-icons"></script>
<script type="text/javascript">

 $('#fechar-mensagem').on("click", function() {
  window.location.href = "listar_eventos.php";

 });
 feather.replace()
</script>

</body>
</html>