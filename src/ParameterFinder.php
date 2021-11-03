<?php

declare(strict_types=1);

namespace RyanChandler\FnInspector;

use Closure;
use ReflectionParameter;
use ReflectionUnionType;

/**
 * @property-read \ReflectionParameter[] $parameters
 */
final class ParameterFinder
{
    public function __construct(
        private array $parameters
    ) {
    }

    public function type(string|array $type): self
    {
        $type = Arr::wrap($type);

        return $this->filter(function (ReflectionParameter $parameter) use ($type) {
            $parameterType = $parameter->getType();

            if ($parameterType === null) {
                return false;
            }

            if ($parameterType instanceof ReflectionUnionType) {
                foreach ($parameterType->getTypes() as $unionType) {
                    if (in_array((string) $unionType, $type)) {
                        return true;
                    }
                }

                return false;
            }

            return in_array((string) $parameterType, $type);
        });
    }

    public function name(string $name): ?ReflectionParameter
    {
        return $this
            ->filter(fn (ReflectionParameter $param) => $param->getName() === $name)
            ->first();
    }

    public function filter(Closure $callback): self
    {
        return new self(array_filter($this->parameters, $callback));
    }

    public function first(): ?ReflectionParameter
    {
        return Arr::first($this->parameters);
    }

    public function all(): array
    {
        return $this->parameters;
    }
}
