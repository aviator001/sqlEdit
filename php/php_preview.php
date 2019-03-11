<!DOCTYPE html>
<html lang="en-US">
	<head>
		<script src="js/media_queries.js"></script>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title></title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link rel="stylesheet" href="css/prism.css" type="text/css" />
<style>
	.jconfirm-box {
		font-weight:900;
		text-align:left;
	}
	* {
		font-family:Courier New!Important;
		font-size:18px;
		text-align:left;
	}
</style>
	</head>
	<body class="stretched" style="background:#f0f0f0">
		<pre id="pre" class="language-html line-numbers" data-src="<?=$uri;?>"></pre>
		<script src="js/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
		<script type="text/javascript" src="js/prism.js"></script>
	</body>
</html>	
<? 
	error_reporting(0);
	$uri=$_GET[uri];
	highlight_file("SQLEdit.php");
?>
