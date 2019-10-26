<?php
	function contenido() {
?>
		<div id="simetrico" class="w algoritmo">
			
			<div id="errorDialog">
				<p>
					Hubo un error en su solicitud y puede deberse a una de las siguientes causas:
				</p>
				<ul>
					<li>El archivo binario no corresponde al algoritmo seleccionado.</li>
					<li>La llave proporcionada no es la indicada para el mensaje cifrado.</li>
					<li>El tamaño de la llave en bits no corresponde al mensaje cifrado.</li>
				</ul>
				<div class="cerrar">
					<input id="errorDialogClose" type="button" value="Aceptar" />
				</div>
			</div>
			
			<div id="menuLat">
				<h2>Algoritmos</h2>
				<ul>
					<li><a href="#des">DES</a></li>
					<li><a href="#triple-des">Triple DES</a></li>
					<li><a href="#blowfish">Blowfish</a></li>
					<li><a href="#aes">AES</a></li>
				</ul>
			</div>
			<div id="contenido">
				<div id="des">
					<div class="cifrado">
						<h2 class="t">DES :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . 'des-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar"></textarea>
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo DES_KEY; ?>" size="<?php echo strlen(DES_KEY); ?>" />
							</p>
							<p class="submit">
								<input type="submit" value="Cifrar" />
							</p>
						</form>
						<form class="resultado" action="<?php echo URL_SERVICIOS . 'descargar/'; ?>" method="post" target="_blank">
							<input type="hidden" name="tipo" />
							<input type="hidden" name="descarga" />
							<input type="hidden" name="llave" />
							<p>
								<strong>Resultado en base64: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
							<div>
								<input class="download-key" type="button" value="Descargar llave" />
								<input class="download-bin" type="button" value="Descargar binario" />
							</div>
						</form>
					</div>
					<div class="descifrado">
						<h2 class="t">DES :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . 'des-dec/'; ?>" method="post" enctype="multipart/form-data">
							<p>
								<select name="tipoInput">
									<option value="base64">Descifrar texto en base64</option>
									<option value="binario">Descifrar archivo binario</option>
								</select>
							</p>
							<p class="input base64">
								<textarea name="texto" placeholder="Texto en base64 a descifrar"></textarea>
							</p>
							<p class="input binario">
								<strong>Archivo binario a descifrar: </strong><input type="file" name="binario" />
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo DES_KEY; ?>" size="<?php echo strlen(DES_KEY); ?>" />
							</p>
							<p class="submit">
								<input type="submit" value="Descifrar" />
							</p>
						</form>
						<form class="resultado" action="#" method="post">
							<p>
								<strong>Resultado: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
						</form>
					</div>
				</div>
				
				<div id="triple-des">
					<div class="cifrado">
						<h2 class="t">Triple DES :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . '3des-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar"></textarea>
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo TRIPLE_DES_KEY; ?>" size="<?php echo strlen(TRIPLE_DES_KEY); ?>" />
							</p>
							<p class="submit">
								<input type="submit" value="Cifrar" />
							</p>
						</form>
						<form class="resultado" action="<?php echo URL_SERVICIOS . 'descargar/'; ?>" method="post" target="_blank">
							<input type="hidden" name="tipo" />
							<input type="hidden" name="descarga" />
							<input type="hidden" name="llave" />
							<p>
								<strong>Resultado en base64: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
							<div>
								<input class="download-key" type="button" value="Descargar llave" />
								<input class="download-bin" type="button" value="Descargar binario" />
							</div>
						</form>
					</div>
					<div class="descifrado">
						<h2 class="t">Triple DES :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . '3des-dec/'; ?>" method="post" enctype="multipart/form-data">
							<p>
								<select name="tipoInput">
									<option value="base64">Descifrar texto en base64</option>
									<option value="binario">Descifrar archivo binario</option>
								</select>
							</p>
							<p class="input base64">
								<textarea name="texto" placeholder="Texto en base64 a descifrar"></textarea>
							</p>
							<p class="input binario">
								<strong>Archivo binario a descifrar: </strong><input type="file" name="binario" />
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo TRIPLE_DES_KEY; ?>" size="<?php echo strlen(TRIPLE_DES_KEY); ?>" />
							</p>
							<p class="submit">
								<input type="submit" value="Descifrar" />
							</p>
						</form>
						<form class="resultado" action="#" method="post">
							<p>
								<strong>Resultado: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
						</form>
					</div>
				</div>
				
				<div id="blowfish">
					<div class="cifrado">
						<h2 class="t">Blowfish :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . 'blowfish-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar"></textarea>
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo BLOWFISH_KEY; ?>" size="<?php echo strlen(BLOWFISH_KEY); ?>" />
							</p>
							<p class="submit">
								<input type="submit" value="Cifrar" />
							</p>
						</form>
						<form class="resultado" action="<?php echo URL_SERVICIOS . 'descargar/'; ?>" method="post" target="_blank">
							<input type="hidden" name="tipo" />
							<input type="hidden" name="descarga" />
							<input type="hidden" name="llave" />
							<p>
								<strong>Resultado en base64: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
							<div>
								<input class="download-key" type="button" value="Descargar llave" />
								<input class="download-bin" type="button" value="Descargar binario" />
							</div>
						</form>
					</div>
					<div class="descifrado">
						<h2 class="t">Blowfish :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . 'blowfish-dec/'; ?>" method="post" enctype="multipart/form-data">
							<p>
								<select name="tipoInput">
									<option value="base64">Descifrar texto en base64</option>
									<option value="binario">Descifrar archivo binario</option>
								</select>
							</p>
							<p class="input base64">
								<textarea name="texto" placeholder="Texto en base64 a descifrar"></textarea>
							</p>
							<p class="input binario">
								<strong>Archivo binario a descifrar: </strong><input type="file" name="binario" />
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo BLOWFISH_KEY; ?>" size="<?php echo strlen(BLOWFISH_KEY); ?>" />
							</p>
							<p class="submit">
								<input type="submit" value="Descifrar" />
							</p>
						</form>
						<form class="resultado" action="#" method="post">
							<p>
								<strong>Resultado: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
						</form>
					</div>
				</div>
				
				<div id="aes">
					<div class="cifrado">
						<h2 class="t">AES :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . 'aes-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar"></textarea>
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo AES_KEY; ?>" size="<?php echo strlen(AES_KEY); ?>" />
							</p>
							<p>
								<select name="blockSize">
									<option value="128">128 bits</option>
									<option value="192">192 bits</option>
									<option value="256">256 bits</option>
								</select>
							</p>
							<p class="submit">
								<input type="submit" value="Cifrar" />
							</p>
						</form>
						<form class="resultado" action="<?php echo URL_SERVICIOS . 'descargar/'; ?>" method="post" target="_blank">
							<input type="hidden" name="tipo" />
							<input type="hidden" name="descarga" />
							<input type="hidden" name="llave" />
							<p>
								<strong>Resultado en base64: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
							<div>
								<input class="download-key" type="button" value="Descargar llave" />
								<input class="download-bin" type="button" value="Descargar binario" />
							</div>
						</form>
					</div>
					<div class="descifrado">
						<h2 class="t">AES :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . 'aes-dec/'; ?>" method="post" enctype="multipart/form-data">
							<p>
								<select name="tipoInput">
									<option value="base64">Descifrar texto en base64</option>
									<option value="binario">Descifrar archivo binario</option>
								</select>
							</p>
							<p class="input base64">
								<textarea name="texto" placeholder="Texto en base64 a descifrar"></textarea>
							</p>
							<p class="input binario">
								<strong>Archivo binario a descifrar: </strong><input type="file" name="binario" />
							</p>
							<p>
								<strong>Llave: </strong><br />
								<input type="text" name="llave" value="<?php echo AES_KEY; ?>" size="<?php echo strlen(AES_KEY); ?>" />
							</p>
							<p>
								<select name="blockSize">
									<option value="128">128 bits</option>
									<option value="192">192 bits</option>
									<option value="256">256 bits</option>
								</select>
							</p>
							<p class="submit">
								<input type="submit" value="Descifrar" />
							</p>
						</form>
						<form class="resultado" action="#" method="post">
							<p>
								<strong>Resultado: </strong><br />
								<textarea name="data" readonly="readonly"></textarea>
							</p>
						</form>
					</div>
				</div>
				
			</div>
			
		</div>
<?php
	}
?>