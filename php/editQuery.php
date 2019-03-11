<? 
/*
	include "base_php.php";
	ini_set('display_errors',0);
	parse_str(http_build_query($_GET));
	parse_str(http_build_query($_GET),$arr);
	include "class/utils.class.php";
	$c=new utils;
	$c->connect(DB_SERVER,DB_USER,DB_PASS,$_COOKIE['db_name']);
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<script src="js/media_queries.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
		<? include "meta.php";?>
		<title><?=$title;?></title>
		<? include "css.php";?>
		<? include "style.php";?>
	</head>
	<? include "scripts.php"; ?>
	<? include "js.php"; ?>
	<body>
		<? include "body_pre.php";?>
		<a href="javascript:queryEDITCode()"><img style="height:35px" src="images/php_code.png"></a><h2 id="title">TABLE/QUERY EDITOR/VIEWER <span style="color:silver">{<?=$table;?>}</span></h2>
		<hr/>
		<div id="tc">
			<div class="row">
				<div id="editData" class="col-md-12"></div>
			</div>
		</div>
		<? include "paginate.php";?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>	
		<script>
			console.log('u: getEditHTML.php?qry=<?=$qry;?>')
			$.ajax({
					url		:	'getEditHTML.php?qry=<?=$qry;?>',
					success	:	function(data){
						$('#editData').html(data)
					}
				})
		</script>
	</body>
</html>
*/	
?>