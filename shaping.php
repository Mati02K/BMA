<?php  
function cryptfun($action, $string)
{
    $output = false;
    
    $encrypt_method = 'AES-256-CBC';         
    $secret_key = 'M@th&B@la';             
    $secret_iv = '!IV@@_$$2';  
    
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    
    return $output;
  }

?>