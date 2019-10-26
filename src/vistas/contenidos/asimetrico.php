<?php
	function contenido() {
?>
		<div id="asimetrico" class="w algoritmo">
			
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
					<li><a href="#rsa">RSA</a></li>
					<li><a href="#openpgp">OpenPGP</a></li>
					<li><a href="#dsa">DSA</a></li>
				</ul>
			</div>
			<div id="contenido">
								
				<div id="rsa">
					<div class="cifrado">
						<h2 class="t">RSA :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . 'rsa-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar"></textarea>
							</p>
							<p>
								<strong>Llave pública: </strong><br />
								<textarea name="llave" readonly="readonly"><?php echo RSA_PUBLIC_KEY; ?></textarea>
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
						<h2 class="t">RSA :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . 'rsa-dec/'; ?>" method="post" enctype="multipart/form-data">
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
								<strong>Llave pública: </strong><br />
								<textarea name="llave" readonly="readonly"><?php echo RSA_PUBLIC_KEY; ?></textarea>
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
				
				<div id="openpgp">
					<div class="cifrado">
						<h2 class="t">OpenPGP :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . 'openpgp-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar"></textarea>
							</p>
							<p>
								<strong>Llave pública: </strong><br />
								<textarea name="llave" readonly="readonly"><?php echo OPENPGP_KEY; ?></textarea>
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
						<h2 class="t">OpenPGP :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . 'openpgp-dec/'; ?>" method="post" enctype="multipart/form-data">
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
								<strong>Llave pública: </strong><br />
								<textarea name="llave" readonly="readonly"><?php echo OPENPGP_KEY; ?></textarea>
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
				
				<div id="dsa">
					<div class="cifrado">
						<h2 class="t">DSA :: Cifrado</h2>
						<form class="cifrado" action="<?php echo URL_SERVICIOS . 'dsa-enc/'; ?>" method="post">
							<p>
								<textarea name="texto" placeholder="Texto a cifrar" maxlength="500"></textarea>
							</p>
							<p>
								<strong>Llave pública: </strong><br />
								<textarea name="llave" readonly="readonly"><?php echo DSA_PUBLIC_KEY; ?></textarea>
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
						<h2 class="t">DSA :: Descifrado</h2>
						<form class="descifrado" action="<?php echo URL_SERVICIOS . 'dsa-dec/'; ?>" method="post" enctype="multipart/form-data">
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
								<strong>Llave pública: </strong><br />
								<textarea name="llave" readonly="readonly"><?php echo DSA_PUBLIC_KEY; ?></textarea>
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