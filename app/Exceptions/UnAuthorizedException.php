<?php

declare(strict_types=1);

namespace App\Exceptions ;

class UnAuthorizedException extends \Exception
{
	protected $message = '401 Not authorized' ;
}