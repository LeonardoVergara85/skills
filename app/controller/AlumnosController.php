<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/model/Personas.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/model/Alumnos.php';

Class AlumnosController extends Alumnos{
	
	private $PersonasModel;

	private $AlumnosModel;

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
		$this->PersonasModel = new Personas();

		$this->AlumnosModel = new Alumnos();

		


		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}

	public function store(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->PersonasModel->_dni = $_POST['docu'];
				$this->PersonasModel->_nombre = $_POST['nom'];
				$this->PersonasModel->_apellido = $_POST['ape'];
				$this->PersonasModel->_domicilio = $_POST['dom'];
				$this->PersonasModel->_telefono = $_POST['tel'];
				$this->PersonasModel->_nacimiento = $_POST['nac'];
				// insertamos en la tabla personas y recuperamos el último id cargado.
				$idPer = $this->PersonasModel->store($conn);

				$this->AlumnosModel->_id_persona = intval($idPer[0]);
				$this->AlumnosModel->_escuela = $_POST['esc'];
				$this->AlumnosModel->_grado_anio = $_POST['grado'];
				$this->AlumnosModel->_email = $_POST['email'];
				$this->AlumnosModel->_hermanos = $_POST['hermanos'];
				$this->AlumnosModel->guardar($conn);

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


	public function show(){

		try {
			
			$alumnos = $this->AlumnosModel->getAlumnos();

			$lista = array();

			foreach ($alumnos as $alumno) {

				array_push($lista, ['id' => $alumno['id'],'dni' => $alumno['dni'],'nombre' => $alumno['nombre'],'apellido' => $alumno['apellido'],'telefono' => $alumno['telefono'],'activo' => $alumno['activo']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

    public function showAlumno(){

		try {
			
			$this->AlumnosModel->_id = $_POST['idAlumno'];

			$alumnos = $this->AlumnosModel->getAlumno();

			$lista = array();

			foreach ($alumnos as $alumno) {

				array_push($lista, ['id' => $alumno['id'],'id_persona' => $alumno['id_persona'],'dni' => $alumno['dni'],'nombre' => $alumno['nombre'],'apellido' => $alumno['apellido'],'domicilio' => $alumno['domicilio'],'telefono' => $alumno['telefono'],'fecha_nac' => $alumno['fecha_nac'],'escuela' => $alumno['escuela'],'grado' => $alumno['grado'],'email' => $alumno['email'],'hermanos' => $alumno['hermanos']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function existe(){

		try {
			
			$this->AlumnosModel->_documento = $_POST['documento'];

			$rta = $this->AlumnosModel->getAlumnoExiste();
			
			if($rta == NULL){

				echo "no_existe";

			}else{
				echo "existe";
			}

		} catch (Exception $e) {
			
			print_r($e);

		}

	} 


	public function showCursosAlumno(){

		try {
			
			$this->AlumnosModel->_id = $_POST['idAlumno'];

			$cursos = $this->AlumnosModel->getCursosAlumno();

			$lista = array();

			foreach ($cursos as $curso) {

				array_push($lista, ['id' => $curso['id'],'fecha' => $curso['fechaac'],'curso' => $curso['descripcion'],'meses' => $curso['meses'],'nombre' => $curso['nombre'],'apellido' => $curso['apellido'],'hermanos' => $curso['hermanos'],'anio' => $curso['anio']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function modAlumno(){

		try {

			  $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->PersonasModel->_id = $_POST['idp'];
				$this->PersonasModel->_dni = $_POST['docu'];
				$this->PersonasModel->_nombre = $_POST['nom'];
				$this->PersonasModel->_apellido = $_POST['ape'];
				$this->PersonasModel->_domicilio = $_POST['dom'];
				$this->PersonasModel->_telefono = $_POST['tel'];
				$this->PersonasModel->_nacimiento = $_POST['nac'];
				$this->PersonasModel->modificar($conn);

				$this->AlumnosModel->_id_persona = $_POST['idp'];
				$this->AlumnosModel->_escuela = $_POST['esc'];
				$this->AlumnosModel->_grado_anio = $_POST['grado'];
				$this->AlumnosModel->_email = $_POST['email'];
				$this->AlumnosModel->_hermanos = $_POST['hermanos'];

				$this->AlumnosModel->modificar($conn);

			 $conn->db->completeTrans();

			echo 'ok';		

		} catch (Exception $e) {
			
			print_r($e);

		}

	}



	public function eliminar(){

		try {

			  $conn = new Conexion();
			
			  $conn->db->startTrans();

				$this->AlumnosModel->_id = $_POST['id_alumno'];
				$this->AlumnosModel->eliminar($conn);

			 $conn->db->completeTrans();

			echo 'ok';		

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


	public function renovar_alumno(){

		try {

			  $conn = new Conexion();
			
			  $conn->db->startTrans();

				$this->AlumnosModel->_id = $_POST['id'];
				$this->AlumnosModel->renovar($conn);

			 $conn->db->completeTrans();

			echo 'ok';		

		} catch (Exception $e) {
			
			print_r($e);

		}

	}




}