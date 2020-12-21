<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/skills/config/Conexion.php';

if ( !isset($_SESSION) ) {

	session_start();

	define( 'MAX_SESSION_TIEMPO', 6000 );

}

/**
* 
*/
class Auth 
{

	private $DB;

	 protected $_id;
 	 protected $_username;
 	 protected $_password;
	
	function __construct()
	{
		$database = new Conexion();
 		$this->DB = $database->db;
	}


    function getAccesSystem(){

 		try {

 			/*
 			 * Buscar USUARIO
 			 */
 			$usernme = $this->_username;
			 $pass = $this->_password;
			 
			$sql = "SELECT * FROM USUARIOS_VW WHERE USERNAME = ? AND PASS = ?";	

 			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
 			
			$usuario = $this->DB->Execute($sql,array($usernme,$pass));


			if( empty($usuario->fields['username']) ){

				return 'no';

			}else{

				/*
				 * Guardar en SESSION
				 */
				// $this->sett_var('user', $user);
				$this->sett_var('user_id', $usuario->fields['id']);
				$this->sett_var('user', $usuario->fields['username']);
				$this->sett_var('user_name', $usuario->fields['nombre']);
				$this->sett_var('user_ape', $usuario->fields['apellido']);
				$this->sett_var('dni', $usuario->fields['dni']);

				return 'ok';

			}


			/*
			 * Buscar Funciones/Acciones permitidas.
			 */
			// $this->getFuncionesDePerfil();

			
		} catch (Exception $e) {

			echo 'getAccesSystem';
			
			print_r($e);

		}

 	}


 	// function getFuncionesDePerfil(){

 	// 	try {

 	// 		$id_perfil = $this->gett_var('id_perfil');

	 // 		/*
		// 	 * Buscar FUNCIONES/ACCIONES DEL PERFIL
		// 	 */
		// 	$sql1 = "SELECT * FROM bdu_func_acc_perfiles_vw WHERE pfl_id = :id_perf";	

		// 	$stmt1 = $this->DB->Prepare($sql1);

		// 	$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);
		// 	$this->DB->InParameter($stmt1, $id_perfil, 'id_perf');
				
		// 	$funciones = $this->DB->Execute($stmt1);

		// 	$_SESSION['funciones'] = array();

		// 	foreach ($funciones as $row) {
				
		// 		array_push($_SESSION['funciones'], array('url' => $row['FSI_DESCRIPCION'], 'accion' => $row['ACC_DESCRIPCION']));

		// 	}
 			
 	// 	} catch (Exception $e) {
 			
 	// 		print_r($e);

 	// 	}

 	// }



 	/*
 	 * Permiso para acceder a la pagina
 	 */
 	function url_access($url){

 		$ok = false;

 		foreach ($_SESSION['funciones'] as $permiso) {
 			
 			if($permiso['url'] == $url){

 				$ok = true;
 				
 				return $ok;

 			}

 		}

 		return $ok;

 	}




 	/*
 	 * Acciones permitidas en una url determinada
 	 */
 	function url_actions($url){

 		$lista = array();

 		foreach ($_SESSION['funciones'] as $permiso) {
 			
 			if($permiso['url'] == $url){

 				array_push($lista, $permiso['accion']);

 			}

 		}

 		return $lista;

 	}


	function checkAuth(){

		if (isset($_SESSION['user'])) {

			return 'ok';

		}else{

			return 'false';

		}

	}


	function ChekTimeSession(){

		// Controla cuando se ha creado y cuando tiempo ha recorrido 
		if ( isset( $_SESSION[ 'ULTIMA_ACTIVIDAD' ] ) && ( time() - $_SESSION[ 'ULTIMA_ACTIVIDAD' ] > MAX_SESSION_TIEMPO ) ) {

		    // Si ha pasado el tiempo sobre el limite destruye la session
			return 'out';

		}

		$_SESSION[ 'ULTIMA_ACTIVIDAD' ] = time();

		return 'ok';

	}


	function sett_var($name, $value){

		$_SESSION[$name] = $value;

	}


	function gett_var($name){

		if( isset($_SESSION[$name]) ) {

			return $_SESSION[$name];

		}else{

			return 'Error Session';

		}
		
	}


}