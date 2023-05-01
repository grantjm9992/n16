<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassroomNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Classroom not found';

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
