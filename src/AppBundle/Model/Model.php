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
        if (!$this->hasIndex($title)) {
            return;
        }
        $index = $this->getIndex($title);
        $this->deleteIndex($title);
        $this->deleteData($index);
    }

    private function addCommand($parameters)
    {
        if (!$this->hasParameter("title", $parameters)) {
            return;
        }

        $title = $parameters["title"];
        if ($this->hasIndex($title)) {
            return;
        }
        $this->data[] = $parameters;
        $this->insertIndex($title);
    }

    private function deleteIndex($title)
    {
        $title = strtolower($title);
        unset($this->index[$title]);
    }

    private function deleteData($index)
    {
        unset($this->data[$index]);
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
        return $this->index[$obj];
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