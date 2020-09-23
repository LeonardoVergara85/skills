<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/model/AlumnoCurso.php';


Class AlumnoCursoController extends AlumnoCurso{
	
	private $AlumnoCursoModel;
	private $CuotasModel;

	/**
	 * [__construct Inicializa el Controlador]
	 * @param [type] $function [Funcion a ejecutar]
	 */
	function __construct($function){

		/**
		 * 
		 * 	$this->Cargo description: 
		 * 	Se inicializa el Objeto, el cual es el Modelo para la BD. 
		 * 	IMPORTANTE: Este Objeto ya inicializa la conexion con la DB a traves del atributo
		 * 	$this->Modelo->DB.
		 * 	
		 */

		$this->AlumnoCursoModel = new AlumnoCurso();
		$this->CuotasModel = new Cuotas();

		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}




	public function showCurso(){

		$this->AlumnoCursoModel->_id_curso = $_POST['idcurso'];

		try {
			
			if(isset($_POST['anio'])){

				$anio = $_POST['anio'];

				$tipos = $this->AlumnoCursoModel->getAlumnosCursoPorAnio($anio);

			}else{

				$tipos = $this->AlumnoCursoModel->getAlumnosCurso();

			}

			

			

			$lista = array();

			foreach ($tipos as $tipo) {

				array_push($lista, ['id' => $tipo['id'],'descripcion' => $tipo['descripcion'],'dni' => $tipo['dni'],'nombre' => $tipo['nombre'],'apellido' => $tipo['apellido'],'fecha' => $tipo['fechaac'],'anio' => $tipo['anio'],'alu_activo' => $tipo['alu_activo']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showAlumnosNoAsoc(){

		try {


			$this->AlumnoCursoModel->_id_curso = $_POST['idcurso'];

			$alumnos = $this->AlumnoCursoModel->getAlumnosNoAsociado();

			$lista = array();

			foreach ($alumnos as $alumno) {

				array_push($lista, ['id' => $alumno['id'],'dni' => $alumno['dni'],'apellido' => $alumno['apellido'],'nombre' => $alumno['nombre'],'alu_activo' => $alumno['alu_activo']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function asociarAlumnos(){

		try {

			 $conn = new Conexion();
			
			 $conn->db->startTrans();

			 $this->AlumnoCursoModel->_id_curso = $_POST['idcurso'];
			 // $meses = $this->AlumnoCursoModel->getAlumnosCursoMeses($conn);

			 $lista = array();

			 $lista = $_POST['alumnos'];		
			 // $mesescurso = $meses[0];
			 $mesescurso = $_POST['meses'];
			 $id_importe = $_POST['id_imp'];

			///////////////////////////////////////////////////////////////

			foreach ($lista as $valores) {

				$this->AlumnoCursoModel->_id_alumno = $valores;
				$id_alu_cur = $this->AlumnoCursoModel->guardar($conn);
				
				for($i = 1; $i <= $mesescurso; $i++){
					$mes = 2+$i;
					$this->CuotasModel->_id_alumno_curso = $id_alu_cur[0];
					$this->CuotasModel->_tipo_pago = 1;
					$this->CuotasModel->_fecha_vencimiento = '2019-'.$mes.'-15';
					$this->CuotasModel->_observaciones = '';
					$this->CuotasModel->_numero = $i;
					$this->CuotasModel->_id_importe = $id_importe;
					$this->CuotasModel->guardar($conn);
				}				
				

			}

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

 






}