<?php

namespace AppBundle\Model;

class Model
{
    public function __construct()
    {
        $this->data = [];
        $this->index = [];
    }

    public function run($input)
    {
        switch($input["command"]) {
            case "add":
                $this->addCommand($input["parameters"]);
                break;
            default:
         }
    }

    public function getData()
    {
        return $this->data;
    }

    private function addCommand($parameters)
    {
        if (!$this->hasParameter("title", $parameters)) {
            return;
        } else if ($this->hasIndex($parameters["title"])) {
            return;
        }
        $this->data[] = $parameters;
        $this->insertIndex($parameters["title"]);
    }

    private function insertIndex($key)
    {
        $key = strtolower($key);
        $this->index[$key] = sizeof($this->data) - 1;
        ksort($this->index);
    }

    private function hasIndex($obj)
    {
        $obj = strtolower($obj);
        return array_key_exists($obj, $this->index);
    }

    private function hasParameter($parameter, $parameters)
    {
        return array_key_exists($parameter, $parameters);
    }
}