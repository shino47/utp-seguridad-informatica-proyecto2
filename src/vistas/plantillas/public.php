<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<title>Seguridad en Sistemas de Información :: Proyecto #2</title>
		<link rel="stylesheet" type="text/css" href="/css/tooltipster.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/css/tooltipster-themes/seg.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="/css/avatarDialog.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/css/estilos.css?v=1.0.2" media="screen" />
		<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="/js/jquery-ui-1.10.4.batusai.min.js"></script>
		<script type="text/javascript" src="/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/js/jquery.tooltipster.min.js"></script>
		<script type="text/javascript" src="/js/jquery.avatarDialog.js"></script>
		<script type="text/javascript" src="/js/funciones.js?v=1.0.1" charset="UTF-8"></script>
	</head>
	<body>
		<div id="contenedor">
			<div id="encabezado">
				<div class="w">
					<p>
						<a href="/">
							<span>Seguridad en Sistemas de Información</span>
							<span class="sub">Proyecto Semestral</span>
						</a>
					</p>
				</div>
			</div>
			<div id="menu">
				<ul>
					<li><a href="/">Inicio</a></li>
					<li><a href="<?php echo URL_SIMETRICO; ?>">Algoritmos de clave Simétrica</a></li>
					<li><a href="<?php echo URL_ASIMETRICO; ?>">Algoritmos de clave Asimétrica</a></li>
					<li><a href="/media/manual.pdf" target="_blank">Manual de Usuario</a></li>
					<li><a href="/media/documentacion.pdf" target="_blank">Documentación técnica</a></li>
				</ul>
			</div>
			<div id="cuerpo">
				<?php if (function_exists('contenido')) contenido(); ?>
			</div>
			<div id="pie">
				<div class="w">
					<table>
						<tr>
							<td class="t1">
								<p>Universidad Tecnológica de Panamá</p>
								<p>Facultad de Ingeniería de Sistemas Computacionales</p>
								<p>Licenciatura en Desarrollo de Software</p>
								<p>Julio, 2014</p>
							</td>
							<td class="t2">
								<p>Profesor: Saulo Aizprúa</p>
								<p>Grupo: 1LS241</p>
							</td>
							<td class="t3">
								<p>Integrantes:</p>
								<ul>
									<li>Andrade, Óscar</li>
									<li>Estrada, Demetrio</li>
									<li>Lau, Francisco</li>
									<li>Zamorano, Corina</li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>