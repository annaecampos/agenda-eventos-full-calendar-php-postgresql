<html>
<head>


 <?php

   session_start();

  if($_SESSION['usuarionivel'] == 2){

    header("Location: agenda.php"); exit;

  }

  if($_SESSION['usuarionivel'] == 3){

    header("Location: agenda.php"); exit;
    header("Location: minha_agenda.php"); exit;


  }
  if($_SESSION['usuarionivel'] == 4){
      //session_destroy();
    header("Location: agenda_somente_visualizar.php"); exit;
  }


 include ("header.php");

 $id = $_GET['id'];
 $obj = new Crud_Log();

  //Select dos servidores da tabela
$linha =$obj->log_select_table();

  //Select último servidor
$ultimo_servidor = $obj->log_select_ultimo();


if($_SESSION['usuarionivel'] == 4){
      //session_destroy();
      header("Location: agenda_somente_visualizar.php"); exit;
  }


?>


 <meta charset='utf-8' />


   <!-- CSS -->
  <link href='css/bootstrap.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link href='css/personalizado.css' rel='stylesheet'/>
  <!-- <link href='css/dashboard.css' rel='stylesheet'/> -->


  <!-- js -->
  <script src='js/jquery.min.js'></script>
  <script src='js/jquery-ui.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
  <script src='js/moment.min.js'></script>
  <script src='js/fullcalendar.min.js'></script>
  <script src='locale/pt-br.js'></script>
  <script src='js/gcal.min.js'></script>
</head>
<body class="bg-light" id="bservidores">

  <main class="cd-main-content">

    <div class="content-wrapper">


      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Registros Atividades </h4>
 
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
      if (isset($_GET["erro_vinculo"])){
        echo $mensagem_erro_vinculo;
      }
      if (isset($_GET["erro_senha_atual"])){
        echo $mensagem_erro_senha_atual;
      }
      if (isset($_GET["erro_senhas_nao_coincidem"])){
        echo $mensagem_erro_senhas_nao_coincidem;
      }

      if (isset($_GET["erro_campos_nulos"])){
        echo $mensagem_erro_campos_nulos;
      }      
      ?>
      
      <div class="card">
        <div class="card-body">
          <h5>Pesquisa</h5>
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
                 <input type="text" id="search" class="form-control filter-list-input" placeholder="Buscar por evento" aria-label="Filter Projects" aria-describedby="filter-projects">
               </div>
             </form>
           </div>
         </div>


         <div class="table-responsive">
          <table class="table table-bordered table-striped" id="tabela"> 
            <thead class="thead-dark">
              <tr>
                <th scope="col">Evento</th>
                <th scope="col">Usuário</th>
                <th scope="col">Data/hora</th>
                <th scope="col">Operação</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $id_linha = $linha[0]['id'];
              $id_ultimo = $ultimo_servidor[0]['id'];
              if(($id_linha = $id_ultimo) && (isset($_GET["cad"]))){

               echo "<tr class='table-success'>";

             }
             else{"<tr>";}

             $i =0;
             while ($i < count($linha)) {
              ?>

              <td><?php echo  $linha[$i]['nomeevento'] ?></td>
              <td><?php echo $linha[$i]['nomepessoa'] ?></td>
              <td><?php echo date('d/m/Y H:m:s', strtotime($linha[$i]['dataatualizacao'])) ?></td>
              <td><?php echo  $linha[$i]['operacao'] ?></td>
          </tr>
          <?php
          $i++;
        }
        ?>
      </tbody>
    </table>
</div>

<!-- TABELA FIM -->


<!-- CARDS DIV -->
</div>
</div>
<!-- CARDS DIV FIM-->

</div>
</main>


<script>
  $('#search').keyup(function() {
    var nomeFiltro = $(this).val().toLowerCase();
    console.log(nomeFiltro);
    $('table tbody').find('tr').each(function() {
      var conteudoCelula = $(this).find('td:first').text();
      console.log(conteudoCelula);
      var corresponde = conteudoCelula.toLowerCase().indexOf(nomeFiltro) >= 0;
      $(this).css('display', corresponde ? '' : 'none');
    });
  });
</script>

<script type="text/javascript">
  $('#modalalterar').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('id') // Extract info from data-* attributes
      var recipientnome = button.data('nome')

      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nome').val(recipientnome)
    })
  </script>

  <script type="text/javascript">

   $('.modal').on('shown.bs.modal', function(event) {
     $(this).find('[autofocus]').focus();
   });

 </script>

 <script type="text/javascript">
   $(document).ready(function() {
    $('#tebela tr').DataTable();
  } );
</script>

<script src="https://unpkg.com/feather-icons"></script>

<script type="text/javascript">
 $('#fechar-mensagem').on("click", function() {
  window.location.href = "listar_setor.php";

});
 feather.replace()
</script>
</body>
</html>
