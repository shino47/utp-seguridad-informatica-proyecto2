<?php
	class CifradoSimetrico {
		private $cipher = MCRYPT_DES;
		private $mode = MCRYPT_MODE_ECB;
		private $iv = NULL;
		
		public function __construct($cipher) {
			$this->setCipher($cipher);
		}
		
		private function setCipher($cipher) {
			switch ($cipher) {
				case 'des':
					$this->cipher = MCRYPT_DES;
					break;
				case '3des':
					$this->cipher = MCRYPT_3DES;
					break;
				case 'blowfish':
					$this->cipher = MCRYPT_BLOWFISH;
					break;
				case 'aes128':
					$this->cipher = MCRYPT_RIJNDAEL_128;
					break;
				case 'aes192':
					$this->cipher = MCRYPT_RIJNDAEL_192;
					break;
				case 'aes256':
					$this->cipher = MCRYPT_RIJNDAEL_256;
					break;
			}
		}
		
		private function getIV() {
			if ($this->iv == NULL) {
				$this->iv = mcrypt_create_iv(mcrypt_get_iv_size($this->cipher, $this->mode), MCRYPT_RAND);
			}
			return $this->iv;
		}
		
		private function pkc5pad($texto) {
			$blocksize = mcrypt_get_block_size($this->cipher, $this->mode);
			$pad = $blocksize - (strlen($texto) % $blocksize);
			return $texto . str_repeat(chr($pad), $pad); 
		}
		
		public function cifrar($texto, $llave) {
			$texto = $this->pkc5pad($texto);
			return mcrypt_encrypt($this->cipher, $llave, $texto, $this->mode, $this->getIV());
		}
		
		public function descifrar($texto, $llave) {
			$decrypted = mcrypt_decrypt($this->cipher, $llave, $texto, $this->mode, $this->getIV());
			$dec_s = strlen($decrypted);
			$padding = ord($decrypted[$dec_s-1]);
			$decrypted = substr($decrypted, 0, -$padding);
			return $decrypted;
		}
	}
?>