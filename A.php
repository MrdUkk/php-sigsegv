<?php
require_once 'B.php';
require_once 'C.php';

$db = new B();
$in= new C('<test val="+11" />');
$Param=$in->node("/test")[0]->attr();

try {
    func2([
        'val' => func1(FILTER_VALIDATE_FLOAT, ['min_range' => -1, 'max_range' => 1])
    ], $Param);
} catch (Exception $e) {
} finally {
    $db->func3();
}

function func1($type,$options=[]){
    return ['filter' => $type,'options' =>$options];
}

function func2($filter, &$param){
    foreach($filter as $k=>$v) {
	$param[$k] = filter_var($param[$k], $v['filter'], array("options"=> $v['options']));
	if($param[$k] === FALSE)
	{
	    throw new APIException('11');
	}
    }
    return true;
}
