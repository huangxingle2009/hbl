<?php
header("Content-type:text/html;charset=utf-8");
$tree=array(
	array('id'=>1,'name'=>'浙江','parent_id'=>0),
	array('id'=>2,'name'=>'北京','parent_id'=>0),
	array('id'=>3,'name'=>'江苏','parent_id'=>0),
	array('id'=>4,'name'=>'温州','parent_id'=>1),
	array('id'=>5,'name'=>'杭州','parent_id'=>1),
	array('id'=>6,'name'=>'平阳','parent_id'=>4)
);

function traversle($tree,$id,$level=1){
	static $list=array();
	foreach($tree as $v){
		if($v['parent_id']==$id){
			$v["level"]=$level;
			$list[]=$v;
			traversle($tree,$v['id'],$level++);
		}
	}
	return $list;
}

print_r(traversle($tree,1));