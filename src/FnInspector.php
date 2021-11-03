<?php

declare(strict_types=1);

namespace RyanChandler\FnInspector;

use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionObject;
use ReflectionType;
use TypeError;

class FnInspector
{
    public function __construct(
        protected ReflectionFunctionAbstract $reflector
    ) {
    }

    public function parameters(): ParameterFinder
    {
        return new ParameterFinder($this->reflector->getParameters());
    }

    public function numberOfParameters(bool $required = false): int
    {
        return $required ?
            $this->reflector->getNumberOfRequiredParameters() :
            $this->reflector->getNumberOfParameters();
    }

    public function returnType(): ?ReflectionType
    {
        return $this->reflector->getReturnType();
    }

    /**
     * @throws \TypeError
     */
    public static function new(array|string|callable $fn): static
    {
        if (! is_array($fn) && (is_string($fn) || is_callable($fn))) {
            return new static(new ReflectionFunction($fn));
        }

        [$objectOrClass, $method] = $fn;

        if (is_string($objectOrClass)) {
            return new static(
                (new ReflectionClass($objectOrClass))->getMethod($method)
            );
        }

        if (is_object($objectOrClass)) {
            return new static(
                (new ReflectionObject($objectOrClass))->getMethod($method)
            );
        }

        throw new TypeError('Expected a value that represents a valid callable.');
    }
}
