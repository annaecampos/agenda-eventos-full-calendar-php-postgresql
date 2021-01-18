<!doctype html>
<html lang="pt-br">


<head>


  <?php

  session_start();

  include ("header.php");

///$id = $_GET['id'];
  $obj = new Crud_Evento();

//Select dos pordutos da tabela
  $linha =$obj->evento_select_table();

  $campoalterar = $obj->evento_select($idp);

  $obj = new Crud_Pessoa();
  //seleciona setor para o select
  $combo =$obj->select_servidor_combo();


  ?>

  <meta charset='utf-8' />


  <!--CSS-->
  <link href='css/bootstrap.min.css' rel='stylesheet' />
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
  <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
  <link href='css/personalizado.css' rel='stylesheet'/>
  <!--<link href='css/dashboard.css' rel='stylesheet'/>-->
  <link href='css/form-validation.css' rel='stylesheet'/>


  <!--JS-->

  <script src='js/jquery.min.js'></script>
  <script src='js/jquery-ui.min.js'></script>

  <script src='js/bootstrap.bundle.min.js'></script>

  <script src='js/bootstrap.min.js'></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>

  <script src="js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
  <script src='js/moment.min.js'></script>

  <script src='js/fullcalendar.min.js'></script>

  <script src='locale/pt-br.js'></script>
  <script src='js/gcal.min.js'></script>

  <script>
    $(document).ready(function() {
      // FAZ OS EVENTOS EXTERNOS SEREM ARRASTADOS
/*      $('#external-events .fc-event').each(function() {

       droppable: true, 

      // store data so the calendar knows to render an event upon drop

      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        //color: $.trim($(this).text()),
       // color: $.trim($(this).val()),
        stick: true // maintain when user navigates (see docs on the renderEvent method)

      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0 //  original position after the drag

      });


    });*/


      //POPUP'S
      //FAZ O CAMPO DATA MOSTRA MINI CALENDÁRIO
      $('.data_formato').datetimepicker({
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        language: "pt-BR",
                //startDate: '+0d'
        });


      //FAZ OS CHECKBOX APARECEREM SELECIONADOS COM DADOS VINDOS DO BD
     /* $("#editar").click(function(){
        var teste = $("#idpessoa").val();
        var teste1 = new Array();
        teste1 = teste.split(', ');

        var i = 0;
        while(i < teste1.length){
          $('.ed').each(function(){

            var qualquer = $(this).attr('id');

            if(qualquer == teste1[i]){
              $('#' + qualquer).prop("checked", true);

            }

          });
          i++;
        }
      });*/


      //FAZ O PRIMEIRO CAMPO VIR SELECIONADO QUANDO ACIONAR POPUP
      $('.modal').on('shown.bs.modal', function(event) {
       $(this).find('[autofocus]').focus();
     });


      //DEVERIA FAZER ALGO, MAS NÃO FAZ NADA
      //$('[data-toggle="popover"]').popover(); 
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,listWeek,listDay,listYear'
        },

        views: {
          listDay: { buttonText: 'Dia' },
          listYear: { buttonText: 'listar Tudo' },
          listWeek: { buttonText: 'Semana' }
        },

        defaultDate: Date(),
        navLinks: true,
        //editable: true,

        //droppable: true, 

        //selectable: true,
       // selectHelper: true,


       /* eventClick: function(event) {
          $('#visualizar #id').text(event.id);
          $('#visualizar #id').val(event.id);
          $('#visualizar #title').text(event.title);
          $('#visualizar #title').val(event.title);
          $('#visualizar #color').val(event.color);
          $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
          $('#visualizar #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
          $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
          $('#visualizar #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
          $('#visualizar #idpessoa').text(event.idpessoa);
          $('#visualizar #idpessoa').val(event.idpessoa);
          $('#visualizar #nomepessoa').val(event.nomepessoa);
          $('#visualizar #nomepessoa').text(event.nomepessoa);
          $('#visualizar').modal('show');
          return false;

        },*/
/*
        select: function(start, end) {
          $('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
          $('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
          $('#cadastrar').modal('show');
        },*/

      eventMouseover: function(calEvent, jsEvent) {
         if(calEvent.nomepessoa != "")
         {
          var designado = "Designado à: ";

        }
        var tooltip = '<div class="tooltipevent popover"><div class="arrow"></div><h3 class="popover-header">' + calEvent.title + '</h3> <div class="popover-body">De: ' + '<strong>' + calEvent.start.format('DD/MM/YYYY HH:mm:ss') + '</strong>' + '</br>Até: ' + '<strong>' + calEvent.end.format('DD/MM/YYYY HH:mm:ss') + '</strong>' + '</br></br>' + '<strong>' + calEvent.nomepessoa + '</strong>' + '</div></div>';

        var $tooltip = $(tooltip).appendTo('body');

        $(this).mouseover(function(e) {
          $(this).css('z-index', 10000);
          $tooltip.fadeIn('500');
          $tooltip.fadeTo('10', 1.9);
        }).mousemove(function(e) {
          $tooltip.css('top', e.pageY + -140);
          $tooltip.css('left', e.pageX + -100);
        });
      },

      eventMouseout: function(calEvent, jsEvent) {
        $(this).css('z-index', 8);
        $('.tooltipevent').remove();
      },

      //eventRender: function(event, element) {
      //  element.droppable({drop: function() {


     //},
    // })

  //},

 /* eventRender: function(event, element) {
    element.bind('click', function() {
     $('#visualizar #id').val(event.id);
     $('#visualizar #title').val(event.title);
     $('#visualizar #color').val(event.color);
     $('#visualizar #idpessoa').val(event.idpessoa);
     $('#visualizar #nomepessoa').val(event.nomepessoa);
     $('#visualizar').modal('show');


   });
  },

  drop: function(date) {

   $('#external-events .fc-event').each(function() {
     $(this).data('event', {
      title: $.trim($(this).text()),
      color: $(this).attr("id")


    });

   });

   title = $.trim($(this).text());
   start = date.format('YYYY-MM-DD HH:mm:ss');
   end = start;
   color= $(this).attr("id"); 

   Event = [];
   Event[0] = start;
   Event[1] = end;
   Event[2] = title;
   Event[3] = color;

   $.ajax({
    url: 'classes/evento_insert2.php',
    type: "POST",
    data: {Event:Event},
    success: function(rep) {
      if(rep == 'OK'){
        alert('Cadastrado');
      }else{
        window.location.href = 'agenda.php';

        alert('Evento inserido!');

      }
    }
  });

 },

 eventDrop: function(event, delta, revertFunc) { 

  edit(event);

},

eventResize: function(event,dayDelta,minuteDelta,revertFunc) {

  edit(event);

},
*/

events: [

<?php

$i =0;

while ($i < count($linha)) {
  $start = explode(" ", $linha[$i]['datainicio']);
  $end = explode(" ", $linha[$i]['datafim']);
  $color = $linha[$i]['idcolor'];

  if($start[1] == '00:00:00')
  {
    $start = $start[0];
  }
  else
  {
    $start = $linha[$i]['datainicio'];
  }
  if($end[1] == '00:00:00')
  {
    $end = $end[0];
  }
  else
  {
    $end = $linha[$i]['datafim'];
  }


  ?>
  {
    id: '<?php echo $linha[$i]['id']; ?>',
    title: '<?php echo $linha[$i]['nome']; ?>',
    color: '<?php echo $linha[$i]['idcor']; ?>',
    start: '<?php echo $start; ?>',
    end: '<?php echo $end; ?>',
    idpessoa: '<?php echo $linha[$i]['idpessoa']; ?>',
    nomepessoa: '<?php echo $linha[$i]['nomepessoa']; ?>',

  },

  <?php

  $i++;
}

?>

],

});



/*function edit(event){
  start = event.start.format('YYYY-MM-DD HH:mm:ss');
  if(event.end){
    end = event.end.format('YYYY-MM-DD HH:mm:ss');
  }else{
    end = start;
  }

  id =  event.id;

  Event = [];
  Event[0] = id;
  Event[1] = start;
  Event[2] = end;

  $.ajax({
    url: 'classes/evento_update2.php',
    type: "POST",
    data: {Event:Event},
    success: function(rep) {
      if(rep == 'OK'){
        alert('Cadastrado');
      }else{
        alert('Evento Alterado'); 
      }
    }
  });
}



var cores = window.location.search;
cores = cores.substr(5,6);
if(cores == 1){
  alert("inserido com sucesso");
  window.location.href = "agenda.php";
}*/



});

//Mascara para o campo data e hora
function DataHora(evento, objeto){

  var keypress=(window.event)?event.keyCode:evento.which;
  campo = eval (objeto);

  campo = eval (objeto);
  if (campo.value == '00/00/0000 00:00:00'){
    campo.value=""
  }

  caracteres = '0123456789';
  separacao1 = '/';
  separacao2 = ' ';
  separacao3 = ':';
  conjunto1 = 2;
  conjunto2 = 5;
  conjunto3 = 10;
  conjunto4 = 13;
  conjunto5 = 16;
  if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
    if (campo.value.length == conjunto1 )
      campo.value = campo.value + separacao1;
    else if (campo.value.length == conjunto2)
      campo.value = campo.value + separacao1;
    else if (campo.value.length == conjunto3)
      campo.value = campo.value + separacao2;
    else if (campo.value.length == conjunto4)
      campo.value = campo.value + separacao3;
    else if (campo.value.length == conjunto5)
      campo.value = campo.value + separacao3;
  }else{
    event.returnValue = false;
  }
}

</script>
</head>


<body class="bg-light" id="bagenda" >
  <main class="cd-main-content">
    <div class="content-wrapper">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Agenda </h4>
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
      <div style="height: 100px">
        <div class="card">
          <div class="card-body">
            <hr class="mb-4">
            <div id='wrap' id='calendar-container' >
              <div id='calendar'></div>
              <div style='clear:both'></div>
            </div>
          </div>
        </div>
      </div>

</div>
</main>

<!--POPUPS -->
 <?php
    require('agenda_visualizar.php');

    require('agenda_cadastrar.php');
  ?>
<!--FIM POPUPS -->

<script>
  $('.btn-canc-vis').on("click", function() {
    $('.form').slideToggle();
    $('.visualizar').slideToggle();
  });
  $('.btn-canc-edit').on("click", function() {
    $('.visualizar').slideToggle();
    $('.form').slideToggle();

    $('.ed').prop("checked", false);
  });
  $('.fechar').on("click", function() {
    $('.visualizar').slideToggle();
    $('.form').slideToggle();

    $('.ed').prop("checked", false);

  });


  $('#fechar-mensagem').on("click", function() {
   window.location.href = "agenda.php";

 });


  $(document).ready(function() {
    var variavel
    variavel = window.screen.availHeight - 350;
    $('#calendar').fullCalendar('option', 'height', variavel);
  });


      // Example starter JavaScript for disabling form submissions if there are invalid fields
     /* (function() {
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
      })();*/

    </script>
  </body>
  </html>
