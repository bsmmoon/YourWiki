<?php

namespace AppBundle\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ModelTest extends WebTestCase
{

    public function testtest()
    {
        $this->assertEquals(200, 200);
    }

    public function testAddCommand()
    {
        $model = new Model();
        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "TDD",
            ],
        ]);
        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "phpunit",
                "tag" => ["php", "programming", "unit test", ],
            ],
        ]);
        $model->run([
            "command" => "add",
            "parameters" => [
                "tag" => ["YOU", "ARE", "WRONG", ],
            ],
        ]);
        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "TDD",
                "tag" => ["programming", ],
            ],
        ]);

        $data = $model->getData();

        $this->assertEquals(2, sizeof($data));
        $this->assertEquals("TDD", $data[0]["title"]);
        $this->assertEquals(3, sizeof($data[1]["tag"]));
    }

    public function testDeleteCommand()
    {
        $model = new Model();
        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "TDD",
            ],
        ]);
        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "phpunit",
                "tag" => ["php", "programming", "unit test", ],
            ],
        ]);
        $model->run([
            "command" => "delete",
            "parameters" => [
                "title" => "TDD"
            ],
        ]);
        $model->run([
            "command" => "delete",
            "parameters" => [
                "title" => "phpunit"
            ],
        ]);

        $data = $model->getData();

        $this->assertEquals(0, sizeof($data));

        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "TDD",
            ],
        ]);
        $model->run([
            "command" => "add",
            "parameters" => [
                "title" => "phpunit",
                "tag" => ["php", "programming", "unit test", ],
            ],
        ]);

        $data = $model->getData();
        
        $this->assertEquals(2, sizeof($data));

        $model->run([
            "command" => "delete",
            "parameters" => [
                "title" => "TDD"
            ],
        ]);
        $model->run([
            "command" => "delete",
            "parameters" => [
                "title" => "phpunit"
            ],
        ]);

        $data = $model->getData();

        $this->assertEquals(0, sizeof($data));
    }
}
