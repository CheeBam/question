<?php

namespace Core\Di;

trait ContainerTrait
{
    protected $container;

    public function setDi(Container $container)
    {
        $this->container = $container;
        return $this;
    }

    public function getDi()
    {
        return $this->container;
    }

}