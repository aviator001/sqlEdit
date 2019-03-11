<?php
include "class/utils.class.php";
include('dom/simple_html_dom.php');
error_reporting(0);
$c=new utils;
$c->connect();
$total=0;
$unique=0;
$j=explode('|',$_GET[uri]);
$code='';
$scr='';
$keywords_avoid=array("google","jquery","bootstrap","gmaps","maps","min");
for ($k=0;$k<count($j);$k++) {
	if (any_value_in_array_matches($keywords_avoid,$j[$k])===false) {
		$cd=build($j[$k]);
		$code=$code . $cd;
		$html=file_get_html($j[$k]);
		if ($html) {
			foreach($html->find('script') as $e) {
				$src=$e->src;
				if (any_value_in_array_matches($keywords_avoid,$src)===false) {
					$scr = $scr . $src . '|';
					$cd1=build($src);
					$code1=$code1 . $cd1;
				}
			}
		}
	}
}

echo $total . "@@@@" . $unique . "@@@@" . $code. "@@@@" . $code1 . "****" . $scr;

function any_value_in_array_matches($arrOfValues,$src) {
	for ($i=0;$i<count($arrOfValues);$i++) {
		if (stripos($str,$arrOfValues[$i]) > -1) return true;
	}
	return false;
}

function build($uri) {
	GLOBAL $c;
	$st='';
	global $unique,$total;
	$js=file_get_contents($uri);
	$aur1=array('function(','function (','=function','= function','<','>');
	$aur2=array('functi@n(','functi@n (','=functi@n','= functi@n','&lt;','&gt;');
	$aur3=array('function(','function (','=function','= function');
	$aur4=array('functi@n(','functi@n (','=functi@n','= functi@n');
	$au=explode("function ",str_replace($aur1,$aur2,$js));
	$an=array_unique($au);
	for ($i=1;$i<count($au)-1;$i++) {
		$ctr=0; $pp=0;
		$str=str_replace($aur2,$aur1,$au[$i]);
		$str="\t\t" . str_replace($aur4,$aur3,$au[$i]);
		$strln=strlen($str);
		for ($j=0; $j<$strln; $j++) {
				if (substr($str,$j,1)=='{') {
					$ctr++;
					$pp++;
				}
				if (substr($str,$j,1)=='}') {
					$ctr--;
				}
				if ($pp>0) {
					if ($ctr==0) {
						$str=substr($str,0,$j+1);
						break;
					}
				}
		}
			$header=explode("{",trim($str))[0];
			$parts=substr($header,0,strlen($header)-2);
			$fname=explode("(",$parts)[0];
			$inputs=explode("(",$parts)[1];
		//	if (count(explode(" ",$fname)==2)) {
				if (strlen($fname)>2) {
					$total++;
					$st = $st . $str . "\r\n\r\n@@@@\r\n\r\n";
					$qry="INSERT INTO `functions` (`iid`, `fname`, `alias`, `input`, `output`, `public`, `url`, `desc`, `last_update`, `compress`, `location`, `async`, `var_declarations`, `header`, `function_body`,`ip`,`uid`) VALUES ('$guid', '$fname', '$alias', '$inputs', '$outputs', '1', '$url', '$desc', '$last_update', '0', '$location', '0', '$vars','function ".trim($header)."', '$str', '$ip','$uid')";
					$fid=$c->insert($qry);
					$found="";
				}
	//		}
	}
	return $st;
}
