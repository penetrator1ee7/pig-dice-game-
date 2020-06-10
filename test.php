<?php
use PHPUnit\Framework\TestCase;
include('testing.php');
class Test extends TestCase{


    public function testpass(){
        $c=new eqpass;
        $this->assertEquals($c->foo(123,123),1);
        $this->assertEquals($c->foo('abc','abc'),1);
        $this->assertEquals($c->foo('ABC','Abc'),0);
        $this->assertEquals($c->foo('АБС','ABC'),0);
    }
}
