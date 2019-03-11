<? include "base_php.php";?>
<? include "class/utils.class.php";?>
<? $c=new utils;?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<script src="js/media_queries.js"></script>
		<? include "meta.php";?>
		<title><?=$title;?></title>
		<? include "css.php";?>
		<? include "style.php";?>
	</head>
	<body>
		<? include "body_pre.php";?>
		<h1>
			<?=$body_title;?>
		</h1>
		<?=$page_into;?>
		<? include "details.php";?>
		<? include "body_post.php";?>
		<? include "scripts.php"; ?>
		<script>Dropzone.autoDiscover=false</script>
		<? include "js.php"; ?>
	</body>
</html>
	