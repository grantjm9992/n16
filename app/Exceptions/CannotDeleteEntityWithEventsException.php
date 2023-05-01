<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CannotDeleteEntityWithEventsException extends HttpException
{
    private const MESSAGE = 'Cannot delete {{entity}} that has events assigned to it';

    public function __construct(string $entity)
    {
        parent::__construct(self::formatError($entity));
    }

    private static function formatError(string $entity): string
    {
        return str_replace('{{entity}}', $entity, self::MESSAGE);
    }
}
