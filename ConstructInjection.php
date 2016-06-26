<?php
/**
* 构造注入
* 
* @author Nutto nutto.pan@gmail.com
*/
class Main{
    private $injection;
    public function __construct(ConstructInjection $obj)
    {
        $injection = $obj;
        $injection->show();
    }
}
class ConstructInjection
{
    public function show()
    {
        echo __METHOD__;
    }
}
$construct_injection_obj = new ConstructInjection();
$main_obj = new Main($construct_injection_obj);