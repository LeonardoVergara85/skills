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
            <div class="card-header">Balance Diario <p class="text_right" id="buscando" style="margin-left:400px;margin-top:-27px;">Buscando ...</p></div>
            <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#hoy">Libro diario</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#buscar_balance_fecha">Buscar por fecha</a>
            </li>
          </ul>
          <div class="spinner-border text-primary"></div>
          <!-- Tab panes -->
          <div class="tab-content">
            <div id="hoy" class="container tab-pane active"><br>
              <table id="table_balance_diario" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Denominación</th>
                    <th>Detalle</th>
                    <th>Debe</th>
                    <th>Haber</th>
                    <th>Saldo</th>
                    <th>Método</th>
                  </tr>
                </thead>
                <tbody id="cuerpoTablaBalance">
                </tbody>
              </table>
            </div>
            <div id="buscar_balance_fecha" class="container tab-pane fade"><br>
              <form action="" id="form-bucar_fecha_balance">
                <div class="form-row">
                  <div class="col-md-4 mb-2">
                    <label>Desde</label>
                    <input class="form-control" type="date" name="fechadesde_" id="fechadesde_">
                  </div>
                  <div class="col-md-4 mb-2">
                    <label>Hasta</label>
                    <input class="form-control" type="date" name="fechahasta_" id="fechahasta_">
                  </div>
                  <div class="col-md-2 mb-2">
                    <button class="btn btn-info btn-sm" type="submit" style="margin-top: 35px;"><i class="fas fa-search"></i> Buscar</button>
                  </div>
                  <div class="col-md-2 mb-2">
                    Solo efectivo <input type="checkbox" class="form-control" id="solo_efectivo" name="solo_efectivo">
                  </div>
                </div>
              </form>
              <br>
              <table id="table_gastos_fecha" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Denominación</th>
                    <th>Detalle</th>
                    <th>Debe</th>
                    <th>Haber</th>
                    <th>Saldo</th>
                    <th>Método</th>
                  </tr>
                </thead>
                <tbody id="">
                </tbody>
              </table>
            </div>
          </div>
          
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
       <!--  TOTAL
        <input type="text" value="" id="tot"> -->
      </div>

   </div>   

          <!-- The Modal -->
  <div class="modal fade" id="modalDetalleGasto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detalle del Gasto</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form id="formulario_mod_gastos">
              <div class="form-row">
              <div class="col-md-8 mb-2">
                <label for="validationGradoanio">Denominaciones</label>
                <select  class="form-control" id="tipo_gasto_" name="tipo_gasto_">
                
                </select>
              </div>
              <div class="col-md-4 mb-2">
                <label>Importe</label>
                <input class="form-control" type="text" name="importe_" id="importe_">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-2">
                <label>Observaciones</label>
                <input class="form-control" type="text" name="observaciones_" id="observaciones_">
              </div>
            </div>
            <div class="form-row">
            <div class="col-md-8 mb-2">
                <label>Pagado por</label>
                <select class="form-control" name="pagadopor_" id="pagadopor_">
                  <option value="1">Caja chica</option>
                  <option value="2">Graciela</option>
                  <option value="3">Maria Emma</option>
                </select>
            </div>
          </div>
            
            <button class="btn btn-primary" type="submit" name="modificargasto" id="modificargasto">
              Modificar
            </button>
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

  <script src="../../js/reportes/balance_diario.js" type="text/javascript"></script>

</html>