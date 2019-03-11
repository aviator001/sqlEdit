<? 
	include "base_php.php";
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	parse_str(http_build_query($_GET),$arr);
	include "class/utils.class.php";
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$_COOKIE['db_name']);
	echo $cnt=$c->query("select count(*) as `cnt` from $table")[0]['cnt'];
	if (!isset($page)) $page=0;
	$skip=round($cnt/50);
	foreach($arr as $_key => $_value)	{
		if($_key !=="page") {
			$str .= $_key . "=" . $_value . "&";
		}
	}
	if ($page*ITEMS_PER_PAGE<$cnt-ITEMS_PER_PAGE*$skip) {
		$qsn10 = "?page=" . ($page*1+$skip) . "&" . $str;
		$n10=1;
	} else {
		$n10=0.3;
		$qsn10 = "";

	}
		if ($page*ITEMS_PER_PAGE<$cnt-ITEMS_PER_PAGE) {
			$qsn = "?page=" . ($page*1+1) . "&" . $str;
			$n0=1;
		} else {
			$n10=0.3;
			$n0=0.3;
			$qsn = "";
			$qsn10 = "";
		}

	if ($page>=1) {
		$qsp = "?page=" . ($page*1-1) . "&" . $str;
		$p0=1;
	} else {
		$p0=0.3;
		$qsp="";
	}
	if ($page>5) {
		$qsp10 = "?page=" . ($page*1-$skip) . "&" . $str;
		$p10=1;
	} else {
		$p10=0.3;
		$qsp10="";
	}
	if ($page<0) $page=0;
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<script src="js/media_queries.js"></script>
		<? include "meta.php";?>
		<title><?=$title;?></title>
		<? include "css.php";?>
		<? include "style.php";?>
	    <link href="css/flat-ui.css" rel="stylesheet">
	</head>
	<body>
		<? include "body_pre.php";?>
		<h1>
			<?=$body_title;?>
		</h1>
		<?=$page_into;?>
				<div class="col-md-12" style="text-align:center" id="jsFns">
					
				</div>
				<div style="width:100%;text-align:center;padding:50px;margin:auto;background:#f9f9f9;padding-top:10px;padding-bottom:10px;box-shadow:0 0 25px rgba(0,0,0,0.1);border-radius:4px">	
					<h2 id="title">TABLE VIEWER <span style="color:silver">{<?=$table;?>}</span></h2>
					<hr/>
					<div id="tc">

					</div>
					<div class="row">
							<div class="col-md-12">		
								<? echo $data=$c->queryBROWSE("select * from $table limit $page," . ITEMS_PER_PAGE);?>
							</div>	
							<div class="pagination">
								<ul>
								  <li class="previous"><a href="#fakelink" class="fui-arrow-left"></a></li>
	  								  <li class="active"><a href="#fakelink">1</a></li>

						<? 
							if ($cnt<10000) {
									$no_of_pages=ceil($cnt/100);
									for ($k=1;$k<$no_of_pages; $k++) { ?>
										<li><a href="#fakelink"><?=($k+1);?></a></li>
								<?	} ?>							
							<?	} ?>							
									<li class="next"><a href="#fakelink" class="fui-arrow-right"></a></li>
								</ul>
							</div>	
						<? if ($cnt>10000) { ?>
							<div class="col-md-12" style="text-align:center;opacity:1">
								<a href="<?=$qsp10;?>"><img id="p10" src="images/skip_previous.png" style="height:25px;text-align:right;opacity:<?=$p10;?>"></a>
								<a href="<?=$qsp;?>"><img id="p1" style="width:25px;margin-right:10px;opacity:<?=$p0;?>" src="images/previous.png"></a>
								<a href="<?=$qsn;?>"><img id="n1" style="width:25px;margin-left:10px;opacity:<?=$n0;?>"  src="images/next.png"></a>
								<a href="<?=$qsn10;?>"><img id="n10" src="images/skip_next.png" style="height:25px;margin-right:10px;opacity:<?=$n10;?>"></a>
							</div>
						<? } ?>
					</div>					
		<? include "body_post.php";?>
		<? include "scripts.php"; ?>
		<script>Dropzone.autoDiscover=false</script>
		<?// include "js.php"; ?>
		<script>
		
		
		</script>
	</body>
</html>
	
	