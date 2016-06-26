<?php
/**
* 设值注入
* 
* @author Nutto nutto.pan@gmail.com
*/
class Main{
    private $injection;
    public function setInjection(SetterInjection $obj)
    {
        $injection = $obj;
        $injection->show();
    }
}
class SetterInjection
{
    public function show()
    {
        echo __METHOD__;
    }
}
$construct_injection_obj = new SetterInjection();
$main_obj = new Main();
$main_obj->setInjection($construct_injection_obj);