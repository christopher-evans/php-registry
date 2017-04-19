<?php

namespace West\Registry\Service;

class Bar
{
    private $parameter;
    private $nextParameter;

    public function __construct(Foo $parameter, $nextParameter)
    {
        $this->parameter = $parameter;
        $this->nextParameter = $nextParameter;
    }
}
