<?php
namespace zoneroot\recaptcha\exceptions;
class invalidRecaptchaException extends \exception
{
	public function __construct()
	{
		$this->message = "Invlalid Recaptcha";
	}
	
}
?>