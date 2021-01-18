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
 $obj = new Crud_Pessoa();
 $campoalterar = $obj->servidor_select($id);

 $tipopessoa = $campoalterar[0]['tipopessoa'];
 if($tipopessoa == 1)
 {
  $checked = "checked='checked'";
  $style = "";
  $login = $campoalterar[0]['login'];
  $senha = $campoalterar[0]['senha'];
  $tipopessoa = 1;
  $required = "required";
}
else
{
  $checked = "";
  $style = "display:none";
  $login="";
  $senha="";
  $tipopessoa=2;
  $required = "";
}
  //Select dos servidores da tabela
$linha =$obj->pessoa_select_table();

  //Select último servidor
$ultimo_servidor = $obj->servidor_select_ultimo();

$obj = new Crud_Setor();
  //seleciona setor para o select
$combo =$obj->select_setor_combo();





?>


<meta charset='utf-8' />


<link href='css/bootstrap.min.css' rel='stylesheet' />
<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='css/personalizado.css' rel='stylesheet'/>
<!--<link href='css/dashboard.css' rel='stylesheet'/>-->

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
        <h4 class="h4">Pessoas </h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
           <button type="button"class="btn btn-round btn-success" data-toggle="modal" data-target="#modalcadastrar">
            <i data-feather="plus"></i>
          </button>
        </div>
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


        <div class="modal fade" id="modalcadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Pessoa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <?php
              require('cadastrar_pessoa.php');
              ?>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalalterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalalterar">Alterar Pessoa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php
              require('alterar_pessoa.php');
              ?>
            </div>
          </div>
        </div>

      

      

        <div class="content-list">
          <div class="row content-list-head">
            <form class="col-md-auto">
              <div class="input-group input-group-round">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                   <i data-feather="filter"></i>
                 </span>
               </div>
               <input type="text" id="search" class="form-control filter-list-input" placeholder="Buscar uma pessoa" aria-label="Filter Projects" aria-describedby="filter-projects">
             </div>
           </form>
         </div>
       </div>

       <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabela"> 
          <thead class="thead-dark" id="tabela-thead">
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Telefone</th>
              <th scope="col">CPF</th>
              <th scope="col">Email</th>
              <th scope="col">Ações</th>
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

            <td><?php echo  $linha[$i]['nome'] ?></td>
            <td><?php echo $linha[$i]['telefone'] ?></td>
            <td><?php echo $linha[$i]['cpf'] ?></td>
            <td><?php echo  $linha[$i]['email'] ?></td>

          
            <td>
             <?php
             $idusuario = $_SESSION['id'];
             $idbotaodelete = $linha[$i]['id'];

             if($idusuario == $idbotaodelete){
              $style = "display:none";
            }
            else{
              $style = "";
            }
            ?>

            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalalterar" 
            data-id="<?php echo $linha[$i]['id']; ?>" 
            data-nome="<?php echo $linha[$i]['nome']; ?>" 
            data-telefone="<?php echo $linha[$i]['telefone']; ?>" 
            data-cpf="<?php echo $linha[$i]['cpf']; ?>" 
            data-email="<?php echo $linha[$i]['email']; ?>" 
            data-idsetor="<?php echo $linha[$i]['idsetor']; ?>" 
            data-tipopessoa="<?php echo $linha[$i]['tipopessoa']; ?>" 
            data-login="<?php echo $linha[$i]['login']; ?>" 
            data-senha="<?php echo $linha[$i]['senha']; ?>" 
            data-nivel="<?php echo $linha[$i]['nivel']; ?>"
             title="alterar dados do servidor">
            <i data-feather="edit"></i>

          </button>

            <a style="<?php echo $style ?>" data-toggle="tooltip" data-placement="top" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-lg" title="Excluir" href="classes/pessoa_delete.php?id=<?php echo $linha[$i]['id']?>"> 
              <i data-feather="trash-2"></i>
            </a>

            <?php 
            //if($linha[$i]['tipopessoa'] == 1)
            //{
            //  ?>
             
         
        
          </td>
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

<script type="text/javascript">
 $(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

</script>
<!-- Aqui mostrar e ocultar div com JS -->
<script type="text/javascript">

  $('[name="check"]').change(function() {
    $('[name="divMostrar"]').toggle(0);
  });
</script>
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
      var recipienttelefone = button.data('telefone')
      var recipientcpf = button.data('cpf')
      var recipientemail = button.data('email')
      var recipientidsetor = button.data('idsetor')
      var recipienttipopessoa = button.data('tipopessoa')
      var recipientlogin = button.data('login')
      var recipientsenha = button.data('senha')
      var recipientnivel = button.data('nivel')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nome').val(recipientnome)
      modal.find('#telefone').val(recipienttelefone)
      modal.find('#cpf').val(recipientcpf)
      modal.find('#email').val(recipientemail)
      modal.find('#idsetor').val(recipientidsetor)
      modal.find('#login').val(recipientlogin)
      modal.find('#senha').val(recipientsenha)
      modal.find('#tipopessoa').val(recipienttipopessoa)
      modal.find('#nivel').val(recipientnivel)
      // if(recipienttipopessoa == 1){
      //   //var teste = "checked='checked'"
      //   //modal.find('#tipopessoa').val(teste)
      //   //document.getElementById("tipopessoa").checked = true;
      //   document.getElementById("divMostrar").style = "";
      //   modal.find('#login').val(recipientlogin);
      //   modal.find('#senha').val(recipientsenha);
      //   modal.find('#tipopessoa').val(1);
      //   modal.find('.required').val("required");
      //   document.getElementById("tipopessoa").checked = true;



      // }
      // else{
      //   document.getElementById("tipopessoa").checked = false;
      //   document.getElementById("divMostrar").style = "display:none";
      //   modal.find('#login').val("");
      //   modal.find('#senha').val("");
      //   modal.find('.required').val("");
      //   modal.find('#tipopessoa').val(2);
      // }

    })


  $('#modalalterarsenha').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('id') // Extract info from data-* attributes
      var recipientnome = button.data('nome')
      var recipienttelefone = button.data('telefone')
      var recipientcpf = button.data('cpf')
      var recipientemail = button.data('email')
      var recipientidsetor = button.data('idsetor')
      var recipienttipopessoa = button.data('tipopessoa')
      var recipientnivel = button.data('nivel')
      //var recipientlogin = button.data('login')
      //var recipientsenha = button.data('senha')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nome').val(recipientnome)
      modal.find('#telefone').val(recipienttelefone)
      modal.find('#cpf').val(recipientcpf)
      modal.find('#email').val(recipientemail)
      modal.find('#idsetor').val(recipientidsetor)
   
      //modal.find('#login').val(recipientlogin)
     // modal.find('#senha').val(recipientsenha)
      modal.find('#tipopessoa').val(1)
      modal.find('#nivel').val(recipientnivel)


   })

  $('#modalcriarsenha').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('id') // Extract info from data-* attributes
      var recipientnome = button.data('nome')
      var recipienttelefone = button.data('telefone')
      var recipientcpf = button.data('cpf')
      var recipientemail = button.data('email')
      var recipientidsetor = button.data('idsetor')
      var recipienttipopessoa = button.data('tipopessoa')
      var recipientnivel = button.data('nivel')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nome').val(recipientnome)
      modal.find('#telefone').val(recipienttelefone)
      modal.find('#cpf').val(recipientcpf)
      modal.find('#email').val(recipientemail)
      modal.find('#idsetor').val(recipientidsetor)
      modal.find('#tipopessoa').val(1)
      modal.find('#nivel').val(recipientnivel)


    })
  </script>
   <!--if($tipopessoa == 1)
  {
    $checked = "checked='checked'";
    $style = "";
    $login = $campoalterar[0]['login'];
    $senha = $campoalterar[0]['senha'];
    $tipopessoa = 1;
    $required = "required";
  }
  else
  {
    $checked = "";
    $style = "display:none";
    $login=NULL;
    $senha=NULL;
    $tipopessoa=2;
    $required = "";
  }-->

 <script src="js/jquery.maskedinput.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy",completed:function(){alert("completed!");}});
        $(".phone").mask("(99) 99999-9999");
        $(".cpf").mask("999.999.999-99");
        $(".cnpj").mask("99.999.999/9999-99");
        $("#pct").mask("99%");
        $("#phoneAutoclearFalse").mask("(999) 999-9999", { autoclear: false, completed:function(){alert("completed autoclear!");} });
        $("#phoneExtAutoclearFalse").mask("(999) 999-9999? x99999", { autoclear: false });

        $("input").blur(function() {
          $("#info").html("Unmasked value: " + $(this).mask());
        }).dblclick(function() {
          $(this).unmask();
        });
      });
    </script>

  <script src="https://unpkg.com/feather-icons"></script>


  <script type="text/javascript">
   $('#fechar-mensagem').on("click", function() {
    window.location.href = "listar_pessoas.php";

  });

   $('.modal').on('shown.bs.modal', function(event) {
     $(this).find('[autofocus]').focus();
   });

   feather.replace();

 </script>

</body>
</html>
