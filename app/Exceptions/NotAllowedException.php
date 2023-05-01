<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotAllowedException extends HttpException
{
    public function __construct()
    {
        parent::__construct(403, 'You are not allowed to perform this action');
    }
}
