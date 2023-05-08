<?php

namespace kgalanos\conversion\Date;

use Carbon\Carbon;

class ToString
{
    public function __construct(protected ?string $value, protected string $format='Y-m-d')
    {

    }

    public static function setValue(?string $value, string $format='Y-m-d'): ?self
    {
        return new static($value, $format);
    }

    public function format(): ?string
    {
        if($this->value ==0 || is_null($this->value))
            return null;
        try {
            Carbon::parse($this->value);
            return Carbon::make($this->value)->format($this->format);
        }catch(\Carbon\Exceptions\InvalidFormatException $e) {
            return null;
        }
    }
}
