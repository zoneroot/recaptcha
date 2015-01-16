<?php
namespace zoneroot\recaptcha\exceptions;
class connectionException extends \exception
{
	public function __construct()
	{
		$this->message = "Unable to connect to recaptcha server";
	}
}
?>