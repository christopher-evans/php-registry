<?php

namespace West\Registry\Service;

class Baz
{
    private $parameter;

    public function __construct(Baz $parameter)
    {
        $this->parameter = $parameter;
    }
}
