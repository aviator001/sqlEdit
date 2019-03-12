<?
namespace gangsterforms\sqledit;

class utils {
	/** 
	 * php extension
	 * @var	string
	 */
	protected $debug;
	protected $result;
	protected $r;
	public $host;
	public $table;
	public $field_names;
	
	/**
	 * Constructs a new instance of UTILS class.
	 */
	
	public function __construct () {
		global $_CONSTANTS;
		$a=array("'");
		$b=array("");
		foreach (parse_ini_file("settings.ini") as $key=>$value) { 
			${$key} = $value;
			if ($key=="host") {
				define(HOST,'https://' . $value);
			} else { 			
				define(strtoupper($key),str_replace($a,$b,$value));
			}
		}
		
		$this->host=HOST;
	}	

	public function show_errors($obj=FALSE) {
		if ($obj===TRUE) {
			ini_set("error_reporting", 1);
			error_reporting(E_ALL); 
			ini_set("display_errors", 1); 
			ini_set("display_errors", "On"); 
		} else {
			ini_set("error_reporting", 0);
			ini_set("display_errors", 0); 
			ini_set("display_errors", "Off"); 
			
		}
	}

	public function err($obj=0) {
		if ($obj===1) {
			ini_set("error_reporting", 1);
			error_reporting(E_ALL); 
			ini_set("display_errors", 1); 
			ini_set("display_errors", "On"); 
		} else {
			ini_set("error_reporting", 0);
			ini_set("display_errors", 0); 
			ini_set("display_errors", "Off"); 
		}
	}

	private function getArray($str) {
		return explode(",",$str);
	}

	public function SQLEdit($db="",$table="") {
		if (empty($table)) {
			$error = "Must pass a value for table";
			return $error;
		}
		parse_str(http_build_query($_GET));
		parse_str(http_build_query($_GET),$arr);
		if (!strpos($table,"sel")) $sql="select * from $table";
			else $sql=$table;
		if ($page<0) $page=0;
		$start=$page*ITEMS_PER_PAGE;
		if (!empty($table)) {
			$qry="select * from $table limit $start," . ITEMS_PER_PAGE;
		} else {
			$qry="$query limit $page," . ITEMS_PER_PAGE;
		}
		$op  = <<<OP
			<!DOCTYPE html>
			<html lang="en-US">
				<head>
					<script src="js/media_queries.js"></script>
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
							<meta http-equiv="content-type" content="text/html; charset=utf-8" />
					<meta name="author" content="" />
					<meta name="viewport" content="width=device-width, initial-scale=1" />
					<title></title>
					<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
					<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300"type="text/css" />
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
					<style>
						body, html, p, input, table, .large-font, ul, li, p{
							font-family:Open Sans!Important;
							font-size:16px!Important;
							font-weight:300
						}
						div {
							margin-top:5px!Important;
							margin-bottom:5px!Important;		
						}
						.silver {
							color:#cfcfcf!Important
						}
						.table_custom{
							
						}
						.table_header{
							padding:10px;
							font-family:tahoma;
							font-size:12px;
							cursor:hand;
							cursor:pointer;		
							font-weight: 700
						}
						.table_row{
							
						}
						.table_cell{
							padding:10px;
							font-family:Open Sans;
							font-size:12px;
							cursor:hand;
							cursor:pointer;
						}
						.rangeslider,
						.rangeslider__fill {
						height:30px;
						padding:0;
						margin:0;
						transition: background 0.3s;
						}
						.rangeslider__fill {
						background:url(images/rsbg.png)
						}
						.rangeslider--is-lowest-value {
						background-color: white;
						}
						.rangeslider--is-highest-value .rangeslider__fill {
							background-color: hotpink;
						}
						.rangeslider {
							background-color: white;
						}
					</style> 
				</head>
				<script src="js/jquery.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
				<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
				<script type="text/javascript">
	
					function setCookie(cname,cvalue)	{
						var d = new Date(); 
						d.setTime(d.getTime()+(1*24*60*60*1000));
						var expires = 'expires='+d.toGMTString(); 
						document.cookie = cname + '=' + cvalue + '; ' + expires; 
					}
					setTimeout(function(){
						setCookie('db_server', 'DB_SERVER')
						setCookie('db_name', '$db')
						setCookie('table', '$table')
						setCookie('db_user', 'DB_USER')
						setCookie('db_password', 'DB_PASS')
					},10)
						
					function update_field(f,u) {
						var v=f.value
						f=f.id
						if(u)f=u
						if(u)v=getCookie('filenames')
						var url = 'https://sugardaddyscam.com/form/x_update_table.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password') + '&table=' + table + '&field=' + f + '&value=' + v + '&id=' + index + '&index=' + index_value
						var request = $.ajax({
							url: url,
							success: function(msg) {
								console.log(url)	
							
							}
						})			
					}
				</script>
				<body class="" style="background:#f0f0f0">
					<div id="wrapper" class="clearfix">
						<header id="header" class="dark" data-sticky-class="dark">
							<div id="header-wrap">
								<div class="container clearfix">
								</div>
							</div>
						</header>
						<section id="content" style="background:none;padding:0">
							<div class="container" id="clsChanger">
								<h2 id="title"><img align=right style="height:60px" src="images/logo_small.png"><a href="javascript:gridView()"><img id='imgGridView' src='images/grid_view_on.png' align=right style='width:60px;margin-left:10px'></a><a href='javascript:wideView()'><img align=right id='imgFormView' src='images/form_view.png' style='width:60px;margin-left:10px'></a><a href="javascript:queryEDITCode()"><img align=right style="height:60px" src="images/php.png"></a><img id='imgArrow1' src='images/d2.gif' style='width:25px;transform:rotate(+90deg);margin-right:10px'><a href='javascript:expand()'><img id='imgExpand' src='images/scale.png' style='width:25px'></a><img id='imgArrow2' src='images/d2.gif' style='width:25px;transform:rotate(-90deg);margin-left:10px'> TABLE/QUERY EDITOR/VIEWER </h2>
								
								<div id="tc">
									<div class="row">
										<div id="editData" class="col-md-12"></div>
									</div>
								</div>
							</div>
						</section>
					</div>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>	
					<script>

					setTimeout(function(){
						var wv='$wideView'
						setCookie('wideView',wv)
						getDataView()
					},1)

					function setCookie(cname,cvalue)	{
						var d = new Date(); 
						d.setTime(d.getTime()+(1*24*60*60*1000));
						var expires = 'expires='+d.toGMTString(); 
						document.cookie = cname + '=' + cvalue + '; ' + expires; 
					}
					
					function getCookie(cname)	{ 
						var name = cname + '='; 
						var ca = document.cookie.split(';'); 
						for(var i=0; i<ca.length; i++) { 
						  var c = ca[i].trim(); 
						  if (c.indexOf(name)==0) return c.substring(name.length,c.length); 
						} 
						return ''; 
					} 		

					function delCookie(cname) {
						var d = new Date();
						d.setTime(d.getTime());
						var expires = 'expires='+d.toGMTString();
						document.cookie = cname + '=' + '' + '; ' + expires;
					}		

					function format_sms(objSMS) {
						return ' (' + objSMS.substr(1,3) + ') ' + objSMS.substr(4,3) + '-' + objSMS.substr(7,4)
					}
					
					function $$(objID) {
						return document.getElementById(objID)
					}
					
					function getDataView() {
							var url='getEditHTML.php?wideView='+getCookie('wideView')+'&qry=$qry&db=$db'
							$.ajax({
								url		:	url,
								success	:	function(data){
									$('#editData').html(data)
									document.getElementsByClassName('rangeslider__handle')[0].innerHTML='<div style="width:150px;position:absolute;margin-bottom:50px;height:60px;bottom:0;">Page: <span style="padding:5px;background:cyan;border-radius:6px"> 1 </span><br><br><br></div>'
								}
							})
					}

					function wideView() {
						$$('imgFormView').src='images/form_view_on.png'
						$$('imgGridView').src='images/grid_view.png'
						setTimeout(function(){
							wv=1
							setCookie('wideView',wv)
							getDataView()
						},1)
					}
					
					function gridView() {
						$$('imgFormView').src='images/form_view.png'
						$$('imgGridView').src='images/grid_view_on.png'
						setTimeout(function(){
							wv=''
							setCookie('wideView','')
							getDataView()
						},1)
					}
					
					function expand() {
						if ($$('imgExpand').src.indexOf('unscale')<0) {
							$$('clsChanger').className=''
							$$('imgExpand').src='images/unscale.png'
							$$('imgArrow1').style.transform='rotate(-90Deg)'
							$$('imgArrow2').style.transform='rotate(+90Deg)'
							$$('pn').style.margin='auto'
							$$('pn').style.maxWidth='100%'
							$$('pn').style.width='100%'
							$$('editData').style.margin='30px'
						} else {
							$$('clsChanger').className='container'
							$$('imgExpand').src='images/scale.png'
							$$('imgArrow2').style.transform='rotate(-90Deg)'
							$$('imgArrow1').style.transform='rotate(+90Deg)'
							$$('pn').style.margin='auto'
							$$('pn').style.maxWidth='1200px'
							$$('pn').style.width='1200px'
							$$('editData').style.margin='0px'
						}
					}
					</script>
				</body>
			</html>
OP;
		return($op);
	}

	public function columnCount($db,$table) {
		$sql="SELECT COUNT(*) as `cols` FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '$db' AND table_name ='$table'";
		return $this->query($sql)[0]['cols'];
	}

	public function getFields($db,$table) {
		$sql="SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '$db' AND table_name ='$table'";
		return $this->query($sql);
	}
	
	public function queryEDIT($query,$wideView) {
		//Mandatory: $query must be a query, and not a table name;
		if (strlen(stristr($query,"limit"))>0) { 
			$query=str_replace("limit","LIMIT",$query);
			$q=explode("LIMIT",$query);
			//is it 'LIMIT x,y' or just 'LIMIT x'?
			if (strlen(stristr($q[1],","))>0) { 
				//It is 'LIMIT x,y'
				$sc=explode(",",$q[1]);
				$start=$sc[0];
				$count=$sc[1];
				$limit=" LIMIT " . $start . ", " . $count;
			} else {
				//It is 'LIMIT x'
				$count=$q[1];
				$limit="LIMIT " . $count;
			}
			$query=$q[0];
		} else {
			$limit = " limit " . ITEMS_PER_PAGE;
		}
		if ($this->is_mobile()=="mobile"){
			$x_m="mobile";
		}
		$first=true;
		$table  = '<style>';
		$table .= '.table_custom{padding:10px;margin:auto;left:0;right:0;margin:auto;color:#333; background:#fff; font-size:0.8em!Important; padding:10px; text-shadow:1px 1px 1px #fff} .table_header{color:#fff;background:#000;text-shadow:none} .table_row{background:aliceblue; color:#333; text-shadow:2px 2px 0px #fff} .table_row_alt{color:#000;background:#fff}';
		$table .= '</style>';
		$x=0; $first_row = true;
		$arr=explode("from ",$query);  
		$t=explode(" ",$arr[1])[0];
		$tab=$t;
		$t="'" . $t . "'";

		$columnCount=$this->columnCount($_COOKIE['db_name'],$tab)*1;
		if (($columnCount>10) || ($wideView=="1")) {
			return $this->queryEditWide($query . $limit);
		}
		$f = $this->strAB('select','from', $query);
		$f = explode(',', $f);
		$f = $this->_sql_arr($query . $limit);
		$rows = count($f);
		$header = "<div class='' style='margin-top:100px'>";	
		$table .= $header;
		for($c=0; $c <= $rows-1; $c++){
			$class = ($x==0) ? 'table_row' : 'table_row_alt';
			$x = ($x == 1) ? 0 : 1;
			$colCnt=0;
			$ctr=0;
					if ($first) {
						$first=false;
						$table .= "<div class='row $class' style='height:50px' id='th'>";
						foreach($f[$c] as $_key => $_value)	{
							$colCnt++;
						}
						$colCnt++;
						$width="";
						if ($x_m !== "mobile") {
							$width="width: " . ((1/$colCnt)*100) . '%';
						}
							foreach($f[$c] as $_key => $_value)	{
								$w=((1/$colCnt)*100) . '%';
								if ($x_m !== "mobile") {
									$table .= "<div style='$width' class='col-md-1 table_header'>" . strtoupper($_key) . "</div>";
								}
								$h[]=$_key;
							}
							$c--;
							if ($x_m !== "mobile") $table .= "<div style='$width' class='col-md-1 table_header'>DEL</div></div>";
							$ctr=0;
					} else {
						$table .= "<div class='row $class' id='r$x'>";
						foreach($f[$c] as $_key => $_value)	{
							if ($ctr==0) {
								$id=$_value;
								$index=$_key;
							}
							$fname="'".$h[$ctr]."'";
							$where="'".$h[0]."'";
							if ($x_m == "mobile") {
								$table .= "<div style='text-align:left;padding:20px;$width' onclick='setEdit(this,\"$_key|$id\")' onmouseover=\"mover(this)\" onmouseout=\"mout(this)\" class='col-md-1 table_cell'><div style='font-size:12px' contentEditable id='$_key|$id' onblur=\"update_fld($t,$fname,this,$where,$id)\"><span style='margin-left:0px'><b>" . strtoupper($_key). '</b></span><br>' . ($_value) . "</div></div>";
							} else {
								$table .= "<div style='text-align:left;padding:20px;$width' onclick='setEdit(this,\"$_key|$id\")' onmouseover=\"mover(this)\" onmouseout=\"mout(this)\" class='col-md-1 table_cell'><div style='font-size:12px' contentEditable id='$_key|$id' onblur=\"update_fld($t,$fname,this,$where,$id)\">" . ($_value) . "</div></div>";
							}
							$ctr++;
							
						}
						$table .= "<div style='$width'  class='col-md-1' style='text-align:center;opacity:0.3'><a href=\"javascript:delTableRow('$index',$id)\"><img src='images/trash.png' style='width:50px;vertical-align:center;position:;margin-top:10px'></a></div></div>";
					}
				}
		$table .= "</table>";
		$table .= "<script>
		var table
		var page=getCookie('page')
					setTimeout(function(){
						table='$tab'
						setCookie('table',table)
						if (qs('selectCell')) {
							cellSelector(qs('selectCell'))
							document.getElementsByClassName('rangeslider__handle')[0].innerHTML='<div style=\"width:150px;position:absolute;margin-bottom:50px;height:60px;bottom:0;\">Page: <span style=\"padding:5px;background:cyan;border-radius:6px\">' + (getCookie('last_page')*1+1) + '</span><br><br><br></div>'
						}
					},1000)
					function cellSelector(divID) {
						saveCSS=$$(divID).style.cssText
						console.log(saveCSS)
						$$(divID).style.background='white'
						$$(divID).style.border='5px solid red'
						$$(divID).contentEditable=true
						$$(divID).style.width='100%'
						$$(divID).style.margin='0'
						$$(divID).style.padding='10px'
						$$(divID).style.textShadow='none'
						sel(divID)
					}
					
					function mover(obj) {
						obj.style.background='gold'
					}
					function mout(obj) {
						obj.style.background=''
					}
					function $$(obj) {
						return (document.getElementById(obj))
					}
					function queryEDITCode() {
						var url='php_preview.php'
						jconfirm({content: 'url:php_preview.php', 'useBootstrap':false,'boxWidth':'850px','title':'Code For queryEDIT','theme':'material'})
					}

					var wl = window.location.href;
					var mob = (window.location.href.indexOf('file://')>=0);
		var wl = window.location.href;
		var mob = (window.location.href.indexOf('file://')>=0);";
$table .='
		function qs(name, url) {
			if (!url) {
			  url = window.location.href;
			}
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
				results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return "";
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}';
$table .="
					function update_fld(a,b,c,d,e) {
						c.style.cssText=saveCSS
						c.style.paddingLeft='10px'
						var sql='" . HOST . "/x_form_update.php?sql=update `' + a + '` set ' + b + '=\"' + c.textContent + '\" where ' + d + '=' + e + '&db_server='+getCookie('db_server')+'&db_name='+getCookie('db_name')+'&db_user='+getCookie('db_user')+'&db_password='+getCookie('db_password')
				//		console.log(sql)
						$.ajax({
							url: sql,
							success: function(msg){
								c.style.cssText=saveCSS
								c.style.paddingLeft='10px'
							}
						})
					}	
					function addRow() {
						var table=getCookie('table')
						var url = 'addTableRow.php?db_name='+getCookie('db_name')+'&table='+table
						$.ajax({
							url:url,
							success:function(data){
								console.log(data)
								setCookie('sel',data)
								var url = 'SQLEdit.php?db_name='+getCookie('db_name')+'&table='+table+'&selectCell='+data+'&page='+getCookie('last_page')
								location.href=url
								
							}
						})
					}
					function delTableRow(index,id) {
						var table=getCookie('table')
						var url = 'delTableRow.php?db_name='+getCookie('db_name')+'&table='+table+'&index='+index+'&id='+id
						$.ajax({
							url:url,
							success:function(data){
								console.log(data)
								setCookie('sel',data)
								var url = 'SQLEdit.php?db_name='+getCookie('db_name')+'&table='+table+'&page='+getCookie('page')
								location.href=url
							}
						})
					}
					var saveCSS
					function setEdit(objC,divID) {
						// objC.style.background='white'
						// objC.style.border='none'
						// objC.style.border='none'
						// objC.style.margin='0'
						// objC.style.padding='0'
						saveCSS=$$(divID).style.cssText
						console.log(saveCSS)
						$$(divID).style.background='white'
						$$(divID).style.border='5px solid red'
						$$(divID).contentEditable=true
						$$(divID).style.width='100%'
						$$(divID).style.margin='0'
						$$(divID).style.padding='0'
						$$(divID).style.textShadow='none'
						sel(divID)
					}
					function sel(node) {
						node = document.getElementById(node);
						if (document.body.createTextRange) {
							const range = document.body.createTextRange();
							range.moveToElementText(node);
							range.select();
						} else if (window.getSelection) {
							const selection = window.getSelection();
							const range = document.createRange();
							range.selectNodeContents(node);
							selection.removeAllRanges();
							selection.addRange(range);
						} else {
							console.warn('Could not select text in node: Unsupported browser.');
						}
					}
					var pre
					function php_code(n,uri) {
						pre=$$('pre')
						pre.dataset.src=uri
					}

					function edit(table) {
						//alert()
						setCookie('table',table)
						var url = 'editQuery.php?db_name='+getCookie('db_name')+'&table='+table
						$.ajax({
							url:url,
							success:function(data){
								$$('wrapper').innerHTML=data
								$$('wrapper').style.marginTop='-150px!Important;'
								cellSelector(getCookie('sel'))
							}
						})
					}

					function setCookie(cname,cvalue)	{
						var d = new Date(); 
						d.setTime(d.getTime()+(1*24*60*60*1000));
						var expires = 'expires='+d.toGMTString(); 
						document.cookie = cname + '=' + cvalue + '; ' + expires; 
					}
					
					function getCookie(cname)	{ 
						var name = cname + '='; 
						var ca = document.cookie.split(';'); 
						for(var i=0; i<ca.length; i++) { 
						  var c = ca[i].trim(); 
						  if (c.indexOf(name)==0) return c.substring(name.length,c.length); 
						} 
						return ''; 
					} 		
				</script>";
			return $table;
	}
	
	public function queryBrowse($query) {
		$first=true;
		$table  = '<style>';
		$table .= '.table_custom{padding:10px;margin:auto;left:0;right:0;margin:auto;color:#333; background:#fff; font-size:0.8em!Important; padding:10px; text-shadow:1px 1px 1px #fff} .table_header{color:#fff;background:#000;text-shadow:none} .table_row{background:aliceblue; color:#333; text-shadow:2px 2px 0px #fff} .table_row_alt{color:#000;background:#fff}';
		$table .= '</style>';
		$x=0; $first_row = true;
		$header = "<div style='max-width:100%;margin-top:100px'>";	
		$arr=explode("from ",$query);  
		$t=explode(" ",$arr[1])[0];
		$t="'" . $t . "'";
		$f = $this->strAB('select','from', $query);
		$f = explode(',', $f);
		$f = $this->_sql_arr($query);
		$table .= $header;
		//echo $query;
		$rows = count($f);
		echo $columnCount=$this->columnCount($_COOKIE['db_name'],$_COOKIE['table']);
		if ($columnCount>10) {
			return $this->queryBrowseWide($query);
		}
		for($c=0; $c <= $rows-1; $c++){
			$class = ($x==0) ? 'table_row' : 'table_row_alt';
			$x = ($x == 1) ? 0 : 1;
			$colCnt=0;		$ctr=0;
					if ($first) {
						$first=false;
						$table .= "<div class='row $class' style='height:50px' id='th'>";
						foreach($f[$c] as $_key => $_value)	{
							$colCnt++;
						}
						$colCnt++;
						foreach($f[$c] as $_key => $_value)	{
							$w=((1/$colCnt)*100) . '%';
							$table .= "<div style='width:$w' class='col-md-1 table_header'>" . strtoupper($_key) . "</div>";
							$h[]=$_key;
						}
						$c--;
						$table .= "<div style='width:$w' class='col-md-1 table_header'>DEL</div></div>";
						$ctr=0;
					} else {
						$table .= "<div onmouseover=\"mover(this)\" onmouseout=\"mout(this)\"  class='row $class' id='r$x'>";
						foreach($f[$c] as $_key => $_value)	{
								echo $cols;
							if ($ctr==0) {
								$id=$_value;
								$index=$_key;
							}
							$fname="'".$h[$ctr]."'";
							$where="'".$h[0]."'";
							$table .= "<div style='width:$w' class='col-md-1 table_cell'><div id='$_key|$id'>" . (substr($_value,0,25)) . "</div></div>";
							$ctr++;
						}
						$table .= "</div>";
					}
				}
		$table .= "</table>";
		return $table;
	}
				

	public function queryBrowseWide($query) {
		$first=true;
		$table  = '<style>';
		$table .= '.table_custom{margin:auto;left:0;right:0;margin:auto;color:#333; background:#fff; font-size:0.8em!Important;text-shadow:1px 1px 1px #fff} .table_header{color:#fff;background:#000;text-shadow:none} .table_row{background:aliceblue; color:#333; text-shadow:2px 2px 0px #fff} .table_row_alt{color:#000;background:#fff}';
		$table .= '</style>';
		$x=0; $first_row = true;
		$header = "<div style='max-width:100%;margin-top:100px'>";	
		$arr=explode("from ",$query);  
		$t=explode(" ",$arr[1])[0];
		$t="'" . $t . "'";
		$f = $this->strAB('select','from', $query);
		$f = explode(',', $f);
		$f = $this->_sql_arr($query . " LIMIT 1");
		$table .= $header;
		$rows = count($f);
		foreach($f[0] as $_key => $_value)	{
			$colCnt++;
		}		
		for($c=0; $c <= $rows-1; $c++){
			$class = ($x==0) ? 'table_row' : 'table_row_alt';
			$x = ($x == 1) ? 0 : 1;
			$colCnt=0;		$ctr=0;
					if ($first) {
						$first=false;
						$table .= "<div class='row $class' style='height:30px' id='th'>";

						$colCnt++;
						foreach($f[$c] as $_key => $_value)	{
							$w=((1/$colCnt)*100) . '%';
						//	$table .= "<div style='width:$w' class='col-md-1 table_header'>" . strtoupper($_key) . "</div>";
							$h[]=$_key;
						}
						$c--;
						$table .= "<div style='width:$w;position:absolute;z-index:99999999' class='col-md-1 table_header'>DEL</div></div>";
						$ctr=0;
					} else {
						$table .= "<div style='padding:0;margin:0;' onmouseover=\"mover(this)\" onmouseout=\"mout(this)\"  class='row' id='r$x'>";
						foreach($f[$c] as $_key => $_value)	{
							if ($ctr==0) {
								$id=$_value;
								$index=$_key;
							}
							$fname="'".$h[$ctr]."'";
							$where="'".$h[0]."'";
							$v=($_value);
							if (!$v) $v='[No Data]';
							$table .= "<div style='background:$bg!Important;position:relative;margin-top:50px'>";
							$table .= "<div style='background:$bg!Important;position:absolute;margin-top:50px;width:100%;text-align:left;font-family:tahoma;font-size:12px;' class='row'><div class='col-md-2 style='text-align:right''><b>" . strtoupper($_key) . "</b></div><div class='col-md-2 style='text-align:right''>" . $v . "</div>";
							$table .= "</div><br>";
							$ctr++;
							if ($bg=='aliceblue') $bg='white';	
								else $bg='aliceblue';
						}
						$table .= "</div><div class='row' style='width:100%;height:5px;background:red'><div class='col-md-12' style='width:100%;height:5px;background:red'></div></div>";
					}
				}
		$table .= "</table>";
		return $table;
	}
	
	public function queryEditWide($query) {
		//Mandatory: $query must be a query, and not a table name;
		if (strlen(stristr($query,"limit"))>0) { 
			$query=str_replace("limit","LIMIT",$query);
			$q=explode("LIMIT",$query);
			//is it 'LIMIT x,y' or just 'LIMIT x'?
			if (strlen(stristr($q[1],","))>0) { 
				//It is 'LIMIT x,y'
				$sc=explode(",",$q[1]);
				$start=$sc[0];
				$limit=" LIMIT " . $start . ", 1";
			} else {
				//It is 'LIMIT x'
				$limit="LIMIT 1";
			}
			$query=$q[0];
		} else {
			$query=$query . " limit 1";
		}
		$first=true;
		$table  = '<style>';
		$table .= '.table_custom{margin:auto;left:0;right:0;margin:auto;color:#333; background:#fff; font-size:0.8em!Important;text-shadow:1px 1px 1px #fff} .table_header{color:#fff;background:#000;text-shadow:none} .table_row{background:aliceblue; color:#333; text-shadow:2px 2px 0px #fff} .table_row_alt{color:#000;background:#fff}';
		$table .= '</style>';
		$x=0; $first_row = true;
		$header = "<div class='container' style='max-width:100%;margin-top:10px;padding:0'>";	
		$arr=explode("from ",$query);  
		$t=explode(" ",$arr[1])[0];
		$t="'" . $t . "'";
		$f = $this->strAB('select','from', $query);
		$f = explode(',', $f);
		$f = $this->_sql_arr($query . $limit);
		$table .= $header;
		$rows = count($f);
		foreach($f[0] as $_key => $_value)	{
			$colCnt++;
		}
		$bg="white";
		for($c=0; $c <= $rows-1; $c++){
			$class = ($x==0) ? 'table_row' : 'table_row_alt';
			$x = ($x == 1) ? 0 : 1;
			$colCnt=0;		$ctr=0;
					if ($first) {
						$first=false;
						$colCnt++;
						foreach($f[$c] as $_key => $_value)	{
							$w=((1/$colCnt)*100) . '%';
							$h[]=$_key;
						}
						$c--;
						$ctr=0;
					} else {

						foreach($f[$c] as $_key => $_value)	{
							if ($ctr==0) {
								$id=$_value;
								$index=$_key;
							}
							$fname="'".$h[$ctr]."'";
							$where="'".$h[0]."'";
							$v=($_value);
							if (!$v) $v='[No Data]';
							$table .= "<div style='border-bottom:5px solid #f0f0f0;background:$bg!Important;width:100%;text-align:left;font-family:tahoma;font-size:14px;padding:10px;margin:0' class='row'><div class='col-md-2' style='text-align:left;margin-left:20px;color:#000'><b>" . strtoupper($_key) . "</b></div><div class='col-md-10' contentEditable id='$_key|$id' onblur=\"update_fld($t,$fname,this,$where,$id)\" style='margin-left:20px'>" . $v . "</div>";
							$table .= "</div>";
							$ctr++;
							if ($bg=='aliceblue') $bg='white';	
								else $bg='aliceblue';
						}
					}
				}
		$table .= "</table>";
		$table .= "<script>
					setCookie('wideView','1')
					function update_fld(a,b,c,d,e) {
						c.style.cssText=saveCSS
						c.style.paddingLeft='10px'
						var sql='" . HOST . "/x_form_update.php?sql=update `' + a + '` set ' + b + '=\"' + c.textContent + '\" where ' + d + '=' + e + '&db_server='+getCookie('db_server')+'&db_name='+getCookie('db_name')+'&db_user='+getCookie('db_user')+'&db_password='+getCookie('db_password')
						console.log(sql)
						$.ajax({
							url: sql,
							success: function(msg){
								c.style.cssText=saveCSS
								c.style.paddingLeft='10px'
							}
						})
					}	
					function addRow() {
						var table=getCookie('table')
						var url = '../addTableRow.php?db_name='+getCookie('db_name')+'&table='+table
						$.ajax({
							url:url,
							success:function(data){
								edit(table)
							}
						})
					}
					function delTableRow(index,id) {
						var table=getCookie('table')
						var url = '../delTableRow.php?db_name='+getCookie('db_name')+'&table='+table+'&index='+index+'&id='+id
						$.ajax({
							url:url,
							success:function(data){
								edit(table)
							}
						})
					}
					var saveCSS
					function setEdit(objC,divID) {
						objC.style.background='white'
						objC.style.border='none'
						objC.style.margin='0'
						objC.style.padding='0'
						saveCSS=$$(divID).style.cssText
						console.log(saveCSS)
						$$(divID).style.background='white'
						$$(divID).style.border='5px solid red'
						$$(divID).contentEditable=true
						$$(divID).style.width='100%'
						$$(divID).style.height='100%'
						$$(divID).style.margin='0'
						$$(divID).style.padding='10px'
						$$(divID).style.fontSize='16px'
						$$(divID).style.textShadow='none'
						sel(divID)
					}
					function sel(node) {
						node = document.getElementById(node);
						if (document.body.createTextRange) {
							const range = document.body.createTextRange();
							range.moveToElementText(node);
							range.select();
						} else if (window.getSelection) {
							const selection = window.getSelection();
							const range = document.createRange();
							range.selectNodeContents(node);
							selection.removeAllRanges();
							selection.addRange(range);
						} else {
							console.warn('Could not select text in node: Unsupported browser.');
						}
					}
					var pre
					function php_code(n,uri) {
						pre=$$('pre')
						pre.dataset.src=uri
					}
					function delTableRow(index,id) {
						var table=getCookie('table')
						var url = '../delTableRow.php?db_name='+getCookie('db_name')+'&table='+table+'&index='+index+'&id='+id
						$.ajax({
							url:url,
							success:function(data){
								edit(table)
							}
						})
					}
					function edit(table) {
						setCookie('table',table)
						var url = '../editTable.php?db_name='+getCookie('db_name')+'&table='+table
						$.ajax({
							url:url,
							success:function(data){
								$$('wrapper').innerHTML=data
								$$('wrapper').style.marginTop='-150px!Important;'
							}
						})
					}

					function setCookie(cname,cvalue)	{
						var d = new Date(); 
						d.setTime(d.getTime()+(1*24*60*60*1000));
						var expires = 'expires='+d.toGMTString(); 
						document.cookie = cname + '=' + cvalue + '; ' + expires; 
					}
					
					function getCookie(cname)	{ 
						var name = cname + '='; 
						var ca = document.cookie.split(';'); 
						for(var i=0; i<ca.length; i++) { 
						  var c = ca[i].trim(); 
						  if (c.indexOf(name)==0) return c.substring(name.length,c.length); 
						} 
						return ''; 
					} 		
				</script>";
				return $table;
	}
}
