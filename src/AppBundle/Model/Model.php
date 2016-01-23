<?php

namespace AppBundle\Model;

class Model
{
    public function __construct()
    {
        $this->data = [];
        $this->indexTable = [];
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

    public function getIndexTable()
    {
        return $this->indexTable;
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
        unset($this->indexTable[$title]);
    }

    private function deleteData($index)
    {
        unset($this->data[$index]);
    }

    private function insertIndex($key)
    {
        $key = strtolower($key);
        $this->indexTable[$key] = sizeof($this->data) - 1;
        ksort($this->indexTable);
    }

    private function getIndex($obj)
    {
        $obj = strtolower($obj);
        return $this->indexTable[$obj];
    }

    private function hasIndex($obj)
    {
        $obj = strtolower($obj);
        return array_key_exists($obj, $this->indexTable);
    }

    private function hasParameter($parameter, $parameters)
    {
        return array_key_exists($parameter, $parameters);
    }
}