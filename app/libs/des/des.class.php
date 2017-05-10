<?php 
namespace App\libs;

class DES
{
	var $cert_path;//cert文件路径
	function __construct($cert_path){
		$this->cert_path = $cert_path;
	}
	function encrypt($data) {
		if(!$this->cert_path){
			return false;
		}
        $cert = file_get_contents($this->cert_path);
		if(!$cert){
			return false;
		}
                $pub = openssl_pkey_get_public($cert);
                $para = '';
                for($i=0; $i<strlen($data); $i+=117){
                        $s = substr($data, $i, 117);
                        $ret = openssl_public_encrypt($s, $out, $pub);
                        $para .= $out;
                }
                $para = base64_encode($para);
                return $para;
        }
}



 ?>