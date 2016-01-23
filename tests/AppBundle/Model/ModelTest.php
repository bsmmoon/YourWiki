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
        $data = $model->getData();

        $this->assertEquals($data[0]["title"], "TDD");
        $this->assertEquals(sizeof($data[1]["tag"]), 3);
        $this->assertEquals(sizeof($data), 2);
    }
}
