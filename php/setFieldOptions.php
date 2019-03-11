<? include "base_php.php";?>
<? include "class/utils.class.php";?>
<? $c=new utils;?>
<?
	
	?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<script src="js/media_queries.js"></script>
		<? include "meta.php";?>
		<title><?=$title;?></title>
		<? include "css.php";?>
		<? include "style.php";?>
		<link href="css/vendor/bootstrap.min.css" rel="stylesheet">
		<link href="css/flat-ui.css" rel="stylesheet">
	<style>
			.jconfirm-content-pane {overflow:hidden!Important}
			.jconfirm-content {overflow:hidden!Important}
			.no-scroll {overflow:hidden!Important}
		</style>	</head>
	<body>
		<? include "body_pre.php";?>
		<h1>
			<?=$body_title;?>
		</h1>
		<?=$page_into;?>
		<? echo $_GET['table'];?>
		<div id="options" style="text-align:center">
		<? 
			$c->connect(DB_SERVER,DB_USER,DB_PASS,$_COOKIE['DB_NAME']);
			echo $c->showFieldOptions($_COOKIE['db_name'],$_GET['table']);
		?>
		<br><button onclick="genPHP()" class="btn btn-danger center set-center">Generate PHP</button><br>
		</div>
		<? include "body_post.php";?>
		<? include "scripts.php"; ?>
		<script src="scripts/flat-ui.js"></script>
		<script>
			Dropzone.autoDiscover=false
			var field_types=[]
			var field_input_values=[]
			var field_defaults=[]
			var field_labels=[]
			var field_placeholders=[]
			var field_select=[]
			var field_check=[]
			var field_radio=[]
			var field_names=[]
			var field_show=[]
			var field_hide=[]
			var field_rules=[]
			var ac_field_types=[]
			var optionS=[]
			var optionC=[]
			var optionR=[]
			var fields=[]
			var ops=[]
			var data=[]
			var operand
			var f='<?echo $c->getAllFields($_COOKIE['db_name'],$_GET['table']);?>'
			fields=f.split(',')
			field_names=fields
		function autx(id) {
//alt.close()
		var content='<div class="row" style="margin-top:-50px">'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'cities\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Location - Cities'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'states\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Location - US States'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'zip\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Location - US Postal Codes'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'ebay\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Ebay Catalog - All Items'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'bb\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Best Buy Catalog - All Items'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'food\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Food'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'rest\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Resturants in LA'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'telco\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							All Telecom companies'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'countries\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							List of Countries'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'cars\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							US Automobile Database'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'rx\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Prescription Medication'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'symptoms\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Health Conditions'
			content+='						</label>'
			content+='					</div>'
			content+='					<div class="col-md-6" onclick="setTypeAC(\'custom\',id)">'
			content+='						<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
			content+='							Select field from table'
			content+='						</label>'
			content+='					</div>'
			content+='			</div>'
			//alc=$.dialog({boxWidth:'800px',useBootstrap:false,title:'<label for="login-form-username"> SELECT AUTOCOMPLETE TYPE</label>',content:content})
			alt.setContent(content)
		}		
			var alc,alt,jrl,slt,clt,rlt
			var table='<?=$_GET['table'];?>'
			
			setTimeout(function(){
				setCookie('table',table)
			},1)
			
			function self(act) {
				var id=getCookie('acid')
				$('#btn_'+id).text('ac_'+ act)
				  setTimeout(function() { 
						ac_field_types[id]=act
						console.log(field_types)
				  }, 0);
			  }
			function stypes(id) {
				var str='<table><tr>'
				str +='<td style="width:200px;vertical-align:top;background:#f0f0f0;padding:20px;font-size:0.8em">'
				str += '<div style="margin-left:10px"><span style="font-weight:700">HTML5 Field Types</span></div>'
				str += '<div onclick="setType(\'text\','+id+')" style="margin-left:10px"><label class="radio"><input checked type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Generic Text</label></div>'
				str += '<div onclick="setType(\'phone\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Phone</label></div>'
				str += '<div onclick="setType(\'email\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Email</label></div>'
				str += '<div onclick="setType(\'number\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Number</label></div>'
				str += '<div onclick="setType(\'currency\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Currency</label></div>'
				str += '<div onclick="setType(\'age\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Age</label></div>'
				str += '<div onclick="setType(\'username\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Username</label></div>'
				str += '<div onclick="setType(\'password\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Password</label></div>'
				str += '<div onclick="setType(\'color\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Color</label></div>'
				str += '<div onclick="setType(\'datetime\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Datetime</label></div>'
				str += '<div onclick="setType(\'date\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Date</label></div>'
				str += '<div onclick="setType(\'time\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Time</label></div>'
				str += '<div onclick="setType(\'month\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Month</label></div>'
				str += '<div onclick="setType(\'week\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Week</label></div>'
				str +='<td style="width:200px;vertical-align:top;background:aliceblue;padding:20px;font-size:0.8em">'
				str += '<div style="margin-left:10px"><span style="font-weight:700">Custom Fields</span></div>'
				str += '<div onclick="setType(\'ac\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Autocomplete</label></div>'
				str += '<div onclick="setType(\'location\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Location</label></div>'
				str += '<div onclick="setType(\'city\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>City</label></div>'
				str += '<div onclick="setType(\'state\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>State</label></div>'
				str += '<div onclick="setType(\'zip\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Zipcode</label></div>'
				str += '<div onclick="setType(\'remote\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Remote Content</label></div>'
				str += '<div onclick="setType(\'image\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Image Search</label></div>'
				str += '<div onclick="setType(\'instagram\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Instagram Search</label></div>'
				str +='<td style="width:200px;vertical-align:top;background:#f0f0f0;padding:20px;font-size:0.8em">'
				str += '<div style="margin-left:10px"><span style="font-weight:700">Input Type</span></div>'
				str += '<div onclick="setType(\'html\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>HTML Editor</label></div>'
				str += '<div onclick="setType(\'textarea\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Textarea</label></div>'
				str += '<div onclick="setType(\'soundcloud\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Soundcloud</label></div>'
				str += '<div onclick="setType(\'youtube\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Youtube</label></div>'
				str += '<div onclick="setType(\'audio_file\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Embed Audio</label></div>'
				str += '<div onclick="setType(\'video_file\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Embed Video</label></div>'
				str += '<div onclick="setType(\'image_file\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Embed Image</label></div>'
				str += '<div onclick="setType(\'select\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Select Box</label></div>'
				str += '<div onclick="setType(\'check\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Check Box</label></div>'
				str += '<div onclick="setType(\'radio\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Radio Buttons</label></div>'
				str += '<div onclick="setType(\'tags\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Input Tags</label></div>'
				str += '<div onclick="setType(\'upload\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Upload Image</label></div>'
				str += '<div onclick="setType(\'span\','+id+')" style="margin-left:10px"><label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>Read Only Span</label></div>'
				str += '</td></tr></table>'
			   str += ' </ul>';		 
			   alt=$.dialog({title:'Set Field Type',boxWidth:'600px',useBootstrap:false,content:str})
			} 
			function setType(tp,id) {
				setCookie('acid',id)
				$('#btn_'+id).text(tp)
				document.getElementById('btn_'+id).className='btn btn-xs btn-info dropdown-toggle'
				document.getElementById('btn_'+id).style.color='white'
				console.log(id)
				field_types[id]=tp
				console.log(field_types)
				if (tp=='ac') autx(id)
				if (tp=='select') buildSelect(id)
				if (tp=='check') buildCheck(id)
				if (tp=='radio') buildRadio(id)
				data['field_types']=field_types
				console.log(data)
			}
			
			function setTypeAC(tp,id) {
				id=getCookie('acid')
				field_types[id]='ac_'+tp
				console.log(field_types)
				data['field_types']=field_types
				self(tp)
				if (tp=='custom') setCustomTable()
					else $('.jconfirm').hide()
			}
			
			function setCustomTable() {
				var cstr=''
				cstr += '<table><tr><td>Select a field for autocomplete to pick values from</td></tr><tr>'
				$.ajax({
					url		:	'x_get_tables.php',
					success	:	function(data){
						var tables=JSON.parse(data)
						cstr += '<td style="width:100%;text-align:left;vertical-align:top;background:#f0f0f0;padding:20px;font-size:0.8em">'
						for (var i=0;i<tables.length; i++) {
							cstr += '<div onclick="setCustomField(\''+tables[i]+'\')" style="margin-left:10px"><label class="radio"><input checked type="radio" name="optionFields" id="optionFields" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'+tables[i]+'</label></div>'
						}
						cstr+='</td></tr></table>'
						alt.setContent(cstr)
					}
				})
			}
			
			function setCustomField(tabx) {
				setCookie('ac_custom_table',tabx)
				$.ajax({
					url		:	'x_get_fields.php?table='+tabx,
					success	:	function(data){
						var flds=JSON.parse(data);
						var cstr=''
						cstr += '<table><tr><td>Select a field for autocomplete to pick values from</td></tr><tr>'
						cstr += '<td style="width:100%;text-align:left;vertical-align:top;background:#f0f0f0;padding:20px;font-size:0.8em">'
						for (var i=0;i<flds.length; i++) {
							cstr += '<div onclick="selectCustomField(\''+flds[i]+'\')" style="margin-left:10px"><label class="radio"><input checked type="radio" name="optionFields" id="optionFields" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'+flds[i]+'</label></div>'
						}
						cstr+='</td></tr></table>'
						alt.setContent(cstr)
					}
				})
			}
			
			function selectCustomField(fld) {
				setCookie('ac_custom_field',fld)
				$('.jconfirm').hide()
			}
			var str=''

			function buildSelect(id) {
				str='<div><input id="selbs" type="text"><button class="btn btn-info btn-sm" onclick="addS('+id+')">Add to List</button><button class="btn btn-danger btn-sm" onclick="endS('+id+')">Finish</button></div>'
				slt=$.dialog({title:'Set Select Dropdown values for '+fields[id],boxWidth:'600px',useBootstrap:false,content:str})
			}
			
			function addS(id) {
				var name = slt.$content.find('#selbs').val();
				optionS.push(name)
				field_select[id]=optionS.join('|')
				var istr=''
				for (var i=0;i<optionS.length; i++) {
					istr += '<div>' + (i+1) + '. ' + optionS[i] + '</div>'
				}
				slt.setContent(istr+str)
				data['field_select']=field_select
				$('#txt_val_'+id).val(optionS.join(','))
				console.log(data)
			}
			function endS(id) {
				slt.close()
				$('.jconfirm').hide()
			}			
			function buildCheck(id) {
				str='<div><input id="chkbs" type="text"><button class="btn btn-info btn-sm" onclick="addC('+id+')">Add to List</button><button class="btn btn-danger btn-sm" onclick="endC('+id+')">Finish</button></div>'
				clt=$.dialog({title:'Set Checkbox Entries for '+fields[id],boxWidth:'600px',useBootstrap:false,content:str})
			}
			
			function addC(id) {
				var name = clt.$content.find('#chkbs').val();
				optionC.push(name)
				field_check[id]=optionC.join('|')
				var istr=''
				for (var i=0;i<optionC.length; i++) {
					istr += '<div>' + (i+1) + '. ' + optionC[i] + '</div>'
				}
				clt.setContent(istr+str)
				data['field_check']=field_check
				$('#txt_val_'+id).val(optionC.join(','))
				console.log(data)
			}
			
			function endC(id) {
				clt.close()
				$('.jconfirm').hide()
			}			
			function buildRadio(id) {
				str='<div><input id="radbs" type="text"><button class="btn btn-info btn-sm" onclick="addR('+id+')">Add to List</button><button class="btn btn-danger btn-sm" onclick="endR('+id+')">Finish</button></div>'
				rlt=$.dialog({title:'Set Checkbox Entries for '+fields[id],boxWidth:'600px',useBootstrap:false,content:str})
			}
			
			function addR(id) {
				var name = rlt.$content.find('#radbs').val();
				optionR.push(name)
				field_radio[id]=optionR.join('|')
				var istr=''
				for (var i=0;i<optionR.length; i++) {
					istr += '<div>' + (i+1) + '. ' + optionR[i] + '</div>'
				}
				rlt.setContent(istr+str)
				data['field_radio']=field_radio
				$('#txt_val_'+id).val(optionR.join(','))
				console.log(data)
			}
			
			function endR(id) {
				rlt.close()
				$('.jconfirm').hide()
			}			

			function setRules(id) {
				var cstr=''
				ops=['=','<','<=','>','>=','<>']
				cstr += '<table><tr>'
				cstr += '<td style="width:200px;vertical-align:top;background:#f0f0f0;padding:20px;font-size:0.8em">'
				for (var i=0;i<fields.length; i++) {
					cstr += '<div onclick="setCondition(\''+fields[i]+'\','+id+')" style="margin-left:10px"><label class="radio"><input checked type="radio" name="optionFields" id="optionFields" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'+fields[i]+'</label></div>'
				}
				cstr += '</td><td>'
				for (var op=0;op<ops.length; op++) {
					cstr+='	<div class="col-md-6" onclick="setOperand('+op+','+id+')">'
					cstr+='		<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
					cstr+='			'+ops[op]
					cstr+='		</label>'
					cstr+='	</div>'
				}
				cstr += '</td><td><input onblur="setRuleValue(this,'+id+')" type="text" class="form-group" id="condition_value_'+id+'"></td></tr></table>'
			    jrl=$.dialog({title:'Set Rules for display',boxWidth:'600px',useBootstrap:false,content:cstr})
			}
			var currRuleField
			function setCondition(field,id)  {
				currRuleField=field
				field_rules[id]=currRuleField
			}
			
			function setOperand(op,id)  {
				operand=ops[op]
				if (operand=='=') operand='=='
				if (field_rules[id]) {
					field_rules[id] = currRuleField + operand
					console.log(field_rules)
				}
			}
			
			function setRuleValue(rv,id)  {
				if (field_rules[id]) {
					if (operand) {
						field_rules[id] = field_names[id] + '|' + $('#rules_'+id).text() + '|' + currRuleField + '|' + operand + '|' + rv.value
					}
				}
				console.log(field_rules)
			}
			
			function read_only(id) {
				if ($('#ro_'+id).html()=='User Data Input') {
					$('#ro_'+id).html('View Only')
					field_ro[id]='1'
				} else {
					$('#ro_'+id).html('User Data Input')
					field_ro[id]=''
				}
				console.log(field_ro)
			}

			function sh(id) {
				if ($('#sh_'+id).html()=='Show') {
					$('#sh_'+id).html('Hide')
					$('#rules_'+id).text('Show If')
					field_hide[id]='1'
					document.getElementById('rules_'+id).className='btn btn-xs btn-warning dropdown-toggle'
					document.getElementById('rules_'+id).style.color='white'					
					document.getElementById('sh_'+id).style.color='red'					
				} else {
					$('#sh_'+id).html('Show')
					field_hide[id]=''
					$('#rules_'+id).text('Hide If')
					document.getElementById('rules_'+id).className='btn btn-xs btn-default dropdown-toggle'
					document.getElementById('rules_'+id).style.color='black'					
					document.getElementById('sh_'+id).style.color='black'					
				}
				console.log(field_show)
			}

			function setLabels(obj) {
				var id=obj.id.replace('txt_','')*1-1
				var val=obj.value
				field_names[id]=val
				field_labels[id]=val
				console.log(field_names)
			}

			function setDefaults(obj) {
				var id=obj.id.replace('txt_val_','')*1-1
				var val=obj.value
				field_defaults[id]=val
			}

			function setPlaceholders(obj) {
				var id=obj.id.replace('txt_plc_','')*1-1
				var val=obj.value
				field_placeholders[id]=val
				console.log(field_names)
			}
			
			function setCookie(cname,cvalue,exdays)	{
				var d = new Date();
				d.setTime(d.getTime()+(exdays*24*60*60*1000));
				var expires = "expires="+d.toGMTString();
				document.cookie = cname + "=" + cvalue + "; " + expires;
			 }	
					
			function getCookie(cname)	{ 
				var name = cname + "="; 
				var ca = document.cookie.split(";"); 
				for(var i=0; i<ca.length; i++) { 
				  var c = ca[i].trim(); 
				  if (c.indexOf(name)==0) return c.substring(name.length,c.length); 
				} 
				return ""; 
			} 	
			var cnt='Your php file was generated successfully! You may go back, preview your creation or build more. <br><br>Please select option below.'
			
			function genPHP() {
				setCookie('table',table)
				var url = 'createPHP.php?db_name='+getCookie('db_name')+'&table='+table+'&field_types=text'+field_types.join(',')+'&field_select='+field_select.join(',')+'&field_check='+field_check.join(',')+'&field_radio='+field_radio.join(',')+'&field_labels='+field_labels.join(',')+'&field_defaults='+field_defaults.join(',')+'&field_placeholders='+field_placeholders.join(',')+'&field_hide=1'+field_hide.join(',')+'&field_rules='+field_rules.join(',')
				console.log(url);
				$.ajax({
					url		:	url,
					success	:	function(data){
						if (data=='php_'+table+'.php') {
							jc=$.confirm({
								title	:'Success',
								type	:'green',
								theme	:'modern',
								content	: cnt,
								buttons	:{
									Preview:function(){
										showPreview('output/php_'+table+'.php', table.toUpperCase() + ' PREVIEW')
									},
									ViewPHPCode:{
										text:'View PHP Code',
										action:function(){
											showPHP('code_preview.php?uri=output/php_'+table+'.php')
										}
									}
								}
							})
						} else {
							$.alert({title:'Error',type:'red',theme:'modern', content: data})
						}
					}
				})
			}
			
			function showPreview(url,title) {
				window.open(url)
			}
			
			function showPHP(url) {
				window.open(url)
			}
			
			function setOptions(t) {
				location.href='setFieldOptions.php?table='+t
			}
					
					
	</script>
		<? include "js.php"; ?>
	</body>
</html>
	