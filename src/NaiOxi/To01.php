<?php

namespace kgalanos\conversion\NaiOxi;

class To01
{
    public function __construct(protected ?string $value)
    {
    }

    public static function setValue(?string $value): self
    {
        return new static($value);
    }

    public function format()
    {
        $val = null;
        if (strtoupper($this->value) == 'ΝΑΙ'/*ΕΛΛΗΝΙΚΑ*/ || strtoupper($this->value) == 'NAI' /* English*/) {
            $val = 1;
        }
        if (strtoupper($this->value) == 'ΟΧΙ'/*ΕΛΛΗΝΙΚΑ*/ || strtoupper($this->value) == 'OXI' /* English*/) {
            $val = 0;
        }

        return $val;
    }
}
