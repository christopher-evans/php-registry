<?php

namespace West\Registry\Service;

class Foo
{
    private $parameter;
    private $anotherParameter;

    public function __construct(bool $parameter, bool $anotherParameter)
    {
        $this->parameter = $parameter;
        $this->anotherParameter = $anotherParameter;
    }
}
