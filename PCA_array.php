<?php
header("Content-type: text/html; charset=utf-8");
function retDeepArray($txtPath){
$myfile = fopen($txtPath, "r");
$ret = array() ;
$proName="" ;
$proCode="" ;
$cityName="";
$cityCode="" ;

while( !feof($myfile) && ($line = fgets($myfile))){	
	if(strstr($line,"\t\t")){
		$type=2 ;
		$area=explode(":",$line) ;
		$areaName = trim($area[0]) ;
		$areaCode = trim($area[1]) ;
		$ret[$proCode]["nodes"][$cityCode]["nodes"][$areaCode] = $areaName;
		//$ret[$proCode]["nodes"][$cityCode]["nodes"] += array($cityCode => array("label" => $cityName ,"nodes" => array())) ;
	}else if(strstr($line,"\t")){
		$type=1 ;
		$city=explode(":",$line) ;
		$cityName = trim($city[0]) ;		
		$cityCode = trim($city[1]) ;
		$ret[$proCode]["nodes"][$cityCode] = array("label" => $cityName ,"nodes" => array()) ;
		//$ret[$proCode]["nodes"] += array($cityCode => array("label" => $cityName ,"nodes" => array())) ;
	}else{
		$type=0 ;
		$pro=explode(":",$line) ;
		$proName =trim($pro[0]) ;		
		$proCode =trim($pro[1]) ;
		$ret[$proCode] = array("label" => $proName , "nodes" => array());
		//$ret += array($proCode => array("label" => $proName , "nodes" => array()));
	}


}
/*
$src_cnt=readfile($myfile,filesize("C:\resource.txt"));
function arr_cnt($src_cnt)
{
	$iPos=0;
	$arr_prov_city_area="";
	$test=strsToArray($str,"\n"); // 以换行符切割字符串为数组
    foreach ($test as $key => $value) { // 遍历数组，再以空格切割字符串为数组
        $testb[]=strsToArray($value,"\s");
}*/

fclose($myfile);
return $ret ;
echo $ret;
}

$a=retDeepArray("C://resource.txt") ;
$prov_city_area=var_export($a,True);
echo "<PRE>";
echo $prov_city_area;
echo "</PRE>";

?>