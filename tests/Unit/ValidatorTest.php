<?php

use Core\Validator;

test('validate a string', function () {
    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
});

test('validate a string with a minimum length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

test('validate an email', function () {
    expect(Validator::email('foobar'))->toBeFalse();
    expect(Validator::email('foobar@gmail.com'))->toBeTrue();
});

test('validate a number is greater than a given amount', function () {
    expect(\Core\Validator::greaterThan(10, 1))->toBeTrue();
    expect(\Core\Validator::greaterThan(10, 12))->toBeFalse();

})->only();

