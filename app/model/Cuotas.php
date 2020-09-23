<?php

 /**
 * 
 */

 // class Gastos extends TipoGasto{
  class Cuotas{	
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_id_alumno_curso;
 	 protected $_id_alumno;
 	 protected $_id_curso;
 	 protected $_id_importe;
 	 protected $_tipo_pago;
 	 protected $_fecha_vencimiento;
 	 protected $_fecha_pago;
 	 protected $_descuento;
 	 protected $_interes;
 	 protected $_observaciones;
 	 protected $_numero;

 


	/***********************
	 * **** GETTERS ********
	 * *********************
	 */

	
	/***********************
	 * **** FIN GETTERS ********
	 * *********************
	 */

 	function __construct(){

 		$database = new Conexion();
 		$this->DB = $database->db;
 	}

 	public function guardar($conn){

 		try {

 			  $id = NULL;
		 	  $idac = $this->_id_alumno_curso;
		 	  $idpago = $this->_tipo_pago;
		 	  $fechav = $this->_fecha_vencimiento;
		 	  $fechap  = '0000-00-00';
		 	  $desc = 0;
		 	  $int = 0;
		 	  $obs = $this->_observaciones;
		 	  $num = $this->_numero;
		 	  $idi = $this->_id_importe;

 			$sql = "INSERT INTO `cuota` VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        	$conn->db->Execute($sql,array($idac,$idpago,$fechav,$fechap,$desc,$int,$obs,$num,$idi));


 		   } catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}
 	public function cambiarCosto($conn,$idcur,$idimp){

 		try {

		 	  $idc = $idcur;
		 	  $idimp = $idimp;

 		$sql = "UPDATE cuota SET id_importe = ?
				WHERE id_alumno_curso IN (SELECT id FROM alumno_curso WHERE id_curso = ?)
				AND fecha_vencimiento > NOW() AND fecha_pago IS NULL";

        	$conn->db->Execute($sql,array($idimp,$idc));


 		   } catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}
 	public function updateCuotas($conn){

 		try {

 			  $id = NULL;
		 	  $idac = $this->_id_alumno_curso;
		 	  $idpago = $this->_tipo_pago;
		 	  $fechav = $this->_fecha_vencimiento;
		 	  $fechap  = '0000-00-00';
		 	  $desc = 0;
		 	  $int = 0;
		 	  $obs = $this->_observaciones;
		 	  $num = $this->_numero;

 			$sql = "INSERT INTO `cuota` VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";

        	$conn->db->Execute($sql,array($idac,$idpago,$fechav,$fechap,$desc,$int,$obs,$num));


 		   } catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function pagar($conn){

 		try {

 			$id = $this->_id;
 			$desc = $this->_descuento;
 			$int = $this->_interes;
 			$tipo = $this->_tipo_pago;
 
 			$sql = "UPDATE cuota SET fecha_pago = NOW(), descuento = ?, interes = ?, observaciones = '', id_tipo_pago = ? WHERE id = ?";

        	$conn->db->Execute($sql,array($desc,$int,$tipo,$id));

        	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

        	$sql2 = "SELECT total,fechapago FROM cuotas_vw WHERE id = ?";

        	$fila = $conn->db->Execute($sql2,array($id));

        	return $fila->fields;
        	

 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getCuotas(){

 		try {	

 			$idalumnoCurso = $this->_id_alumno_curso;

 			$sql = "SELECT * FROM cuotas_vw WHERE id_alumno_curso = ? ORDER BY nro_cuota asc";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql,array($idalumnoCurso));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getCuotaPrint(){

 		try {	

 			$id = $this->_id;

 			$sql = "SELECT * FROM cuotas_vw WHERE id = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getBalanceMensual($mes,$anio){

 		try {	


 			$sql = "SELECT * FROM balance_diario_vw WHERE MONTH(fech) = ? AND YEAR(fech) = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql,array($mes,$anio));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getBalanceFecha($desde,$hasta){

 		try {	


 			$sql = "SELECT * 
					FROM balance_diario_vw 
					WHERE fech BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) order by fech";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql,array($desde,$hasta));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 		public function getBalanceFechaEfectivo($desde,$hasta){

 		try {	


 			$sql = "SELECT * FROM balance_diario_vw 
					WHERE fech BETWEEN CAST(? AS DATE) AND CAST(? AS DATE)
					AND pagadopor <> 'débito'
					AND pagadopor <> 'transferencia bancaria'
					AND pagadopor <> 'otro'
					ORDER BY fech";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql,array($desde,$hasta));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}		



 	public function getBalanceDiario(){

 		try {	


 			$sql = "SELECT * FROM balance_diario_vw WHERE fech = DATE_FORMAT(NOW(),'%Y-%m-%d')";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getCuotasVencidasAHoy(){

 		try {	


 			$sql = "SELECT * FROM cuotas_vw WHERE fecha_pago = '0000-00-00' AND fecha_vencimiento < NOW()";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getCuotasRango($desde,$hasta,$tipo){

 		try {	

 			$tipoconsulta = $tipo;
 			
 			if($tipoconsulta == 0){

 				$sql = "SELECT * FROM cuotas_vw
					WHERE fecha_vencimiento BETWEEN CAST(? AS DATE) AND CAST(? AS DATE)";

 			}else if($tipoconsulta == 1){

 				$sql = "SELECT * FROM cuotas_vw
					WHERE fecha_vencimiento BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) AND fecha_pago = '0000-00-00'";

 			}else if($tipoconsulta == 2){

 				$sql = "SELECT * FROM cuotas_vw
					WHERE fecha_vencimiento BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) AND fecha_pago <> '0000-00-00'";

 			}

 			

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$filas = $this->DB->Execute($sql,array($desde,$hasta));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }