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
        $data = $model->getData();

        $this->assertEquals($data[0]["title"], "TDD");
    }
}
