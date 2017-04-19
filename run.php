<?php

namespace West\Registry;

use West\Registry\Factory\RegistryFactory;

require 'vendor/autoload.php';

class Moo
{
    private $dep;
    private $oom;

    public function __construct(bool $dep, bool $oom)
    {
        $this->dep = $dep;
        $this->oom = $oom;
    }
}

class service
{
    private $dep;
    private $val;
    public function __construct($dep, $val)
    {
        $this->dep = $dep;
        $this->val = $val;

    }
}


$factory = new RegistryFactory();
$registry = $factory->createFromArray(
    [
        'West\Registry\Moo' => [
            'dep' => false,
            'oom' => false,
        ],
        'West\Registry\service' => [
            'dep' => new RegistryKey('West\Registry\Moo'),
            'val' => 'Kd'
        ],
    ]
);

var_dump($registry);
