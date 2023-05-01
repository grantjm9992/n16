<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TeacherNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Teacher not found';

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
