<?php

namespace AppBundle\Model;

class Model
{
    public function __construct()
    {
        $this->data = [];
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
        $this->data[] = $parameters;
    }
}