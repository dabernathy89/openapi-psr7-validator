<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\PSR7\Exception\Validation;

use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\Schema\Exception\SchemaMismatch;
use function sprintf;

class InvalidQueryArgs extends AddressValidationFailed
{
    public static function becauseOfMissingRequiredArgument(string $argumentName, OperationAddress $address) : self
    {
        $exception          = static::fromAddr($address);
        $exception->message = sprintf('Missing required argument "%s" for %s', $argumentName, $address);

        return $exception;
    }

    public static function becauseValueDoesNotMatchSchema(string $argumentName, string $argumentValue, OperationAddress $address, SchemaMismatch $prev) : self
    {
        $exception          = static::fromAddrAndPrev($address, $prev);
        $exception->message = sprintf('Value "%s" for argument "%s" is invalid for %s', $argumentValue, $argumentName, $address);

        return $exception;
    }

    public static function becauseValueIsNotValidJson(string $error, string $argumentName, OperationAddress $address) : self
    {
        $exception          = static::fromAddr($address);
        $exception->message = sprintf('JSON parsing failed with "%s" for argument "%s" for %s', $error, $argumentName, $address);

        return $exception;
    }

    public static function becauseOfUnexpectedArgumentIsNotAllowed(string $argument, OperationAddress $address) : self
    {
        $exception          = static::fromAddr($address);
        $exception->message = sprintf('Argument "%s" is not allowed for %s', $argument, $address);

        return $exception;
    }
}
