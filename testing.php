<?php
class eqpass{
    public function foo($pass,$pass2){
        if($pass === $pass2){
            $errFlag=1;
            return $errFlag;
        }else{
            $errFlag=0;
            return $errFlag;
        }
    }
}