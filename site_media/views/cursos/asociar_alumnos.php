<?php  
include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/controller/UsuariosController.php';
// $authC = new AuthController();
// $authC->ChequearAuth(); 

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

      <div class="container_contenido">
          <div class="card">
            <div class="card-header">Cursos - Alumnos</div>
            <div class="card-body">
              <form action="">
                <div class="form-row">
                 <div class="col-md-7 mb-3">
                  <label>Cursos</label>
                    <select class="form-control" name="cursos" id="cursos">
                      <option value="0">Seleccionar..</option>}
                      option
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                  <button class="btn btn-primary asociarmodal" type="button" style="margin-top: 30px;" name="asociar" id="asociar" disabled=""><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar alumno</button>
                  <!-- <label>Alumnos</label>
                  <select class="form-control" name="alumnos" id="alumnos">
                      
                  </select> -->
                </div>
              </div>
              <br>
              <div class="form-row">
                <div class="col-md-12 mb-2">
                  <table id="table_asociados" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Insc.</th>
                        <th>Año</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTablaAsociar">
                    </tbody>
                  </table>
               </div>
               <!--  <button class="btn btn-primary" type="submit" name="asociar" id="asociar">Guardar</button> -->
              </div>
              </form>
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>
  


   </div> 

             <!-- The Modal -->
  <div class="modal fade" id="modalAsociar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Asociar Alumnos</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <form id="formulario_asociar">
              <div class="form-row">
                <div class="col-md-12 mb-2">
                  <table id="table_cursos_asociar" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                    <thead>
                        <th style="width: 20%;">seleccionar</th>
                        <th style="width: 30%;">Documento</th>
                        <th style="width: 50%;">Nombre</th>
                    </thead>
                    <tbody id="cuerpoTablaAsociar">
                    </tbody>
                  </table>
               </div>
            </div>
            <button class="btn btn-primary" type="button" name="asociarAlumno" id="asociarAlumno">Guardar</button>
          </form>
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

  <script src="../../js/cursos/asociar_alumnos.js" type="text/javascript"></script>

</html>