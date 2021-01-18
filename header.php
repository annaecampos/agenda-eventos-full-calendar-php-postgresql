<!doctype html>
<html lang="pt-br">



<head>

  <?php 

  include ("classes/mensagem.php");
  include("classes/functions.php");

  if (!isset($_SESSION)){ 
    session_start();
  }

   //session_start();

  //NIVEL DE ACESSO GERAL
  if($_SESSION['usuarionivel'] == 1){
 
    $visibilidade1 = "visibility: visible;";

  }

  else{

    //NIVEL DE ACESSO EDITAR, CRIAR E EXCLUIR (Agenda)
    if($_SESSION['usuarionivel'] == 2){

      $visibilidade2 = "visibility: hidden;";

    }

    //NIVEL DE ACESSO VISUALIZAR A AGENDA
    if($_SESSION['usuarionivel'] == 3){
      $visibilidade1 = "visibility: hidden;";
      $visibilidade2 = "visibility: hidden;";
      $visibilidade3 = "visibility: hidden;";

    }
    //NIVEL DE ACESSO visualizar agenda
    if($_SESSION['usuarionivel'] == 4){
      $visibilidade1 = "visibility: hidden;";
      $visibilidade2 = "visibility: hidden;";
      $visibilidade3 = "visibility: hidden;";
      //header("Location: agenda_somente_visualizar.php"); exit;

    }

  }

  // Verifica se não há a variável da sessão que identifica o usuário
  if (!isset($_SESSION['id'])) {
        // Destrói a sessão por segurança
    session_destroy();
        // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
  }

  ?>



  <!-- CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <!--<link href='css/dashboard.css' rel='stylesheet'/>-->


  <!-- CSS MENU -->
  <!--<link rel="stylesheet" href="menu/css/reset.css">  CSS reset -->
  <link rel="stylesheet" href="menu/css/style.css"> <!-- Resource style -->

  
  <title>Agenda JMU</title>

</head>


<body>

  <!-- Aqui Menu Navbar -->
  <!--<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow"  role="navigation">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Agenda JMU</a>
    <form class="form-inline" style="margin-bottom: 0em!important">

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
         <a class="nav-link" href="#">  
          <?php
         // session_start();
          //echo "Usuário: ".$_SESSION['usuarioNome']; 
          ?>

        </a>
      </li>
    </ul>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="sair.php">Sair</a>
      </li>
    </ul>
  
  </form>
</nav>-->




<header class="cd-main-header">
  <a href="#0" class="cd-logo" style="color:#ccc"><h3>JMU</h3></a>
  <a href="#0" class="cd-nav-trigger"><span></span></a>

  <nav class="cd-nav">
    <ul class="cd-top-nav">
      <li class="has-children account">
        <a href="#0">
          <img src="imagens/avatar.jpg" alt="avatar">
          <?php
          session_start();
          echo $_SESSION['usuarioNome']; 
          ?>
        </a>

        <ul>

          <!--<li><a href="#0">Editar conta</a></li>-->
          <li><a href="sair.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>



<!-- DIV PRINCIPAL -->
<!--<div class="container-fluid" id="navbarSupportedContent" >
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar" id="sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column" id="menu">

          <li class="nav-item">
            <a class="nav-link" href="agenda.php" id="agenda"><i data-feather="calendar" id="icon1"></i> Agenda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="minha_agenda.php" id="minhaagenda"><i data-feather="calendar" id="icon2"></i> Minha agenda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listar_servidores.php" id="usuario"><i data-feather="user"></i> Usuários</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="listar_setor.php" id="setor"><i data-feather="user"></i> Setor</a>
          </li>

          <hr class="mb-3">
          <li class="nav-item">
            <div id='external-events' class="tipo-evento">
              <h4>Legenda</h4>
              <div class='fc-event' style="background-color:#27AE60!important;border-color:#27AE60!important " value="#27AE60" id="#27AE60"> <i data-feather='crosshair' id='icon'></i>  Exército</div>
              <div class='fc-event' style="background-color:#34495E!important;border-color:#34495E!important " value="#34495E" id="#34495E"> <i data-feather='anchor' id='icon'></i> Marinha</div>
              <div class='fc-event' style="background-color:#7F8C8D!important;border-color:#7F8C8D!important " value="#7F8C8D" id="#7F8C8D"> <i data-feather='send' id='icon'></i> Aeronáutica</div>
              <div class='fc-event' style="background-color:#F1C405!important;border-color:#F1C405!important " value="#F1C405" id="#F1C405"> <i data-feather='book-open' id='icon'></i> Audiências</div>

              <div class='fc-event' style="background-color:#E67E22!important;border-color:#E67E22!important " value="#E67E22" id="#E67E22"><i data-feather='star' id='icon'></i> Datas Comemorativas</div>
              <div class='fc-event' style="background-color:#C0392B!important;border-color:#C0392B!important " value="#C0392B" id="#C0392B"><i data-feather='sun' id='icon'></i> Feriados</div>
              <div class='fc-event' style="background-color:#9B59B6!important;border-color:#9B59B6!important " value="#9B59B6" id="#9B59B6"><i data-feather='gift' id='icon'></i> Aniversários</div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>-->


<main class="cd-main-content">
  <nav class="cd-side-nav">
    <ul style="<?php echo $visibilidade3 ?>">
      <li class="has-children overview">
        <a href="agenda.php" id="agenda">Agenda</a>
      </li>
      <li class="has-children notifications">
        <a href="minha_agenda.php" id="minhaagenda">Minha Agenda</a>
      </li>

      <li class="has-children comments" style="<?php echo $visibilidade2 ?>">
        <a href="#0" id="usuario">Configurações</a>
        <ul>
          <li><a href="listar_pessoas.php">Pessoas</a></li>
          <li><a href="listar_servidores.php">Usuários</a></li>
          <li><a href="listar_setor.php">Setores</a></li>
          <li><a href="listar_logs.php">Registros de Atividades</a></li>
        </ul>
      </li>
    </ul>
    <ul>
      <li class="has-children overview">
        <div id='external-events' class="tipo-evento">
          <h4>Legenda</h4>
          <div class='fc-event' style="background-color:#27AE60!important;border-color:#27AE60!important " value="#27AE60" id="#27AE60"> <i data-feather='crosshair' id='icon'></i>  Exército</div>
          <div class='fc-event' style="background-color:#34495E!important;border-color:#34495E!important " value="#34495E" id="#34495E"> <i data-feather='anchor' id='icon'></i> Marinha</div>
          <div class='fc-event' style="background-color:#7F8C8D!important;border-color:#7F8C8D!important " value="#7F8C8D" id="#7F8C8D"> <i data-feather='send' id='icon'></i> Aeronáutica</div>
          <div class='fc-event' style="background-color:#F1C405!important;border-color:#F1C405!important " value="#F1C405" id="#F1C405"> <i data-feather='book-open' id='icon'></i> Audiências</div>

          <div class='fc-event' style="background-color:#E67E22!important;border-color:#E67E22!important " value="#E67E22" id="#E67E22"><i data-feather='star' id='icon'></i> Datas Comemorativas</div>
          <div class='fc-event' style="background-color:#C0392B!important;border-color:#C0392B!important " value="#C0392B" id="#C0392B"><i data-feather='sun' id='icon'></i> Feriados</div>
          <div class='fc-event' style="background-color:#9B59B6!important;border-color:#9B59B6!important " value="#9B59B6" id="#9B59B6"><i data-feather='gift' id='icon'></i> Aniversários</div>
        </div>
        
      </li>
    </ul> 
  </nav>
</main>


<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>

<!--<script src="js/vendor/popper.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!-- JS -->
<script src='js/bootstrap.min.js'></script>
<script src='js/jquery.min.js'></script>
<script src='js/jquery-ui.min.js'></script>


<!-- JS MENU -->
<script src="menu/js/modernizr.js"></script>
<!-- <script src="menu/js/jquery-2.1.4.js"></script>-->
<script src="menu/js/jquery.menu-aim.js"></script>
<script src="menu/js/main.js"></script> <!-- Resource jQuery -->
<!--<script src="js/vendor/holder.min.js"></script>-->



      <!--
        <script>
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>-->

    <!-- Aqui validação dos campos com Bootstrap-->
    <script>
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');

          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>



    <!--Aqui a máscara dos campos-->
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
    <script src="js/feather.min.js"></script>

    <script type="text/javascript">
      feather.replace()
    </script>


    <script type="text/javascript">
      $(document).ready(function() {
        $('#tabela').DataTable();
      } );
    </script>


    <script type="text/javascript">
      function TrocarCores(){
        $(" #danger").removeClass("alert-dark");
        $(" #danger").addClass("alert-danger");
      }
    </script>


    <script type="text/javascript">
     $('.modal').on('shown.bs.modal', function(event) {
       $(this).find('[autofocus]').focus();
     });
   </script>

 </body>
 </html>
