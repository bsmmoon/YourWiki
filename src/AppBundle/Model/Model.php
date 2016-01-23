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
            case "delete":
                $this->deleteCommand($input["parameters"]);
                break;
            default:
         }
    }

    public function getData()
    {
        return $this->data;
    }

    private function deleteCommand($parameters)
    {
        $title = $parameters["title"];
        if ($this->getIndex($title) === -1) {
            return;
        }
        $index = $this->index[strtolower($title)];
        unset($this->index[$title]);
        unset($this->data[$index]);
    }

    private function addCommand($parameters)
    {
        if (!$this->hasParameter("title", $parameters)) {
            return;
        } else if ($this->getIndex($parameters["title"]) !== -1) {
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

    private function getIndex($obj)
    {
        $obj = strtolower($obj);
        if (!$this->hasIndex($obj)) {
            return -1;
        } else {
            return $this->index[$obj];
        }
    }

    private function hasIndex($obj)
    {
        return array_key_exists($obj, $this->index);
    }

    private function hasParameter($parameter, $parameters)
    {
        return array_key_exists($parameter, $parameters);
    }
}