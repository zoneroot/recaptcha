<?php
namespace zoneroot\recaptcha;
use \zoneroot\recaptcha\exceptions\connectionException;
use \zoneroot\recaptcha\exceptions\invalidRecaptchaException;
class recaptcha
{
	private static $site_key;
	private static $secret_key;

	public static function init($site_key, $secret_key)
	{
		self::$site_key = $site_key;
		self::$secret_key = $secret_key;
	}

	public static function script()
	{
		return '<script src="https://www.google.com/recaptcha/api.js"></script>';
	}

	public static function html()
	{
		return '<div class="g-recaptcha" data-sitekey="'.self::$site_key.'"></div>';
	}

	public static function isValid($code = null, $ip = null)
	{
		$code = $_POST['g-recaptcha-response'];
	    if (empty($code)) {
	        throw new invalidRecaptchaException();
	    }
	    $params = [
	        'secret'    => self::$secret_key,
	        'response'  => $code
	    ];
	    if( $ip ){
	        $params['remoteip'] = $ip;
	    }
	    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
	    if (function_exists('curl_version')) {
	        $curl = curl_init($url);
	        curl_setopt($curl, CURLOPT_HEADER, false);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        $response = curl_exec($curl);
	    } else {
	        $response = file_get_contents($url);
	    }
	
	    if (empty($response) || is_null($response)) {
	        throw new connectionException();
	    }
	
	    $json = json_decode($response);
	    if ( $json->success )
	    	return true;
	    else
	    	throw new invalidRecaptchaException();
	    	
	}
}
?>