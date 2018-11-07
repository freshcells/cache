<?php

namespace Freshcells\Cache\Tests\Resources;

class TestEntity {

    private $data = ['foo' => 'bar'];
    private $var = 'test';

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getVar()
    {
        return $this->var;
    }


}
