<?php
use PHPUnit\Framework\TestCase;
include('create.php');
class Test extends TestCase{


    public function test123(){
        $c=new eqpass;
        $this->assertEquals($c->foo(123,123),1);
        $this->assertEquals($c->foo('abc','abc'),1);
        $this->assertEquals($c->foo('ABC','Abc'),1);
        $this->assertEquals($c->foo('АБС','ABC'),0);
    }
}
