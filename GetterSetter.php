<?php

abstract class GetterSetter
{
//    protected $bagName = "";
    protected $config = [];

    public function __call($functionName, $arguments)
    {
        /* handle set-methods */
        if ('set' == substr($functionName, 0, 3)) {
            $varName = lcfirst(substr($functionName, 3));
            $configValue = $arguments[0];
            if (isset($this->config[$varName])) {
                $this->config[$varName] = $configValue;
            } else {
                throw new BadFunctionCallException("Could not find $functionName");
            }
        }
        /* Handle get */
        if ('get' === substr($functionName, 0, 3)) {
            $varName = lcfirst(substr($functionName, 3));
            if (!isset($this->config[$varName])) {
                throw new \Exception(get_class($this) . ': Method ' . $functionName . ' does not exists.');
            }
            return $this->config[$varName];
        }
    }

    public function load(array $params = [])
    {
        $this->config = array_merge($this->config, $params);
    }
}