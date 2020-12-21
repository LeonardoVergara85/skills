<?php
include_once 'Personas.php';

 /**
 * 
 */
 class Alumnos extends Personas{
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_id_persona;
 	 protected $_escuela;
 	 protected $_grado_anio;
 	 protected $_email;
 	 protected $_hermanos;


	/***********************
	 * **** GETTERS ********
	 * *********************
	 */

	public function getId()
	{
	    return $this->_id;
	}
	public function getIdPersona()
	{
	    return $this->_id_persona;
	}

	public function getEscuela()
	{
	    return $this->_escuela;
	}

	public function getGrado()
	{
	    return $this->_grado_anio;
	}

	public function getEmail()
	{
	    return $this->_email;
	}

	public function getHermanos()
	{
	    return $this->_hermanos;
	}

	/***********************
	 * **** FIN GETTERS ********
	 * *********************
	 */

 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}

 	public function guardar($conn){

 		try {

 			$id = null;
 			$idper = $this->_id_persona;
 			$esc = $this->_escuela;
 			$g_a = $this->_grado_anio;
 			$email = $this->_email;
 			$her = $this->_hermanos;

 			$sql = "INSERT INTO alumnos VALUES (?, ?, ?, ?, ?, ?)";

        	$conn->db->Execute($sql,array($id,$idper,$esc,$g_a,$email,$her));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function modificar($conn){

 		try {

 			$idper = $this->_id_persona;
 			$esc = $this->_escuela;
 			$g_a = $this->_grado_anio;
 			$email = $this->_email;
 			$her = $this->_hermanos;

 			$sql = "UPDATE alumnos SET escuela = ?, grado= ?, email= ?, hermanos= ?
                    WHERE id_persona = ?";

        	$conn->db->Execute($sql,array($esc,$g_a,$email,$her,$idper));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

	 }
	 
	 public function eliminarAlumno($conn){

		try {

			$id_alu = $this->_id;

			$sql = "UPDATE alumnos SET ACTIVO = 'N' WHERE ID = ? ";

		   $conn->db->Execute($sql,array($id_alu));


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}

	public function renovar($conn){

		try {

			$id_alu = $this->_id;

			$sql = "UPDATE alumnos SET ACTIVO = 'S' WHERE ID = ? ";

		   $conn->db->Execute($sql,array($id_alu));


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}


 	public function getAlumnos(){

 		try {

 			$sql = "SELECT * FROM alumnos_vw ORDER BY apellido";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getAlumno(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT * FROM alumnos_vw where id = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getAlumnoExiste(){

 		try {

 			$doc = $this->_documento;

 			$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

 			$sql = "SELECT id FROM alumnos_vw where dni = ?";


			$fila = $this->DB->Execute($sql,array($doc));

			return $fila->fields;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getCursosAlumno(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT * FROM ALUMNO_CURSO_VW WHERE ID_ALUMNO = ? AND VIGENTE = 'S' ";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }