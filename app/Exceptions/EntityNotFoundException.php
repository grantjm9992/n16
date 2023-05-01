<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EntityNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = '{{entity}} not found';

    public function __construct(string $entity)
    {
        parent::__construct(self::formatError($entity));
    }

    private static function formatError(string $entity): string
    {
        return str_replace('{{entity}}', $entity, self::MESSAGE);
    }
}
