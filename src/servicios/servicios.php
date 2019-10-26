<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/config/constantes.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/server/class.CifradoSimetrico.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/phpseclib/Math/BigInteger.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/phpseclib/Crypt/RSA.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/phpseclib/Crypt/AES.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/phpseclib/Crypt/TripleDES.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/phpseclib/Crypt/Random.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/openpgp-php/openpgp.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/openpgp-php/openpgp_crypt_rsa.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/libs/openpgp-php/openpgp_crypt_symmetric.php';
	
	$post = (object) $_POST;
	$get = (object) $_GET;
	$accion = array_shift($params);
	
	switch ($accion) {
		case 'descargar':
			if ($post->descarga == 'llave') {
				$data = $post->llave;
				header("Content-Disposition: attachment; filename=php-{$post->tipo}.key");
				header('Content-Type: text/plain');
				header('Content-Length: ' . strlen($data));
				header('Connection: close');
				echo $data;
			}
			else {
				$data = base64_decode($post->data);
				header("Content-Disposition: attachment; filename=php-{$post->tipo}.bin");
				header('Content-Type: application/octet-stream');
				header('Content-Length: ' . strlen($data));
				header('Connection: close');
				echo $data;
			}
			exit();
			break;
		
		case 'des-enc':
			$cs = new CifradoSimetrico('des');
			$data = $cs->cifrar($post->texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'des', 
				'llave' => $post->llave, 
			));
			break;
			
		case 'des-dec':
			$cs = new CifradoSimetrico('des');
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			$data = $cs->descifrar($texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
			
		case '3des-enc':
			$cs = new CifradoSimetrico('3des');
			$data = $cs->cifrar($post->texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'triple-des', 
				'llave' => $post->llave,
			));
			break;
			
		case '3des-dec':
			$cs = new CifradoSimetrico('3des');
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			$data = $cs->descifrar($texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
			
		case 'blowfish-enc':
			$cs = new CifradoSimetrico('blowfish');
			$data = $cs->cifrar($post->texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'blowfish', 
				'llave' => $post->llave,
			));
			break;
			
		case 'blowfish-dec':
			$cs = new CifradoSimetrico('blowfish');
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			$data = $cs->descifrar($texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
			
		case 'aes-enc':
			$cs = new CifradoSimetrico('aes'.$post->blockSize);
			$data = $cs->cifrar($post->texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'aes-'.$post->blockSize, 
				'llave' => $post->llave,
			));
			break;
			
		case 'aes-dec':
			$cs = new CifradoSimetrico('aes'.$post->blockSize);
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			$data = $cs->descifrar($texto, $post->llave);
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
			
		case 'dsa-enc':
			openssl_public_encrypt($post->texto, $data, DSA_PUBLIC_KEY);
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'dsa',
				'llave' => DSA_PUBLIC_KEY,
			));
			break;
			
		case 'dsa-dec':
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			openssl_private_decrypt($texto, $data, DSA_PRIVATE_KEY);
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
			
		case 'rsa-enc':
			$rsa = new Crypt_RSA();
			$rsa->loadKey(RSA_PUBLIC_KEY);
			$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
			$data = $rsa->encrypt($post->texto);
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'rsa',
				'llave' => RSA_PUBLIC_KEY,
			));
			break;
			
		case 'rsa-dec':
			$rsa = new Crypt_RSA();
			$rsa->loadKey(RSA_PRIVATE_KEY);
			$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			$data = $rsa->decrypt($texto);
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
			
		case 'openpgp-enc':
			$key = OpenPGP_Message::parse(base64_decode(OPENPGP_KEY));
			$dataToEncrypt = new OpenPGP_LiteralDataPacket($post->texto);
			$encrypted = OpenPGP_Crypt_Symmetric::encrypt($key, new OpenPGP_Message(array($dataToEncrypt)));
			$data = $encrypted->to_bytes();
			echo json_encode( array( 
				'code' => 0, 
				'data' => base64_encode($data), 
				'tipo' => 'openpgp',
				'llave' => OPENPGP_KEY,
			));
			break;
			
		case 'openpgp-dec':
			$key = OpenPGP_Message::parse(base64_decode(OPENPGP_KEY));
			$texto = ($post->tipoInput == 'binario') ? file_get_contents($_FILES['binario']['tmp_name']) : base64_decode($post->texto);
			$decryptor = new OpenPGP_Crypt_RSA($key);
			$decrypted = $decryptor->decrypt( $texto );
			$data = $decrypted->packets[0]->data;
			echo json_encode( array( 
				'code' => 0, 
				'data' => $data 
			));
			break;
	}
?>