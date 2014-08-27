<?php
traversle(".");
function traversle($path="."){
	$list=scandir($path);
	foreach($list as $key=>$value){
		if($value=="." || $value==".."){
			continue;
		}
		$sub=$path."/".$value;
		if(is_dir($sub)){
			traversle($sub);
		}else{
			$rs=file_get_contents($path."/".$value);
			 $charset[1] = substr($rs, 0, 1);
			 $charset[2] = substr($rs, 1, 1);
			 $charset[3] = substr($rs, 2, 1);
			 if((ord($charset[1]) == 0xEF && ord($charset[2]) == 0xBB  && ord($charset[3]) == 0xBF)){
			 	$content=substr($rs,3);
			 	$fp=fopen($path."/".$value,"w");
			 	fwrite($fp,$content);
			 	fclose($fp);
			 	echo $path."/".$value." has removed bom";
			 }
		}
	}
}