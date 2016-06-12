<?php

namespace Core\Di;

/*

    $container->set('request', '\Core\Http\Request');

    $container->set('request', function(){
           return new Request();
     });

*/



class Container
{
    public $services = [];

    public $used_services = [];

    public function register(ServiceProviderInterface $service_provider)
    {
        $service_provider->register($this);
        return $this;
    }

    public function set($name, $object)
    {
        $this->services[$name] = $object;
    }

    public function get($name, $new_instance = false)
    {
        $instance = null;
        if (array_key_exists($name, $this->services)) {
            if(is_object($this->services[$name])){
                if($this->services[$name] instanceof \Closure) {
                    if ($new_instance && array_key_exists($name, $this->used_services)) {
                        $instance = $this->used_services[$name];
                    }else{
                        $instance = call_user_func($this->services[$name]);
                        $this->used_services[$name] = $instance;
                    }
                }else{
                    $instance = $this->services[$name];
                }
            }else if(is_string($this->services[$name])){
                $instance = new $this->services[$name];
            }else{
                throw new \Exception('Service "'.$this->services[$name].'" has invalid type');
            }
        } else {
            throw new \Exception('Service "'.$this->services[$name].'" not found');
        }

        if($instance instanceof ContainerInterface){
            $instance->setDi($this);
        }

        return $instance;
    }

}