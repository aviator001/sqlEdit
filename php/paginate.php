<?
	$cnt=$c->query("select count(*) as `cnt` from $table")[0]['cnt'];
	if (!isset($page)) $page=0;
	$skip=round($cnt/50);
	$lp=floor($cnt/ITEMS_PER_PAGE);
	foreach($arr as $_key => $_value)	{
		if($_key !=="page") {
			$str .= $_key . "=" . $_value . "&";
		}
	}
	if ($lp>$page+5) {
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
			$n0=0.3;
			$qsn = "";
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
	$start=$page*ITEMS_PER_PAGE;
	if (!empty($table)) {
		$qry="select * from $table limit $start," . ITEMS_PER_PAGE;
	} else {
		$qry="$query limit $page," . ITEMS_PER_PAGE;
	}
	$last_page="?page=" . $lp . "&" . $str;
	$first_page="?page=0&" . $str;
	if ($page==$lp) {
		$pl=0.3;
	} else {
		$pl=1;
	}	
	if ($page==0) {
		$pf=0.3;
	} else {
		$pf=1;
	}
	//echo $qry;
?>
		<link href="https://fonts.googleapis.com/css?family=Orbitron|Open+Sans+Condensed:300" rel="stylesheet">
		<link rel="stylesheet" href="rangeslider.css">
		<style>
			.rangeslider,
			.rangeslider__fill {
			height:30px;
			padding:0;
			margin:0;
			transition: background 0.3s;
			width:100%;
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
		</style>
		<?	
			$padding="15px";
			if ($page < 100) {
				$paddingLeft="20x";
				$paddingRight="20px";
			}
			if ($page < 10) {
				$paddingLeft="25px";
				$paddingRight="25px";
			}
		?>
		<div id="pn" style="margin-bottom:10px;position:relative;margin:auto;width:1200px;max-width:1200px;margin:auto;;text-align:center;font-size:21px;font-family:Orbitron"><b>PAGE: <span id="pns" style="font-family:Open Sans Condensed;background:white;padding:<?=$padding;?>;padding-left:<?=$paddingLeft;?>;padding-right:<?=$paddingRight;?>;border-radius:50px"><?=$page*1+1;?></span></b><a href="javascript:addRow()"><button class="btn btn-sm btn-danger" style="position:absolute;right:15px;">Add New Row</button></a></div>
		<? if ($c->is_mobile()) { ?>
		<div class="col-md-12" style="text-align:center;opacity:1;position:fixed;bottom:0;left:0;height:120px;background:#f0f0f0;overflow:hidden">
			<input style="position:absolute;margin-top:200px" type="range" min="0" max="<?=$lp;?>">
			<a href="<?=$first_page;?>"><img id="p10" src="images/first.png" style="width:10%;text-align:right;opacity:<?=$pf;?>"></a>
			<a href="<?=$qsp10;?>"><img id="p10" src="images/prev_few.png" style="width:15%;text-align:right;opacity:<?=$p10;?>"></a>
			<a href="<?=$qsp;?>"><img id="p1" style="width:20%;opacity:<?=$p0;?>" src="images/prev.png"></a>
			<a href="<?=$qsn;?>"><img id="n1" style="width:20%;opacity:<?=$n0;?>"  src="images/next.png"></a>
			<a href="<?=$qsn10;?>"><img id="n10" src="images/next_few.png" style="width:15%;opacity:<?=$n10;?>"></a>
			<a href="<?=$last_page;?>"><img id="n10" src="images/last.png" style="width:10%;opacity:<?=$pl;?>"></a>
		</div>
		<? } else { ?><br>
		<div id="rangeHolder" style="width:1200px;max-width:1200px;margin:auto">
			<input style="position:absolute;margin-top:220px;margin:auto" type="range" min="0" max="<?=$lp;?>">		
		</div>
		<div class="col-md-12" style="text-align:center;opacity:1">
			<a href="<?=$first_page;?>"><img id="p10" src="images/first.png" style="width:50px;text-align:right;opacity:<?=$pf;?>"></a>
			<a href="<?=$qsp10;?>"><img id="p10" src="images/prev_few.png" style="width:75px;text-align:right;opacity:<?=$p10;?>"></a>
			<a href="<?=$qsp;?>"><img id="p1" style="width:100px;opacity:<?=$p0;?>" src="images/prev.png"></a>
			<a href="<?=$qsn;?>"><img id="n1" style="width:100px;opacity:<?=$n0;?>"  src="images/next.png"></a>
			<a href="<?=$qsn10;?>"><img id="n10" src="images/next_few.png" style="width:75px;opacity:<?=$n10;?>"></a>
			<a href="<?=$last_page;?>"><img id="n10" src="images/last.png" style="width:50px;opacity:<?=$pl;?>"></a>
		</div>
		<? } ?>
		<script src="js/jquery.js"></script>
		<script src="rangeslider.min.js"></script>
		<script>
			var qstr,qry,start,page,table=qs('table')
			var items_per_page='<?=ITEMS_PER_PAGE;?>'
			setTimeout(function(){
				setCookie('page','<?=$page;?>')
				qstr='<?=$str;?>'
				setCookie('last_page','<?=$lp;?>')
			},1)
			$(function() {
				$('input[type=range]')
					.rangeslider({
						polyfill: false,
						onSlide: function(position, value) {
							console.log(value)
							gotoPage(value)
							$('#pns').text(value+1)
							document.getElementsByClassName('rangeslider__handle')[0].innerHTML='<div style="width:150px;position:absolute;margin-bottom:50px;height:60px;bottom:0;">Page: <span style="padding:5px;background:cyan;border-radius:6px">' + (value+1) + '</span><br><br><br></div>'
							var padding="15px";
							var paddingL="17px"
							var paddingR="17px"
							if (value < 100) {
								padding="15px";
								var paddingL="20px"
								var paddingR="20px"
							}
							if (value < 10) {
								padding="15px";
								var paddingL="25px"
								var paddingR="25px"
							}
							$$('pns').style.padding=padding
							$$('pns').style.paddingLeft=paddingL
							$$('pns').style.paddingRight=paddingR
							
						}
					})
				});
				$('input[type=range]').val(<?=$page;?>)
				var xt
				function gotoPage(page) {
					clearTimeout(xt)
					xt=setTimeout(function(){
						_goto_page(page)
					},1000)
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
					function qs(name, url) {
			if (!url) {
			  url = window.location.href;
			}
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
				results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

		function _goto_page(page) {
			var table=qs('table')
			if (!table) {
				table='<?=$table;?>'
				if (!table) table=getCookie('table')
			}
			if (page>=getCookie('last_page')*1) page=getCookie('last_page')*1
					if (page<0) page=0;
					start=page*items_per_page;
					if (table  !== '') {
						qry="select * from "+table+" limit " + start +"," + items_per_page
					} else {
						qry=qs('query') + " limit " + page + "," + items_per_page;
					}
					var url='getEditHTML.php?wideView='+getCookie('wideView')+'&qry='+qry+'&'+qstr+'&db='+getCookie('db_name')
					$.ajax({
						url		:	url,
						success	:	function(data){
							$('#editData').html(data)
						}
					})					
				}
			</script>	