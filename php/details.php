		<link href="css/flat-ui.css" rel="stylesheet">
		<div class="col-md-12" style="text-align:center" id="jsFns">
					
				</div>
				<div style="padding:50px;margin:auto;background:#f9f9f9;padding-top:10px;padding-bottom:10px;box-shadow:0 0 25px rgba(0,0,0,0.1);border-radius:4px;position:relative">	
					<h2 id="title">DATABASE CREDENTIALS</h2>
					<img src="images/logo_small.png" style="position:absolute;width:100px;top:30px;right:30px">
					<div id="tc">
						<div class="row">
							<div class="col-md-12">
								<label for="login-form-username">SERVER IP</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-server"></i></span>
									<input placeholder="Text Box for Color" type="text" id="db_server"  name="server" value="" class="form-control large-font">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="login-form-username">DATABASE NAME</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-database"></i></i></span>
									<input placeholder="Text Box for Color" type="text" id="db_name"  name="db" value="" class="form-control large-font">
								</div>
							</div>
						</div>
						<div class="row" style="">
							<div class="col-md-12">
								<label for="login-form-username"> DATABASE USERNAME:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input placeholder="Text Box for Usernames" type="user" id="db_user"  name="user" value="" class="form-control large-font">
								</div>
							</div>
						</div>
						<div class="row" style="">
							<div class="col-md-12">
								<label for="login-form-username"> DATABASE PASSWORD:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input placeholder="Text Box for Passwords" type="password" id="db_password" name="pswd" value="" class="form-control large-font">
								</div>
							</div>
						</div>
						<div class="row" style="">
							<div class="col-md-12" style="text-align:center">
								<button onclick="getTables()" class="btn btn-info">Show Tables</button>
							</div>
						</div>	
						<div class="row" style="">

							<div id="res1" style="display:none">
								<div style="font-family:Open Sans;font-weight:300;font-size:44px">RESULTS </div>
								<input onclick="rescan()" type="button" style="font-size:18px;width:150px;height:50px;padding:10px;border:0px solid silver;border-radius:4px;color:#333;background:lavenderblush" value=" RESET "/>
								<div id="data1" style="width:100%"></div>
								<div id="fs1" style="width:100%"></div>
							</div>
														
						</div>	
					</div>
				</div>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
				<script src="js/jquery.js"></script>				
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>				
				<script>
					function $$(objID) {
						return document.getElementById(objID)
					}
					var arrObjs=['db_server','db_name','db_user','db_password']
					arrObjs.forEach(function(obj) {
						if (getCookie(obj)) {
							window[obj]=getCookie(obj)
							$$(obj).value=eval(obj)
						}
					});
					
					function getTables(chk) {
						if (!chk) {
							if (!$$('db_server').value || !$$('db_name').value || !$$('db_user').value || !$$('db_password').value) {
								$.alert({title:'',theme:'modern', content:'Sorry, no empty fields, if you want to see the tables in your database!'})
							}
							setCookie('db_server', $$('db_server').value)
							setCookie('db_name', $$('db_name').value)
							setCookie('db_user', $$('db_user').value)
							setCookie('db_password', $$('db_password').value)
						}
						
						var url = 'listTables.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password')
						var str = '<table style=""><div class="row"><div class="col-md-12">'
						str += "<div>To enter a query, click below:<br><button class='btn btn-danger' onclick='setQuery()'>Enter Query</button></div>"
						$.ajax({
							url:url,
							success:function(data){
								var tables=JSON.parse(data)
								for (var i=0;i<tables.length;i++) {
									str += '<tr style=""><td style="padding:5px;width:300px">' + (i+1) + '. ' + tables[i] + '</td>' +
										'<td style="width:30px"><button id="tab_browse_'+i+'" onclick="browse(\''+tables[i] + '\')" class="btn btn-sm btn-default"><i class="fas fa-database"></i></button></td>' +
										'<td style="width:30px"><button id="edit_'+i+'" onclick="edit(\''+tables[i] + '\')" class="btn btn-sm btn-default"><i class="fas fa-edit"></i></button></td>' +
										'<td style="width:30px"><button id="genphp_'+i+'" onclick="genPHP(\''+tables[i] + '\')" class="btn btn-sm btn-default"><i class="fas fa-file-alt"></i></button></td>' +
										'<td style="width:30px"><button id="options_'+i+'" onclick="setOptions(\''+tables[i] + '\')" class="btn btn-sm btn-default"><i class="fas fa-cog"></i></button></td>' +
									'</tr>'
								}
								str += '</table></div></div>'
								$$('title').innerHTML='TABLE LIST'
								$$('tc').innerHTML =str
								str=''
								str += '<div class="row">'
								str += '<div class="col-md-1">'
								str += '<br>'
								str += '</div>'
								str += '<div class="col-md-11">'
								str += '<h4>NEXT STEP: SELECT FUNCTION</h4>'
								str += '</div>'
								str += '</div>'
								str += '<div class="row">'
								str += '<div class="col-md-1">'
								str +='<label class="radio"><input checked type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
								str +='</label>'
								str += '</div>'
								str += '<div class="col-md-11">'
								str += '<b>GENERATE REPORTS FROM MYSQL TABLE</b><br>'
								str += '<span style="color:grey;font-size:0.9em">I want to auto-generate HTML based reports from a database/table of my choosing (Just 4 lines of code using the api, if you want to generate this yourself, for your site or a clients site)</span>'
								str += '</div>'
								str += '</div>'
								str += '<div class="row">'
								str += '<div class="col-md-1">'
								str +='<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
								str +='</label>'
								str += '</div>'
								str += '<div class="col-md-11">'
								str += '<b>GENERATE REPORTS FROM MYSQL QUERY</b><br>'
								str += '<span style="color:grey;font-size:0.9em">I want to instantly auto-generate HTML based reports from a custom SQL query that may invlove data one or more tables(Just 4 lines of code using the api, if you want to generate this yourself, for your site or a clients site)</span>'
								str += '</div>'
								str += '</div>'
								str += '<div class="row">'
								str += '<div class="col-md-1">'
								str +='<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
								str +='</label>'
								str += '</div>'
								str += '<div class="col-md-11">'
								str += '<b>GENERATE APP THAT CAN EDIT MYSQL TABLE DATA</b><br>'
								str += '<span style="color:grey;font-size:0.9em">I want to instantly auto-generate a web application that allows me to edit, delete or add data from databse/table of my choosing(Just 4 lines of code using the api, if you want to generate this yourself, for your site or a clients site)</span>'
								str += '</div>'
								str += '</div>'
								str += '<div class="row">'
								str += '<div class="col-md-1">'
								str +='<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
								str +='</label>'
								str += '</div>'
								str += '<div class="col-md-11">'
								str += '<b>GENERATE DATA ENTRY FROMS FROM MYSQL TABLE</b><br>'
								str += '<span style="color:grey;font-size:0.9em">I want to instantly auto-generate a web form using selected MySQL table and be able to provide to my clients, the ability to use this form to do data entry, OR just the actual PHP code taht we generate for you, which in turn generates such functionality withing a php/html/node.js app(Code is available instantly upon configuring the options for your page or form)</span>'
								str += '</div>'
								str += '</div>'
								str += '<div class="row">'
								str += '<div class="col-md-1">'
								str +='<label class="radio"><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" data-toggle="radio" class="custom-radio"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>'
								str +='</label>'
								str += '</div>'
								str += '<div class="col-md-11">'
								str += '<b>GENERATE COMPLEX FROMS USING WIDGET AND AUTOCOMPLETE LIBRARY</b><br>'
								str += '<span style="color:grey;font-size:0.9em">I want to instantly auto-generate a web form that I provide to my users so that they may enter data that gets saved BACK to the same table.</span>'
								str += '</div>'
								str += '</div>'
								$.dialog({theme:'supervan',content:'<div class="container" style="font-family:Open Sans:300;width:800px;background:#f0f0f0;color:black;height:700px;padding:25px;text-align:left">'+str+'</div>',title:'',columnClass:'col-md-12'})
							}
						})
					}
					function showHelp(hid) {
						alert(hid)
					}
					function setQuery() {
						jc=$.confirm({
							title	:'SQL Query to HTML Report',
							type	:'green',
							theme	:'modern',
							columnClass: 'col-md-6',
							content	: '<form>Enter Query:<br><textarea style="height:200px;width:100%;border:5px solid #f0f0f0;border-radius:4px" id="qry"></textarea></form>',
							buttons	:{
								Back:function(){
									
								},
								ExecQuery:{
									btnClass: 'btn-green',
									text:'Execute Report',
									action:function(){
										location.href='editQuery.php?query='+$('#qry').val()
									}
								}
							}
						})
					}
					function browse(table) {
						setCookie('table',table)
						var url = 'browseTable.php?db_name='+getCookie('db_name')+'&table='+table
						$.ajax({
							url:url,
							success:function(data){
								$$('title').innerHTML='BROWSE ' + table.toUpperCase()
								$$('tc').innerHTML=data+'<div style="width:100%;text-align:center" ><p><button onclick="edit(\'' + table + '\')" class="btn btn-success">Edit </button> <button onclick="getTables(true)" class="btn btn-danger">Back</button> <button onclick="genPHPBrowse(\'' + table +'\')" class="btn btn-danger">View PHP Code</button> </p></div>'
								$$('tc').style.marginTop='-50px'
							}
						})
					}

					function addRow() {
						var table=getCookie('table')
						var url = 'addTableRow.php?db_name='+getCookie('db_name')+'&table='+table
						$.ajax({
							url:url,
							success:function(data){
								edit(table)
							}
						})
					}
					function delTableRow(index,id) {
						var table=getCookie('table')
						var url = 'delTableRow.php?db_name='+getCookie('db_name')+'&table='+table+'&index='+index+'&id='+id
						$.ajax({
							url:url,
							success:function(data){
								edit(table)
							}
						})
					}
					
					function setTable(table) {
						setCookie('table',table)
					}
					
					function edit(table) {
						setCookie('table',table)
						var url = 'SQLEdit.php?db_name='+getCookie('db_name')+'&table='+table
						location.href=url
						//setCookie('table',table)
						// var url = 'showEditCode.php?db_name='+getCookie('db_name')+'&table='+table
						// console.log(url)
						// $.ajax({
							// url:url,
							// success:function(data){
								// $$('title').innerHTML='EDIT ' + table.toUpperCase()
								// $$('tc').innerHTML=data+'<div style="width:100%;text-align:center" ><p><button onclick="addRow()" class="btn btn-success">Add Row</button> <button onclick="genPHPEdit(\'' + table + '\')" class="btn btn-danger">View PHP Code</button> </p></div>'
								// $$('tc').style.marginTop='-150px!Important;'
							// }
						// })
					}
					setTimeout(function(){
						//if (location.href.indexOf('output')==-1) $$('eyes_only').style.display='none'	
					},1)

					var jc
					var cnt='Your php file was generated successfully!. You may go back, preview your creation or build more. <br><br>Please select option below.'
					function genPHPBrowse(table) {
						setCookie('table',table)
						var url = 'createPHPBrowse.php?db_name='+getCookie('db_name')+'&table='+table
						console.log(url);
						$.ajax({
							url		:	url,
							success	:	function(data){
								setTimeout(function(){
								//	if (location.href.indexOf('output')==-1) $('#eyes_only').hide()	
								},1)
								if (data=='php_browse_'+table+'.php') {
									jc=$.confirm({
										title	:'Success',
										type	:'green',
										theme	:'modern',
										content	: cnt,
										buttons	:{
											Preview:function(){
												showPreview('output/php_browse_'+table+'.php', table.toUpperCase() + ' PREVIEW')
											},
											ViewPHPCode:{
												text:'View PHP Code',
												action:function(){
													showPHP('code_preview.php?uri=output/php_browse_'+table+'.php')
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
					
					function genPHPEdit(table) {
						setCookie('table',table)
						var url = 'createPHPEdit.php?db_name='+getCookie('db_name')+'&table='+table
						console.log(url);
						$.ajax({
							url		:	url,
							success	:	function(data){
								if (data=='php_edit_'+table+'.php') {
									jc=$.confirm({
										title	:'Success',
										type	:'green',
										theme	:'modern',
										content	: cnt,
										buttons	:{
											Preview:function(){
												showPreview('output/php_edit_'+table+'.php', table.toUpperCase() + ' PREVIEW')
											},
											ViewPHPCode:{
												text:'View PHP Code',
												action:function(){
													showPHP('code_preview.php?uri=output/php_edit_'+table+'.php')
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
					
					var cnt='Your php file was generated successfully!. You may go back, preview your creation or build more. <br><br>Please select option below.'
					function genPHP(table) {
						setCookie('table',table)
						var url = 'createPHP.php?db_name='+getCookie('db_name')+'&table='+table
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
					
					function queryEDITCode() {
						var url='php_preview.php'
						$.dialog({content: 'url:php_preview.php'})
					}
					
					function setOptions(t) {
						location.href='setFieldOptions.php?table='+t
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

					function update_f(a,b,c,d,e) {
						c.style.cssText=saveCSS
						c.style.paddingLeft='10px'
						var sql='<?=HOST;?>/x_form_update.php?sql=update `' + a + '` set ' + b + '=\"' + c.textContent + '\" where ' + d + '=' + e + '&db_server='+getCookie('db_server')+'&db_name='+getCookie('db_name')+'&db_user='+getCookie('db_user')+'&db_password='+getCookie('db_password')
						console.log(sql)
						$.ajax({
							url: sql,
							success: function(msg){
								c.style.cssText=saveCSS
								c.style.paddingLeft='10px'
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
							console.warn("Could not select text in node: Unsupported browser.");
						}
					}
					var pre
					function php_code(n,uri) {
						pre=$$('pre')
						pre.dataset.src=uri
					}
				</script>