<?php

use RyanChandler\FnInspector\FnInspector;

it('can be created with string-based callable', function () {
    expect(FnInspector::new('strlen'))
        ->toBeInstanceOf(FnInspector::class);
});

it('can be create with closures', function () {
    expect(FnInspector::new(fn () => []))
        ->toBeInstanceOf(FnInspector::class);

    expect(FnInspector::new(function () {
    }))
        ->toBeInstanceOf(FnInspector::class);

    $noop = function () {
    };

    expect(FnInspector::new($noop))
        ->toBeInstanceOf(FnInspector::class);
});

it('can be created with class-based and object-based callable', function () {
    $noop = new class () {
        public function noop_instance()
        {
        }

        public static function noop_static()
        {
        }
    };

    expect(FnInspector::new([$noop, 'noop_instance']))
        ->toBeInstanceOf(FnInspector::class);

    expect(FnInspector::new([$noop, 'noop_static']))
        ->toBeInstanceOf(FnInspector::class);

    class ClassBasedCallable
    {
        public function noop_instance()
        {
        }

        public static function noop_static()
        {
        }
    }

    expect(FnInspector::new([ClassBasedCallable::class, 'noop_instance']))
        ->toBeInstanceOf(FnInspector::class);

    expect(FnInspector::new([ClassBasedCallable::class, 'noop_static']))
        ->toBeInstanceOf(FnInspector::class);
});

it('can return number of parameters', function () {
    expect(FnInspector::new(fn () => []))
        ->numberOfParameters()
        ->toBe(0);

    expect(FnInspector::new(fn ($foo) => []))
        ->numberOfParameters()
        ->toBe(1);

    expect(FnInspector::new(fn ($foo = null) => []))
        ->numberOfParameters()
        ->toBe(1);

    expect(FnInspector::new(fn ($foo) => []))
        ->numberOfParameters(required: true)
        ->toBe(1);

    expect(FnInspector::new(fn ($foo = null) => []))
        ->numberOfParameters(required: true)
        ->toBe(0);
});

it('can return the return type', function () {
    expect(FnInspector::new(fn () => []))
        ->returnType()
        ->toBeNull();

    expect(FnInspector::new(fn (): array => []))
        ->returnType()
        ->getName()
        ->toBe('array');

    expect(FnInspector::new(fn (): array|string => []))
        ->returnType()
        ->__toString()
        ->toBe('array|string');
});

it('can return parameters', function () {
    expect(FnInspector::new(fn () => []))
        ->parameters()
        ->all()
        ->toBeArray()
        ->toHaveLength(0);

    expect(FnInspector::new(fn ($name) => []))
        ->parameters()
        ->first()
        ->getName()
        ->toBe('name');

    expect(FnInspector::new(fn (string $name) => []))
        ->parameters()
        ->type('string')
        ->first()
        ->getName()
        ->toBe('name');

    expect(FnInspector::new(fn (string $name, string $email) => []))
        ->parameters()
        ->type('string')
        ->all()
        ->toBeArray()
        ->toHaveLength(2);

    expect(FnInspector::new(fn (string|array $foo) => []))
        ->parameters()
        ->type('string')
        ->first()
        ->getName()
        ->toBe('foo');

    expect(FnInspector::new(fn (string|array $foo, string $bar) => []))
        ->parameters()
        ->type('string')
        ->all()
        ->toBeArray()
        ->toHaveLength(2);

    expect(FnInspector::new(fn (array $foo, string $bar) => []))
        ->parameters()
        ->type(['string', 'array'])
        ->all()
        ->toBeArray()
        ->toHaveLength(2);
});
