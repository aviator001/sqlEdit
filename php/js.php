		<script>
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
				
				function showPreview(url,title) {
					window.open(url)
				}
				
				function showPHP(url) {
					window.open(url)
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
		</script>
		<script type="text/javascript">
		function valid(table,f,type) {
			var x = '' 
			var r = f + '_err'
			var t = r + '_txt'
			var i = f.value
			if (f == 'mobile') i = number
			r = document.getElementById(r)
			t = document.getElementById(t)
			var e = '<div style="background:gold;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important">Mobile already exists in the database</div>'					
			var url = '<?=HOST;?>/x_validate_field.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password') + '&d=' + f.id + '&i=' + f.value + '&table=' + table
			console.log(url)
			var request = $.ajax({
			url: url,
			type: 'GET',
			dataType:'html',
			cache: false,
			success: function(msg) {
					if (msg*1 > 0) {
						validate = false
						show_error(f,e)
					}
				}
			})	
		}

		function update_field(f,u) {
			var v=f.value
			f=f.id
			if(u)f=u
			if(u)v=getCookie('filenames')
			var url = '<?=HOST;?>/x_update_table.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password') + '&table=' + table + '&field=' + f + '&value=' + v + '&id=' + index + '&index=' + index_value
			var request = $.ajax({
				url: url,
				success: function(msg) {
					console.log(url)	
				
				}
			})			
		}

			var placeSearch, autocomplete;
			var componentForm = {
			  street_number: 'short_name',
			  route: 'long_name',
			  locality: 'long_name',
			  administrative_area_level_1: 'short_name',
			  country: 'long_name',
			  postal_code: 'short_name'
			};

		function initAutoComplete(f) {
			autocomplete = new google.maps.places.Autocomplete(
				(document.getElementById('autocomplete')), {
					types: ['geocode']
				});
				autocomplete.addListener('place_changed', fillInAddress);
			}

		function fillInAddress() {
			var place = autocomplete.getPlace();
			for (var i = 0; i < place.address_components.length; i++) {
				var addressType = place.address_components[i].types[0];
				if (componentForm[addressType]) {
					var val = place.address_components[i][componentForm[addressType]];
					if (document.getElementById(addressType)) document.getElementById(addressType).innerHTML = val;
				}
			}
		}

		function geolocate() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var geolocation = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
					var circle = new google.maps.Circle({
						center: geolocation,
						radius: position.coords.accuracy
					});		
					autocomplete.setBounds(circle.getBounds());
				});
			}
		}
		function fx(url) {
			var localTest = /^(?:file):/,
				xmlhttp = new XMLHttpRequest(),
				status = 0;
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					status = xmlhttp.status;
				}
				if (localTest.test(location.href) && xmlhttp.responseText) {
					status = 200;
				}
				if (xmlhttp.readyState == 4 && status == 200) {
					console.log(xmlhttp.responseText);
				}
			}

			try { 
				xmlhttp.open('GET', url, true);
				xmlhttp.send();
			} catch(err) {
				console.log(err)
			}
		}
	

		setTimeout(function(){
			initAutoComplete('autocomplete')	
		},1000)

		jQuery(document).ready( function($){
			$('.select-1').select2({
				placeholder: 'Select Multiple Values'
			});
			$('.selectsplitter').selectsplitter();
		});
 
		function selRadio(objGroup,objID,g) {
			var elements,i
			var elements = document.getElementsByTagName('*')
			for (i in elements) {
				if (elements[i].hasAttribute && elements[i].hasAttribute('data-group')) {
					if (elements[i].attributes['data-group'].value==objGroup) elements[i].checked=false
				}
			}	
			$$(objID).checked=true
			$$(objGroup).value=g
		}

		function selMultiCheck(r) {
			if (ra.indexOf(r)<0) {
				ra.push(r)
			} else {
				ra.splice(ra.indexOf(r),1)
			}
			reasons=ra.toString()
			console.log(reasons)
		}	

		function saveSite(s) {
			sites=$('.select-1').val().toString()
			console.log(sites)
		}
		function generateRandomString(j){
			if (!j) j=16
			var op=''
			var arr=new Array('a','b','c','d','e','f','i','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z',0,1,2,3,4,5,6,7,8,9,0,0,1,2,3,4,5,6,7,8,9,0)
			for (k=0;k<j;k++) {
				var inx=randomIntFromInterval(0,arr.length-1)
				op += arr[inx]
			}
			return op;
		}
		function guid() {
		  function s4() {
			return Math.floor((1 + Math.random()) * 0x10000)
			  .toString(16)
			  .substring(1);
		  }
		  return s4() + '-' + s4();
		}
		function $$(obj) {
			return document.getElementById(obj)
		}

		function is_valid_login(f) {
			if (f.value=='') {
					validate = false
					var err='<span style="color:orange">Invalid Login Name or member Username!</span>'
					$$('login_err').innerHTML=err
					return false
			}
		}

		function fetch_remote(url) {
			var elements = document.getElementsByTagName('*'),
				i;
			for (i in elements) {
				if (elements[i].hasAttribute && elements[i].hasAttribute('data-remote')) {
					var el=elements[i]
				}
			}
			$.ajax({url:'remote.php?url='+url.replace('https://','').replace('http://',''),success:function(data){
				el.innerHTML=data
			}})
		}

		function fetch_code(url) {
			var elements = document.getElementsByTagName('*'),
				i;
			for (i in elements) {
				if (elements[i].hasAttribute && elements[i].hasAttribute('data-code')) {
					fragment(elements[i], url);
				}
			}
		
		function fragment(el, url) {
				var localTest = /^(?:file):/,
					xmlhttp = new XMLHttpRequest(),
					status = 0;
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						status = xmlhttp.status;
					}
					if (localTest.test(location.href) && xmlhttp.responseText) {
						status = 200;
					}
					if (xmlhttp.readyState == 4 && status == 200) {
						el.innerHTML = '<pre><code>'+xmlhttp.responseText+'</code></pre>';
					}
				}

				try { 
					xmlhttp.open('GET', url, true);
					xmlhttp.send();
				} catch(err) {
					/* todo catch error */
				}
			}
		}
		function mover(obj) {
			obj.style.background='gold'
		}
		function mout(obj) {
			obj.style.background=''
		}
	


</script>
