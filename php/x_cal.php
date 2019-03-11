<? ob_flush();?>	
<?
	include "../class/utils.class.php";
	$c=new utils;
	$c->connect("199.91.65.82","rentus");

 	$size=$_GET[size]*5 + 30;
	$fs=$_GET[size]*2;
	$is=$_GET[size]*1+20;
	$fs=($fs<10)?10:$fs;
	$fs=($fs>24)?24:$fs;
	$fs = ($fs+2) . "px";

	$size_compact="text-align:center;max-height:" . $size . "px!Important;height:" . $size . "px!Important;max-width:" . $size . "px!Important;width:" . $size . "px!Important;font-size:$fs!Important;font-family:Open Sans!Important";
	$m=$_REQUEST['month'];
	$y=$_REQUEST['year'];
	$selected=$_GET['selected'];
	if (strstr($selected,"-")){
		$sdx=explode(",",$selected);
		$sd=$sdx;//$c->show($sd);

	} else {
		$sd=explode(",",$selected);
	}
			
	for ($r=0;$r<count($sd);$r++) {
		if (strstr($sd[$r],'->')) {
			$sd1=explode("->",$sd[$r]);
				for ($q=$sd1[0];$q<=$sd1[1];$q++) {
					$selected_dates[]=$q;
				}
		} else {
			$selected_dates[]=$sd[$r];
		}
	}
	if (!$m) {
		$m=date('m');
		$mStr=date('m');;
	}
	if (!$y) $y=date('Y');
	$w=array('mon'=>1,'tue'=>2,'wed'=>3,'thu'=>4,'fri'=>5,'sat'=>6,'sun'=>7);
	$wk=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
						echo '<div class="col-md-3"><table class="www_box2" style="border:0px solid #333;border-radius:4px">';
						if (!$_GET[mini]) {

						echo '	<tr>';
						echo '		<td colspan=7 align=center>';
						echo '			<a title="prev" onclick="prev()"><img style="cursor:hand;cursor:pointer;margin-bottom:2px;width:'.$is.'px" src="images/prev.png"></a>'; 
						echo '				<span style="font-family:Open Sans;margin-top:10px;font-size:'.$fs.'"><b>' . strtoupper(date('F Y', mktime(0,0,0,$m,1,$y))) . '</b></span>';
						echo '			<a title="next" onclick="next()"><img style="cursor:hand;cursor:pointer;margin-bottom:2px;width:'.$is.'px" src="images/next.png"></a>'; 
						echo '		</td>
								</tr>
							<tr>';
						}
						$sq=7;
						$mth=($m<10)?'0'.$m:$m;
						$m=dates_month($m,$y,$fs,$size_compact);
						$wd=$m[0];
						$p_day=$m[2];
						$m=$m[1];
						$day_of_week=$w[strtolower($wd)];
						$skip_blocks=$day_of_week*1-1;
						$skip=1; $d=$i;
						$ctr=0;
						for ($j=1;$j<=7;$j++) {
							echo "<td valign='center' style='background:grey;color:#f0f0f0;$size_compact'><div style='background:grey;$size_compact;padding:2px;margin:0' class='www_box2'>" . $wk[$j-1] . "</div></td>";
						}
						echo "</tr><tr>";
							
						for ($i=2;$i<=count($m)+1+$skip_blocks;$i++) {
							$bc="";
							$d++;
							$day=(($i-2)<10)?"0".($i-2):($i-2);

							$w='';
							if (!$m[$i-$skip_blocks-1]) {
								$content = "";
							} else {
								$content = $m[$i*1-$skip_blocks*1-1];
								$content2 = $p_day[$i*1-$skip_blocks*1-1]*1;
								//To reserve & show weekends use line above (un-comment) and comment out line below
								$content2=$day*1;
								$action="onmouseover='on(this)' onmouseout='off(this)' onclick='toggle(this,$content2,$mth,$y)'";
							}
							if ($show_weekends) {
								if ((($i<8)&&($d>5)) || (($i>=7)&&($d>6))) {
									$weekend='style="background:white"';
									//$action='';
									$w='1';
								} else {
									$weekend='';
									$w=0;
								}
							
								if ($wk[$i-2]=="Sat") $weekend='style="background:Aliceblue"';
							} else {
								$w=0;
								$weekend='style="background:white"';
							}
							$selected='';
							$d=trim(explode('<',explode('>',$content)[1])[0]);
							// if (in_array($d,$selected_dates)) $bc="url(images/bars.jpg)";
							
							for ($x=0;$x<count($selected_dates);$x++) {
								if (($d==explode("-",$selected_dates[$x])[2]) && (explode("-",$selected_dates[$x])[1]==$mth*1)) $bc="url(images/bars.jpg)";
								 ;
								//$d;
								//if (strstr($selected_dates[$x],$d)) $bc="url(images/bars.jpg)";
							}
							if ($content=="") $bc="lavender";
							$dx=($d*1<10)?'0'.$d:$d;
							$mdy=$mth.'-'.$dx.'-'.$y;
							$id=$mdy;
						//	if (stristr($content,"Sat")) $bc="";
						//	if (stristr($content,"Sun")) $bc="";
						//	if (stristr($content,"Sat")) $content=$i*1-$skip_blocks*1-1;
						//	if (stristr($content,"Sun")) $content=$i*1-$skip_blocks*1-1;
							if (empty($bc)) $bc='#fff';
							$content = "<div class='middle'>" . $content . "</div>";
							echo "<td style='padding:0;margin:0;$size_compact'><div id='$id' style='background:$bc;opacity:1;$size_compact' class='cal www_box2 $wwend $icon_class' $selected $action>".$content."</div></td>";
							$sq--;
							if (!(($i-1)%7)) {
								echo "</tr><tr>";
								$d=1;
								$sq=7;
							}
							$ctr++;
						}
						$mt=date('m');
						$yr=date('Y');
						
					if ($sq<7) {
							for ($i=1;$i<=$sq;$i++) {
								if ($mt==12) {
									$mt=1;
									$yr++;
								}
								if ($i>$sq-2) $weekend="weekend2";
									else $weekend="";
								$mktime=mktime(0,0,0,$mt+1,$i,$yr);
								if ((date("D",$mktime)=="Sat") || (date("D",$mktime)=="Sun")) $bgx="lavender";
									else $bgx="lavender";
								if (( date("D",$mktime) == "Sat")||( date("D",$mktime)  == "Sun")) $ww=date("D",$mktime);
									else $ww=date("j",$mktime);
								//$date="<div style='display:none' class='day_words_disabled'></div><div style='$size_compact;font-size:$fs' class='day_num_disabled'></div>";
								echo "<td style='padding:0;margin:0;$size_compact'><div id='$id' class='cal www_box1 $weekend' style='background:$bgx;$size_compact'>" . $date . "</div></td>";
							}
								echo "</tr>";
						}
							echo '</table></div>';
	
   function dates_month($month,$year,$fs,$size_compact) {
		$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$dates_month=array();
		for($i=1;$i<=$num;$i++) {
			$mktime=mktime(0,0,0,$month,$i,$year);
			if (!$first) $first=date("D", $mktime);
			if (( date("D",$mktime) == "Sat")||( date("D",$mktime)  == "Sun")) {
				$ww=date("D",$mktime);
				$clr="color: silver;";
			} else {
				$ww=date("j", $mktime);
				$clr="color: black;";
			}
			if (( date("D",$mktime) == "Sat")||( date("D",$mktime)  == "Sun")) $nn="";
				else $nn=date("j", $mktime);
				
			$ww=date("j", $mktime);	
			$nn="";
			$date="<div style='$size_compact;font-size:$fs;$clr'>" .$ww . "</div><div style='$size_compact;font-size:$fs' class='day_num'></div>";
			$d[$i]=$ww;
			$dates_month[$i]=$date;
		}
		return array($first,$dates_month,$d);
	}
?>