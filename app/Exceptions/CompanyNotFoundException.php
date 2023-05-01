<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Company not found';

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
