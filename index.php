<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/src/config/constantes.php';
	
	$ruta = ltrim($_SERVER['REQUEST_URI'], '/');
	$arr_ruta = explode('/', $ruta);
	
	$pag = '/' . array_shift($arr_ruta) . '/';
	$params = $arr_ruta;
	
	switch($pag) {
		case '//':
		case URL_INICIO:
			$pagScript = 'inicio';
			break;
		case URL_SIMETRICO:
			$pagScript = 'simetrico';
			break;
		case URL_ASIMETRICO:
			$pagScript = 'asimetrico';
			break;
		case URL_SERVICIOS:
			require_once $_SERVER['DOCUMENT_ROOT'] . "/src/servicios/servicios.php";
			exit();
			break;
		default:
			header('HTTP/1.1 404 Not Found');
			exit('Error 404');
	}
	
	include $_SERVER['DOCUMENT_ROOT'] . "/src/vistas/contenidos/{$pagScript}.php";
	include $_SERVER['DOCUMENT_ROOT'] . '/src/vistas/plantillas/public.php';
?>
