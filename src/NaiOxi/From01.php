<?php

namespace kgalanos\conversion\NaiOxi;

class From01
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
        $rtn = '';
        if(!is_null($this->value)) {
            if ($this->value == 1)
                $rtn = 'ΝΑΙ';/*ΕΛΛΗΝΙΚΑ*/
            if ($this->value == 0)
                $rtn = 'ΟΧΙ';/*ΕΛΛΗΝΙΚΑ*/
        }
        return $rtn;
    }
}
