<?php

require __DIR__.'/../vendor/autoload.php';
use Carbon\Carbon;

it('can test', function () {
    $value = Carbon::create(2023, 2, 1);
    $tmp = \kgalanos\conversion\stringFromDate::value($value)->toString();
    expect('2023-02-01')->toEqual($tmp);
    $tmp = \kgalanos\conversion\stringFromDate::value($value, 'd-m-Y')->toString();
    expect('01-02-2023')->toEqual($tmp);
});
