<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.04.16
 * Time: 13:44
 */

namespace Core\Di;


interface ContainerInterface
{
    public function setDi(Container $container);

    public function getDi();
}