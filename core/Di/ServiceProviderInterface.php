<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 26.04.16
 * Time: 12:49
 */

namespace Core\Di;

interface ServiceProviderInterface
{
    public function register(Container $container);
}