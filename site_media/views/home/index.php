<?php  
// $authC->ChequearAuth(); 
// session_start();
// var_dump($_SESSION);

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include_once '../../../public/libs/include_libs_css.html'; ?>
  
  <title>Sistema Skills</title>

</head>
  
<body>

  <?php include_once '../navbar/navbar.php'; ?>

  <div class="row">

      <div class="container_menu">
        <?php include_once '../menu/menu_izquierdo.php'; ?>
      </div> 

      <div class="container_contenido" style="height: 500px;">

       
      </div>

   </div> 
      <div class="modal fade" id="msj_respaldo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content text-center">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4><font color="orange">IMPORTANTE!!!</font></h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <h4>Recuerde realizar los respaldo de información diariamente.</h4>
           <br>
           <h6>Ejecutar como administrador (clic derecho) <STRONG>"RESPALDO-SKILLS"</STRONG> ubicado en el escritorio</h6>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>   

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>
  <script src="../../js/home/home.js" type="text/javascript"></script>
</html>

