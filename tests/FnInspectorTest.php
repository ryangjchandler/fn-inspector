<?php

use RyanChandler\FnInspector\FnInspector;

it('can be created with string-based callable', function () {
    expect(FnInspector::new('strlen'))
        ->toBeInstanceOf(FnInspector::class);
});

it('can be create with closures', function () {
    expect(FnInspector::new(fn () => []))
        ->toBeInstanceOf(FnInspector::class);

    expect(FnInspector::new(function () {}))
        ->toBeInstanceOf(FnInspector::class);

    $noop = function () {};

    expect(FnInspector::new($noop))
        ->toBeInstanceOf(FnInspector::class);
});

it('can be created with class-based and object-based callable', function () {
    $noop = new class {
        function noop_instance() {}
        static function noop_static() {}
    };

    expect(FnInspector::new([$noop, 'noop_instance']))
        ->toBeInstanceOf(FnInspector::class);

    expect(FnInspector::new([$noop, 'noop_static']))
        ->toBeInstanceOf(FnInspector::class);

    class ClassBasedCallable {
        function noop_instance() {}
        static function noop_static() {}
    }

    expect(FnInspector::new([ClassBasedCallable::class, 'noop_instance']))
        ->toBeInstanceOf(FnInspector::class);

    expect(FnInspector::new([ClassBasedCallable::class, 'noop_static']))
        ->toBeInstanceOf(FnInspector::class);
});