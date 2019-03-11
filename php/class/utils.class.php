<?
error_reporting(1);
class utils {
	/** 
	 * php extension
	 * @var	string
	 */
	protected $debug;
	protected $result;
	protected $r;
	public $record;
	public $secrets;
	public $logins;
	public $title;
	public $style;
	public $footer;
	public $d;
	public $file_name;
	public $user_file_name;
	public $user_js_files;
	public $user_css_files;
	public $user_php_files;
	public $user_php_code;
	public $user_page_intro;
	public $user_page_css;
	public $user_page_js;
	public $host;
	
	public $table;
	public $field_names;
	public $field_types;
	public $field_icons;
	
	public $field_labels;
	public $field_help;
	public $field_defaults;
	public $field_source;
	public $field_ip_type;
	public $field_validate;
	public $field_status;
	public $field_required;
	public $field_format;
	public $field_pre_fn;
	public $field_curr_fn;
	public $field_post_fn;
	public $field_db_chk;
	public $field_val_regex;
	public $field_placehldr;
	public $field_content;
	
	
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
		$this->app=APP;
		$this->app_full=APP_FULL;
		$this->app_web='https://' . APP_WEB;
		$this->out=OUT;
		$this->out_full=OUT_FULL;
		$this->out_web='https://' . OUT_WEB;
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

	public function shell($cn, $fn){
		$stream = ssh2_exec($cn, $fn);
		stream_set_blocking($stream, true);
		return stream_get_contents($stream);		
	}
	
	public function print_blocks($obj,$width="25px") {
		$obj=str_replace(' ','',$obj);
		$a=array('[',']','(',')','.','-');
		$b=array('','','','','','');
		str_replace($aa,$b,$obj);
		for ($i=0;$i<=strlen($obj)-1;$i++) {
			$str .= "<span><img onerror=\"this.src='http://txt.am/assets/img/space.png'\" src=\"https://gaysugardaddyfinder.com/assets/img/" . substr($obj,$i,1) . ".png\" style=\"width:$width\"></span>";
		}
		return $str;
	}		
	
	public function logs($x) {
		global $secrets;
		$d[]=$x;
		$this->logins=$d;
	}
	public function callerID ($mobile) {
		return file_get_contents("https://api.opencnam.com/v3/phone/$mobile?account_sid=eACce038bffa1ac4e3ca4ed5c78c891cc0e&auth_token=AU1044e512e8ba45ec9772cd35b8c94d93");
	}
	
	public function connect($ipx="199.91.65.82",$user="root",$pswd="Shadow2015!",$dbx="txt") {
			global $db;
			try {
				global $conn;
				$db = new mysqli($ipx, $user, $pswd, $dbx);
				$this->conn = $db;
				return $this->conn = $db;
			} catch (Exception $e) {
				return "Unable to connect";
				exit;
			}
	}


		public function close() {
		try {
			$this->conn->close();
			return "Closed";
		} catch (Exception $e) {
			return "Unable to Close";
			exit;
		}
	}

	protected function _ip() {
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
		return $ip;
	}

	public function getPort() {
		setCookie("port", WS_PORT, time()+3600*10, "/");
		return WS_PORT;
	}
	
	public function getIP() {
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		$result  = "Unknown";
		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
		return $ip;
	}

	public function DBList() {
		$dbl=$this->query("SHOW DATABASES");
		for ($i=0;$i<count($dbl);$i++) {
			$s[] = "<a href='?db=" . $dbl[$i]['Database'] . "'><div class='www_box2 cell' onmouseover='this.className=\"www_box5 cell\"' onmouseout='this.className=\"www_box cell\"'>" . strtoupper($dbl[$i]['Database']) . "</div></a>";
			$d[]=$dbl[$i]['Database'];
		}
		return json_encode($d);
	}
	public function tableList($xx) {
		$tx=$this->query("SHOW TABLES FROM $xx");
		 for ($i=0;$i<count($tx);$i++) {
			$t[]=$tx[$i]["Tables_in_$xx"];
		 }
		return json_encode($t);
	}
	
	public function getAllFields($xx,$tb) {
		$fields=$this->query("show FIELDS from ". $xx . "." . $tb);
		for ($i=0;$i<count($fields);$i++) {
			$fn=$fields[$i]['Field'];
			$strFields .= $fn . ",";
		}
		return substr($strFields,0,strlen($strFields)-1);
	}
	
	public function fieldList($xx,$tb) {
		$fields=$this->query("show FIELDS from ". $xx . "." . $tb);
			$s1 .= "<span><select type='select' id='sel_$fn'>";
			$s1 .= "<option value='' id=''></option>";
			$s1 .= "<option value='is_equal_to'>=</option>";
			$s1 .= "<option value='lesser_than'>&lt;</option>";
			$s1 .= "<option value='greater_than'>&gt;</option>";
			$s1 .= "<option value='not_equal'>&lt;&gt;</option>";
			$s1 .= "<option value='like'>LIKE</option>";
			$s1 .= "<option value='in'>IN</option>";
			$s1 .= "</select>";
			$fop="<button  data-toggle='dropdown' class='btn btn-xs btn-default dropdown-toggle' type='button' style='color:#333' aria-expanded='false'>Select</button>";
		$fop .= "<ul role='menu' class='dropdown-menu show' x-placement='bottom-start' style='position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;'>";
		for ($i=0;$i<count($fields);$i++) {
			$fn=$fields[$i]['Field'];
			$fop .= "<li>" . strtoupper($fn) . "</li>";
		}
		$fop .="</ul>";
		$s .= "<tr><td>$fop</td><td>$s1</td><td><input type=text></td></tr>";
		$s .= "</table>";
		return $s;
	}
	
	public function buildQuery() {
		if ($_COOKIE[qry]) $sel = " WHERE " . $_COOKIE['qry'];
			else $sel = "";
		return $qry = "SELECT " . substr($_COOKIE[field],0,strlen($_COOKIE[field])-1) . " FROM `" . $_COOKIE[db] . "`.`" . $_COOKIE[table] . "`" . $sel . " LIMIT 100";
	}
	
	public function setFieldTypeDefaults($fieldNames) {
		$fieldNames=explode(",",$fieldNames);
		for ($i=0;$i<count($fieldNames); $i++) {
			$fn=$fieldNames[$i];
				 if ((strstr($fieldNames[$i], "tel")) || (strstr($fieldNames[$i], "phone")) || (strstr($fieldNames[$i], "fax")) || (strstr($fieldNames[$i], "cell")) || (strstr($fieldNames[$i], "mobile"))){ 
					$fieldTypes[] = 'tel'; 
					$fieldIcons[] =  'fa fa-mobile-alt'; 
					}
				else if ((strstr($fieldNames[$i], "email")) || (strstr($fieldNames[$i], "mail"))){ 
					$fieldTypes[] = 'email'; 
					$fieldIcons[] =  'fa fa-envelope'; 
					}
				else if ((strstr($fieldNames[$i], "age")) || (strstr($fieldNames[$i], "age"))){ 
					$fieldTypes[] = 'age'; 
					$fieldIcons[] =  'fa fa-calendar'; 
					}
				else if ((strstr($fieldNames[$i], "id")) || (strstr($fieldNames[$i], "length")) || (strstr($fieldNames[$i], "width")) || (strstr($fieldNames[$i], "breadth")) || (strstr($fieldNames[$i], "height")) || (strstr($fieldNames[$i], "number")) || (strstr($fieldNames[$i], "unit")) || (strstr($fieldNames[$i], "weight")) || (strstr($fieldNames[$i], "unit")) || (strstr($fieldNames[$i], "mass"))){ 
					$fieldTypes[] = 'number'; 
					$fieldIcons[] =  'fas fa-list-ol'; 
					}
				else if ((strstr($fieldNames[$i], "sale")) || (strstr($fieldNames[$i], "price")) || (strstr($fieldNames[$i], "amt")) || (strstr($fieldNames[$i], "amount")) || (strstr($fieldNames[$i], "tax")) || (strstr($fieldNames[$i], "price")) || (strstr($fieldNames[$i], "cost"))){ 
					$fieldTypes[] = 'currency'; 
					$fieldIcons[] =  'far fa-money-bill-alt'; 
					}
				else if ((strstr($fieldNames[$i], "date")) || (strstr($fieldNames[$i], "when"))){ 
					$fieldTypes[] = 'date'; 
					$fieldIcons[] =  'i-rounded i-light icon-calendar'; 
					}
				else if ((strstr($fieldNames[$i], "time"))){ 
					$fieldTypes[] = 'time'; 
					$fieldIcons[] =  'far fa-clock'; 
					}
				else if ((strstr($fieldNames[$i], "pswd")) || (strstr($fieldNames[$i], "price")) || (strstr($fieldNames[$i], "pass")) || (strstr($fieldNames[$i], "password")) || (strstr($fieldNames[$i], "secret")) || (strstr($fieldNames[$i], "code"))){ 
					$fieldTypes[] = 'password'; 
					$fieldIcons[] =  'fa fa-lock'; 
					}
				else if ((strstr($fieldNames[$i], "upload"))||(strstr($fieldNames[$i], "photo"))||(strstr($fieldNames[$i], "pic"))){ 
					$fieldTypes[] = 'upload'; 
					$fieldIcons[] =  'fa fa-photo'; 
					}
				else if ((strstr($fieldNames[$i], "location")) || (strstr($fieldNames[$i], "address")) || (strstr($fieldNames[$i], "location")) || (strstr($fieldNames[$i], "street")) || (strstr($fieldNames[$i], "city")) || (strstr($fieldNames[$i], "zip"))){ 
					$fieldTypes[] = 'auto_location'; 
					$fieldIcons[] =  'fa fa-location-arrow'; 
					}
				else if ((strstr($fieldNames[$i], "state")) || (strstr($fieldNames[$i], "reigon"))){ 
					$fieldTypes[] =  'auto_state'; 
					$fieldIcons[] =  'fa fa-location-arrow'; 
					}
				else if ((strstr($fieldNames[$i], "city"))){ 
					$fieldTypes[] =  'auto_city'; 
					$fieldIcons[] =  'fa fa-location-arrow'; 
					}
				else if ((strstr($fieldNames[$i], "zip")) || (strstr($fieldNames[$i], "postal"))){ 
					$fieldTypes[] =  'auto_zip'; 
					$fieldIcons[] =  'fa fa-location-arrow'; 
					}
				else if ((strstr($fieldNames[$i], "ebay"))){ 
					$fieldTypes[] =  'auto_ebay'; 
					$fieldIcons[] =  '<img src="images/ebay.png" style="width:50px">'; 
					}
				else if ((strstr($fieldNames[$i], "google"))||(strstr($fieldNames[$i], "term"))||(strstr($fieldNames[$i], "q"))){ 
					$fieldTypes[] =  'auto_google'; 
					$fieldIcons[] =  'fa icon-google-plus-sign'; 
					}
				else if ((strstr($fieldNames[$i], "image_search"))){ 
					$fieldTypes[] =  'auto_image'; 
					$fieldIcons[] =  'fa fa-icon-picture'; 
					}
				else if ((strstr($fieldNames[$i], "yp"))){ 
					$fieldTypes[] =  'auto_yp'; 
					$fieldIcons[] =  ''; 
					}
				else if ((strstr($fieldNames[$i], "resturant"))||(strstr($fieldNames[$i], "menu"))){ 
					$fieldTypes[] =  'auto_food_menu'; 
					$fieldIcons[] =  'fa fa-icon-food';  
				} else {
					$fieldTypes[] =  'text'; 
					$fieldIcons[] =  'far fa-edit'; 
				}
			}
		return array($fieldTypes,$fieldIcons);
	}
	
	public function showFieldOptions($db,$query) {
		$field_types = '<div class="btn-group">
            <button onclick="stypes()" data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button" aria-expanded="false">Default</button>
          </div>';

	  $first=true;
		$table  = '<style>';
		$table .= '.table_custom{margin:auto;left:0;right:0;margin:auto;color:#333; background:#fff; font-size:0.8em!Important;text-shadow:1px 1px 1px #fff} .table_header{color:#fff;background:#000;text-shadow:none} .table_row{background:aliceblue; color:#333; text-shadow:2px 2px 0px #fff} .table_row_alt{color:#000;background:#f0f0f0}';
		$table .= '</style>';
		$x=0; $first_row = true;
		$header = "<div class='container' style='background:white!Important;max-width:1200px;margin-top:100px;padding:10px'>";	
		$f = $this->_sql_arr($query);
		$table .= $header;
		$cols=$this->getFields($db,$query);
		$table .= "<div class='row'>";
		$table .= "<div class='col-md-2 style='margin-left:5px;text-align:center;background:whitesmoke!Important'>NAME</div>";
		$table .= "<div class='col-md-2 style='text-align:right;background:lavenderblush!Important'>LABEL</div>";
		$table .= "<div class='col-md-2 style='text-align:right;background:lavenderblush!Important'>DEFAULT VALUE</div>";
		$table .= "<div class='col-md-1 style='text-align:right;background:lavenderblush!Important'>SHOW?</div>";
		$table .= "<div class='col-md-1 style='text-align:right;background:papayawip!Important'>TYPE</div>";
		$table .= "<div class='col-md-1 style='text-align:right;background:papayawip!Important'>RULES</div>";
		$table .= "<div class='col-md-1 style='text-align:right;background:lavenderblush!Important'>PLACEHOLDER</div>";
		$table .= "</div>";
		for($c=0; $c < count($cols); $c++){
			$class = ($x==0) ? 'table_row' : 'table_row_alt';
			$x = ($x == 1) ? 0 : 1;
			$colCnt=0;
			$ctr=0;
			$first=false;
			if ($c>0) {
				$table .= "<div class='row $class' style='margin:0!Important;height:40px!Important' id='th' onmouseover=\"mover(this)\" onmouseout=\"mout(this)\">";
				$table .= "<div class='col-md-2' style='margin:5PX!Important'style=''><span>" . $cols[$c]['COLUMN_NAME'] . "</span></div>";
				$table .= "<div class='col-md-2' style='margin:0!Important;margin-right:5px!Important'><input style='border-radius:4px;border:0px solid silver;margin-top:5px;padding:2px' id='txt_$c' onblur='setLabels(this)' type='text' class='form-group'></div>";
				$table .= "<div class='col-md-2' style='margin:0!Important'><input style='border-radius:4px;border:0px solid silver;margin-top:5px;padding:2px' id='txt_val_$c' onblur='setDefaults(this)' type='text' class='form-group'></div>";
				$table .= "<div class='col-md-1' style='margin:0!Important;margin-left:5px!Important'><label class='checkbox' for='checkbox$c'><input onclick='sh($c)' type='checkbox' checked='checked' value='' id='checkbox$c' data-toggle='checkbox' class='custom-checkbox'><span class='icons'><span class='icon-unchecked'></span><span class='icon-checked'></span></span><span id ='sh_$c'>Show</span></label></div>";
				$table .= "<div class='col-md-1 style='background:gainsboro!Important'><button id='btn_$c' onclick='stypes($c)' data-toggle='dropdown' class='btn btn-xs btn-default dropdown-toggle' type='button' style='color:#333' aria-expanded='false'>Set</button></div>";
				$table .= "<div class='col-md-1 style='background:gainsboro!Important'><button id='rules_$c' onclick='setRules($c)' data-toggle='dropdown' class='btn btn-xs btn-default dropdown-toggle' type='button' style='color:#333' aria-expanded='false'>Hide If</button></div>";
				$table .= "<div class='col-md-1' style='margin:0!Important'><input style='border-radius:4px;border:0px solid silver;margin-top:5px;padding:2px' id='txt_plc_$c' onblur='setPlaceholders(this)' type='text' class='form-group'></div>";
				$table .= "</div>";
			}
		}
		return $table;
	}
	
	public function printForm() {
		$fn=$this->user_file_name;
		$table=$this->table;
		$field_names=$this->field_names;
		$fieldTypes=$this->field_types;
		$fieldIcons=$this->field_icons;
		$fieldSelect=$this->field_select;
		$fieldCheck=$this->field_check;
		$fieldRadio=$this->field_radio;
		$fieldRules=$this->field_rules;
		$fieldHide=$this->field_hide;
	 	$fieldLbls=$this->field_labels;
		$fieldDefs=$this->field_defaults;
		$fieldPlaces=$this->field_placeholders;
		$fieldLabels=explode(",",$fieldLbls);
		$fieldPlcs=explode(",",$fieldPlcs);
		if (isset($field_names)) {
			$fieldNames=$this->getArray($field_names);
		}
		$title=$this->title;
		$html  ='<script type="text/javascript" src="' . HOST . '/js/jquery.js"></script>';
		$html .='<script type="text/javascript" src="' . HOST . '/jquery-ui.js"></script>';

		$html .= PHP_EOL . "\t\t\t" . '<section id="content" style="text-align:center;background:#fff;padding:0;max-width:600px;margin:auto;padding:25px;margin-top:200px;border-radius:6px;box-shadow:0 0 25px rgba(0,0,0,0.1)">
					<h4>'  . $title . '</h4>
					<div class="container" style="padding:0;max-width:500px;margin:auto">';
		$bg=array("peachpuff","whitesmoke","aliceblue","papayawhip","lavenderblush","gainsboro","lightcyan");
		$scr="function initF() {";
		for ($i=0;$i<count($fieldNames);$i++) {
			$pt=rand(0,count($bg)-1);
			$bgc=$bg[$pt];
			$fieldName=$fieldNames[$i];
			$fieldType=$fieldTypes[$i];
			$fieldIcon=$fieldIcons[$i];
			$fieldSel=$fieldSelect[$i];
			$fieldLabel=$fieldLabels[$i];
			$fieldDefault=$fieldDefs[$i];
			$fieldPlace=$fieldPlaces[$i];
			$fieldSel=explode("|",$fieldSel);
			$fieldChk=$fieldCheck[$i];
			$fieldChk=explode("|",$fieldChk);
			$fieldRad=$fieldRadio[$i];
			$fieldRad=explode("|",$fieldRad);
			$fieldRule=$fieldRules[$i];
			$flr=explode("|",$fieldRule);
			if ($flr[2]) {
				$ds=($flr[1]=='Hide If')?'none':'block';
				$scr .= "if (document.getElementById('" . $flr[2] . "').value" . $flr[3] . $flr[4] . ") document.getElementById('env_" . $flr[0] . "').style.display='$ds';";
			}
			$fieldHidden=$fieldHide[$i];
			if ($fieldHidden=='1') $display="none";
				else $display="block";
			
			$arr1=array('_','-');
			$arr2=array(' ',' ');
			$types .= $fieldType . ',';
			$this->types=$types;
			if ($fieldLabel=="") $fieldLabel=strtoupper(str_replace($arr1,$arr2,$fieldName));
			$label=$fieldLabel;
			$html .= PHP_EOL . "\t\t\t\t\t" . "<div class='row' style='margin-top:20px;margin-bottom:20px'>
						<div class='col-md-12' style='text-align:left'>";
			if ($i==0) {
				$html 		.=	"<div>";
				$html 		.=	"	<label>" . $this->index . "</label>";
				$html 		.=	"	<span>" . $this->index_value . "</span>";
				$html		.=	"</div>";
				$str = HOST . "/x_save_row.php?";
			} else {
				$str .="$fieldName=' + $$('$fieldName').value + '&";
				if ($fieldType=="upload") {
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='login-form'> $fieldName [PHOTO UPLOADER]</label>
								<form onclick='upload_photo(\"$fieldName\")' action='upload.php' style='border:3px dashed gainsboro!Important;width:100%' class='dropzone dz-preview' id='member'></form>
								<div style='border:none;inset 1px 1px 10px rgba(0,0,0,0.8);width:250px;height:40px;display:none;' id='pbar_holder'>
									<div id='pbar' class='www_box3' style='width:0;height:40px;background:url(http://sugardaddyscore.com/images/led_bar3.png);background-size:cover'></div>
									<div id='pc' style='width:75px;position:absolute;margin-top:-37px;margin-left:260px'></div>										
									<input type='hidden' id='upload'><input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
				} else if ($fieldType=="ac_ebay"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								
								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldName}' class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' >
								</div>";
					$html 	.="<script>
								$('#" . $fieldName . "').autocomplete({
									source: '../x_ebay_api.php',
									minLength: 2,
									select: function(e, ui){
										var tt=''
										tt=ui.item.label
										$('#item').text(ui.item.label.substring(0,10))
									}
								})
								.data( 'ui-autocomplete')._renderItem = function( ul, item ) {
									 var pic_path = '<img src=\"' + item.image + '\" style=\"width:100%;padding:0px\">';
										return $( '<li>' )
										.data( 'item.autocomplete', item )
										.append( '<table style=\"margin:0;padding:0;font-size:0.7em;width:500px;max-width:500px\"><tr><td style=\"width:50px;height:50px\">'+pic_path+'</td><td>'+item.label+'</td></tr></table>')
										.appendTo( ul );
								}
								</script>";
				} else if ($fieldType=="ac_instagram"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' onblur='getInstagram(this)' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}'  name='{$fieldName}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>
								<div id='$fieldName". "_" ."results'></div>";
				} else if ($fieldType=="ac_bb"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' onblur='getBestBuy(this)' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType'  id='{$fieldName}'  name='{$fieldName}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>
								<div id='$fieldName". "_" ."results'></div>";
				} else if ($fieldType=="ac_states"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldName}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_states.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_countries"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}'  name='{$fieldName}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
								$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_countries.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_cities"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}'  name='{$fieldName}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_cities.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_zip"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}'  name='{$fieldName}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_zip.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_custom"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldType}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_custom.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_cars"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldType}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_cars.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_food"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldType}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_food.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_rest"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldType}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_resturants.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_rx"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldType}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_rx.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="ac_symptoms"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' placeholder='$fieldPlace' value='$fieldDefault' type='$fieldType' id='{$fieldName}' name='{$fieldType}'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
					$html 	.="	<script>
									$('#" . $fieldName . "').autocomplete({
										source: '../x_ac_symptoms.php',
										minLength: 0,
										select: function(e, ui){
											$('#" . $fieldName . "').val(ui.item.value);
										}
									}); 
								</script>";
				} else if ($fieldType=="image"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onblur=\"getImages(this)\" placeholder='$fieldPlace' value='$fieldDefault' type='text' id='$fieldName'  name='$fieldName'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>
								<div id='$fieldName". "_" ."results'></div>";
				} else if ($fieldType=="soundcloud"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onblur=\"embedSoundCloud(this)\" placeholder='$fieldPlace' value='$fieldDefault' type='text' id='$fieldName'  name='$fieldName'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>
								<iframe id='{$fieldName}_results' width='100%' height='166' scrolling='no' frameborder='no' src=''></iframe>";
				} else if ($fieldType=="remote"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input onblur=\"getRemote(this.value)\" placeholder='$fieldPlace' value='$fieldDefault' type='text' id='$fieldName'  name='$fieldName'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>
								<div style='max-width:100%!Important' data-remote-form id='$fieldName". "_" ."results'></div>";
				} else if ($fieldType=="tags"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<input name='tagsinput' class='tagsinput' data-role='tagsinput'  style='display: none;'>
								</div>";
				} else if ($fieldType=="textarea"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>";
					$html 	.="	<textarea style='width:100%' id='$fieldName'></textarea>";
					$html 	.="	</div>";
				} else if ($fieldType=="html"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>";
					$html 	.="	<textarea id='$fieldName'></textarea>";
					$html 	.="	<script>setTimeout(function(){tinymce.init({ selector:'#$fieldName' })},2000);</script>";
					$html 	.="	</div>";
				} else if ($fieldType=="auto_location"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<span style='background:$bgc' class='input-group-addon'><i class='$fieldIcon'></i></span>
									<input  onFocus='geolocate()' placeholder='Start typing your address' type='$fieldType' id='autocomplete'  name='autocomplete'  class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input onclick='clean_error(this,\"$fieldIcon\",\"$bgc\" id='autocomplete_original' type='hidden' value=''>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
								$auto_location_field_ids[]='autolocation';
				} else if ($fieldType=="select"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<div class='btn-group'>
										<select id='$fieldName' data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>
										<option>Select value for $fieldName </option>";
										for ($r=0;$r<count($fieldSel);$r++) {
					$html 	.="			  <option value='". $fieldSel[$r] ."'>". $fieldSel[$r] ."</option>";
										}
					$html 	.="		  </select></div></div>";
				} else if ($fieldType=="check"){
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>								<div class='input-group'>
									<div class='btn-group'>";
										for ($r=0;$r<count($fieldChk);$r++) {
					$html 	.="			<div style='margin:0!Important;margin-left:5px!Important'><label class='checkbox' for='checkbox$c'><input onclick='sh($c)' type='checkbox' checked='checked'  id='checkbox$c' data-toggle='checkbox' class='custom-checkbox'><span class='icons'><span class='icon-unchecked'></span><span class='icon-checked'></span></span><span id ='sh_$c'>" . $fieldChk[$r] . "</span></label></div>";  
										}
					$html 	.="		  </div></div>";
				} else if ($fieldType=="radio"){
					//echo $i;
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . strtoupper(str_replace($arr1,$arr2,$fieldName)) . "</b></label>
								<div class='input-group'>
									<div class='btn-group'>";
										for ($r=0;$r<count($fieldRad);$r++) {
					$html 	.="				<div onclick='self()'>";
					$html 	.="					<label class='radio'><input type='radio' name='optionsRadios' id='optionsRadios1' value='option1' data-toggle='radio' class='custom-radio'><span class='icons'><span class='icon-unchecked'></span><span class='icon-checked'></span></span>";
					$html 	.="						" . $fieldRad[$r];
					$html 	.="					</label>";
					$html 	.="				</div>";
										}
					$html 	.="		  </div></div>";
				} else {
					$html 	.="	<span id='env_$fieldName' style='display:$display'><label for='' style='font-weight:300;font-size:14px'><b>" . $label . "</b></label>
								<div class='input-group'>
									<span id='{$fieldName}_span' style='background:$bgc' class='input-group-addon'><i id='{$fieldName}_icon' class='$fieldIcon'></i></span>
									<input placeholder='$fieldPlace' value='$fieldDefault' onclick='clean_error(this,\"$fieldIcon\",\"$bgc\")' onblur='exists(\"$table\", this,\"$fieldType\")' type='$fieldType' id='{$fieldName}'  name='{$fieldName}' class='form-control large-font'style='height:50px;border-radius:2px; border:1px solid skyblue'>
									<input id='{$fieldName}_original' type='hidden' value='$fieldDefault'>
								</div>";
				}
			}
			$display="block";
					$html .= PHP_EOL . "\t\t\t\t\t\t\t" . "<div id='{$fieldName}_err_txt'></div>
						</div>
					</div></span>";
		}
		$html .= "</div><button id='_button' onclick='saveRow()' class='btn btn-lg btn-info'>SAVE ROW</button>" . PHP_EOL;
		$this->str=$str;
		$scr .= "}";
		$html .= "<script>$scr" . PHP_EOL . "setTimeout(function(){initF()},2000);</script>";
		return $html;
	}
	private function header_close() {
		return PHP_EOL . "\t" . "</head>";
	}

	private function title_close() {
		return "</title>";
	}

	private function html_open() {
		return '<!DOCTYPE html>' . PHP_EOL . '<html lang="en">';
	}

	private function header_open() {
		return PHP_EOL . "\t" . "<head>";
	}

	private function page_title() {
		return PHP_EOL . "\t\t" . "<title>" . PHP_EOL . "\t\t\t" . $this->title . PHP_EOL . "\t\t" . "</title>";
	}

	private function meta() {
		return 
		PHP_EOL . "\t\t" . '<meta charset="utf-8" />' . PHP_EOL . "\t\t" . '<meta name="viewport" content="width=device-width, initial-scale=1" />';
	}
	
	private function css_files() {
		return '
		<link rel="stylesheet" href="' . HOST . '/css/line-icons/line-icons.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="' . HOST . '/css/components/bs-switches.css" type="text/css" />
		<link rel="stylesheet" href="' . HOST . '/css/components/radio-checkbox.css" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="' . HOST . '/css/components/select-boxes.css" type="text/css" />
		<link rel="stylesheet" href="' . HOST . '/css/basic.min.css" type="text/css" />
		<link rel="stylesheet" href="' . HOST . '/css/dropzone.min.css" type="text/css" />
		<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
		<link href="https://code.jquery.com/ui/1.11.4/themes/ui-darkness/jquery-ui.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
		<link rel="stylesheet" href="' . HOST . '/css/flat-ui.css" rel="stylesheet">
		<link rel="stylesheet" href="' . HOST . '/jquery-ui.css" rel="stylesheet">';
	}

	private function body_open() {
		return "\t" . '<body class="stretched" style="background:#f0f0f0">';
	}

	private function body_close() {
		return '</body>';
	}
		
	private function html_close() {
		return "</html>";
	}

	private function page_footer() {
		return "\t\t" . "<footer>". PHP_EOL ."<div>". "\t\t\t" . $this->footer . "</div>". PHP_EOL . "\t\t" . "</footer>";
	}
	
	private function css_inline() {
		return 
		"<style>
			html, body, div, span, table, td {
				font-family:Open Sans;
			}
			table { font-size:15px!Important;}
			td {
				padding:10px;font-size:12px!Important;
			}
			.cell {
				padding:10px;
				margin: 5px;
				width:100%;
			}
			.block {
				margin:10px;
				position:absolute;
				width:370px;
				left:0;
				right:0;
				margin:auto;
			}
			.wbig {
				max-width:500px;
				margin:auto;
				background:#fff;
			}" . $this->style. PHP_EOL . "\t\t" . "</style>";
	}

	private function js_files() {
		return '
				<script src="js/media_queries.js"></script>
				<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
				<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
				<script type="text/javascript" src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
				<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
				<script type="text/javascript" src="' . HOST . '/js/components/select-boxes.js"></script>
				<script type="text/javascript" src="' . HOST . '/js/components/selectsplitter.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIxTN5OqtSK5oPfAXVuj5fqXrKoyF7kSc&libraries=places" async defer type="text/javascript"></script>
				<script type="text/javascript" src="https://gaysugardaddyfinder.com/assets/js/jquery.geocomplete.js"></script>
				<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>			
				<script src="https://unpkg.com/popper.js@1.14.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
				<script type="text/javascript" src="' . HOST . '/scripts/flat-ui.js"></script>
				<script type="text/javascript" src="' . HOST . '/js/popper.js"></script>
	';
		}
		
	private function js_inline() {
		$js = "
		<script>
			var table='". $this->table ."'
			var index='". $this->index ."'
			var index_value='". $this->index_value ."'
			var types='". $this->types ."'
			var v=[],e
			var qparts=0;
			var qry=''
			var af=[ ];
			var fl=[ ];
			var sites
			var imagesUploaded
			var reasons
			var  rating
			var r,k,c,t2,t3,t4,intr=50,currImg
			var rat=1
			var rx=0, t, ext
			var set=false
			var usr_img=[]
			var ra=[]
			var sa=[]
			var ra=[]
			Dropzone.autoDiscover=false

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
			
			function show_error(f,i) {
				if ($$(f.id + '_icon')) setCookie('cur_cn', $$(f.id + '_icon').className)
				if ($$(f.id + '_span')) setCookie('cur_bg', $$(f.id + '_span').style.background)
				if ($$(f.id + '_span')) $$(f.id + '_span').style.background='red'
				if ($$(f.id + '_span')) $$(f.id + '_span').style.color='white'
				if ($$(f.id + '_icon')) $$(f.id + '_icon').className='fa fa-exclamation'
				var r = f.id + '_err'
				var e = '<i class=\"fa fa-bomb\"></i> No Blanks!'
				var t = r + '_txt'
				if(!i) i = 'Invalid Entry! Please re-enter'
				x_validate = false
				r = document.getElementById(r)
				if (t) t = document.getElementById(t)
				f.style.background = 'lavenderblush'
				if (t) t.style.color='silver'
				var obj = f.id
				if (t) t.innerHTML = i
				if (t) t.innerHTML += '<br>'
				validate = false
				return false
			}
			var err_state=false
			
			function clean_error(a,b,c) {
				$$(a.id + '_span').style.background=c
				$$(a.id + '_span').style.color='black'
				$$(a.id + '_icon').className=b
				$$(a.id + '_err_txt').innerHTML=''
				$$(a.id).style.background='#fff'
			}
			function clear_error(f) {
				x_validate=true
				validate = true
				var r = f.id + '_err'
				var t = r + '_txt'
				var p = f.value
				f.style.background = '#fff'
				f.style.color='grey'
				t = document.getElementById(t)
				t.innerHTML = ''
				if (document.getElementById('form_errors')) document.getElementById('form_errors').style.display='none'
			}

			function is_valid_mobile(f) {
				var ph=f.value
				if (ph.length==11) {
					if (ph.substr(0,1) != '1') {
						validate = false
						return false				
					} else {
						ph=ph.substr(1,11)
					}
				}
				var m = /^(\W|^)[(]{0,1}\d{3}[)]{0,1}[.]{0,1}[\s-]{0,1}\d{3}[\s-]{0,1}[\s.]{0,1}\d{4}(\W|$)/
				if(!m.test(ph)) {
					validate = false
					return false
				} else {
					validate=true
					return true
				}
			}

			function is_valid_age(f) {
				var number = f.value*1
				if (!isNaN(number) && (number>=1) && (number<=100)) {
					return true 
				} else {
					validate = false
					return false
				}
			}

			function is_valid_currency(f) {
				var obj = f.value
				var c=!jQuery.isArray( obj ) && (obj - parseFloat( obj ) + 1) >= 0;
				if((!c) || (c==false)) {
						validate = false
						show_error(f,'Invalid $ Amount!')
						return false
					} else {
						return true
					}
			}

			function is_valid_password(f) {
				var pswd = f.value
				if(pswd.trim().length) {
						return true
					} else 	{
						validate = false
						show_error(f,'Invalid Password!')
						return false
					}
			}
			
			function is_valid_email(f) {";
	$js .=	'var email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;';
	$js .=	"if(email.test(f.value)) 
				{
					return true
				} else {
					validate = false
					show_error(f,'Invalid Email! Please re-enter')
					return false
				}
			}

			function is_valid_number(n) {
			  return !isNaN(n)
			}
			
		var validate

		function exists(table,f,type) {
			setTimeout(function(){initF()},10)
			valid(table,f,type)
			if (document.getElementById(f.id + '_original')) {
				if (document.getElementById(f.id + '_original').value == f.value) return false
			}
			if (type=='age') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				} else {
					if (is_valid_age(f)===false){
						var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">' + f.value + ' is invalid. Numbers only please, between 1 and 100</div>'
						show_error(f,e)
						return false
					}
				}
			} else if (type=='number') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				} else {
					if (isNaN(f.value)){
						var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">' + f.value + ' is invalid. Numbers only please</div>'
						show_error(f,e)
						return false
					}
				}
			} else if (type=='currency') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				} else {
					if (is_valid_currency(f)===false){
						var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">' + f.value + ' is invalid. Numbers only please</div>'
						show_error(f,e)
						return false
					}
				}
			} else if (type=='password') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				} else {
					if (is_valid_password(f)===false){
						var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">' + f.value + ' is invalid. Please enter a valid password</div>'
						show_error(f,e)
						return false
					}
				}
			} else if (type=='email') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				} else {
					if (is_valid_email(f)===false){
						var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">Invalid Entry! Please enter a valid email</div>'					
						show_error(f,e)
						return false
					}
				}
			} else if (type=='tel') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				} else {
					if (is_valid_mobile(f)===false){
						var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">Invalid Entry! Format:<br>1(123) 456-7890 or XXXYYYZZZZ or 1234567890</div>'					
						show_error(f,e)
						return false
					}
				}
			} else if (type=='username') {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false
				}
				if (is_valid_login(f)===false){
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">Invalid Mobile! Format:<br>1(123) 456-7890 or XXXYYYZZZZ or 1234567890</div>'					
					show_error(f,e)
					return false
				}
			} else {
				if (f.value=='') {
					var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
					show_error(f,e)
					return false 
				}
			}
			return true
		}
		var elements
		function saveRow(){
			var e = '<div style=\"background:#f0f0f0;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">No Blank Values Allowed</div>'					
			var url='$this->str'
			url=url.substr(0,url.length-1)
			elements=$('#wrapper :input');
			for (var j=0;j<elements.length; j++) {
				if ((elements[j].id.indexOf('button')<0) && (elements[j].id.indexOf('original')<0) && (elements[j].id.indexOf('err')<0)){
					var f=elements[j]
					if (f.value=='') {
						show_error(f,e)
					}
					validate=exists('$this->table',f,types[j+1])
			 	}
			}
			if(validate) $.ajax({url:url,success:function(data){if (!data) $.alert('Row Added!')}})
		}
		
		function valid(table,f,type) {
			var x = '' 
			var r = f + '_err'
			var t = r + '_txt'
			var i = f.value
			if (f == 'mobile') i = number
			r = document.getElementById(r)
			t = document.getElementById(t)
			var e = '<div style=\"background:gold;color:#000;text-shadow:0px 0px 1px #fff;font-size:12px!Important\">Value already exists in the database</div>'					
			var url = '" . HOST . "/x_validate_field.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password') + '&d=' + f.id + '&i=' + f.value + '&table=' + table
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
			var url = '" . HOST . "/x_update_table.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password') + '&table=' + table + '&field=' + f + '&value=' + v + '&id=' + index + '&index=' + index_value
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
	
		
		function getImages(q,c) {
			var id=q.id
			$.ajax({
				url: '../x_get_images.php?q='+q.value,
				success: function(msg){
					$('#'+id+'_results').html(msg)
				}
			})
		}
		
		function getInstagram(obj) {
			var id=obj.id
			$.ajax({
				url: '../x_get_instagram.php?q='+obj.value,
				success: function(msg){
					$('#'+id+'_results').html(msg)
				}
			})
		}
		
		function getBestBuy(term) {
			var id=q.id
			$.ajax({
				url: '../x_get_best_buy.php?q='+q.value,
				success: function(msg){
					$('#'+id+'_results').html(msg)
				}
			})
		}
		
		function update_f(a,b,c,d,e) {
			c.style.cssText=saveCSS
			c.style.paddingLeft='10px'
			var sql='" . HOST . "/x_form_update.php?server='+getCookie('db_server')+'&dbx='+getCookie('db_name')+'&user='+getCookie('db_user')+'&pswd='+getCookie('db_password') + '&sql=update `' + getCookie('db')+'`.`'+getCookie('table') + '` set ' + b + '=\'' + c.textContent + '\' where ' + d + '=' + e;
			console.log(sql)
			$.ajax({
				url: sql,
				success: function(msg){
					c.style.cssText=saveCSS
					c.style.paddingLeft='10px'
				}
			})
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
					var err='<span style=\"color:orange\">Invalid Login Name or member Username!</span>'
					$$('login_err').innerHTML=err
					return false
			}
		}

		function embedSoundCloud(obj) {
			var url=obj.value
			var fid=obj.id + '_results'
			var src='https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'+obj.value+'&amp;color=0066cc'
			$$(fid).src=src
		}

		function getRemote(url) {
			var elements = document.getElementsByTagName('*'),
				i;
			for (i in elements) {
				if (elements[i].hasAttribute && elements[i].hasAttribute('data-remote-form')) {
					var el=elements[i]
				}
			}
			$.ajax({url:'../x_get_remote.php?url='+url.replace('https://','').replace('http://',''),success:function(data){
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
		// $('#category').autocomplete({
			// source: '../x_cat.php',
			// minLength: 0,
    	    // select: function(e, ui){
				// $('#category').val(ui.item.value);
				// setCookie('cat',ui.item.value);
			// }
		// });                
               

		// $('#sub').autocomplete({
			// source: '../x_sub.php',
			// minLength: 0,
    	    // select: function(e, ui){
				// $('#sub').val(ui.item.value);
				// setCookie('sub',ui.item.value);
			// }
		// });  
		
		// $('#ter').autocomplete({
			// source: '../x_ter.php',
			// minLength: 0
		// });                
		
		$('#ac_cars').autocomplete({
			source: '../x_ac_cars.php',
			minLength: 0,
    	    select: function(e, ui){
				$('#ac_cars').val(ui.item.value);
			}
		}); 
		
		$('#ac_food').autocomplete({
			source: '../x_ac_food.php',
			minLength: 0,
    	    select: function(e, ui){
				$('#ac_food').val(ui.item.value);
			}
		}); 
		
		$('#ac_resturants').autocomplete({
			source: '../x_ac_resturants.php',
			minLength: 0,
    	    select: function(e, ui){
				$('#ac_resturants').val(ui.item.value);
			}
		}); 
		
		$('#ac_rx').autocomplete({
			source: '../x_ac_rx.php',
			minLength: 0,
    	    select: function(e, ui){
				$('#ac_rx').val(ui.item.value);
			}
		}); 
		
	var us=[]
	var tags	
	function ebaySearch(term,title) {
		var request = $.ajax({
			url: \"_x_ebay_item_details.php?term=\"+term+\"&title=\"+title, 
			type: \"GET\",
			cache: false,
			success: function(msg) {
				var ms=msg.split('|')
				$('#item_desc').html('<div style=\"font-size:0.8em\">'+ms[0]+'</div>')
				tags=JSON.parse(ms[1])
				for (var m=0;m<tags.length;m++) {
					uses.push(tags[m])
				}
				for (var k=0;k<uses.length;k++) {
					$(\"#myULTags\").tagit(\"createTag\", uses[k]);	
				}
			}
		})
	}
	
	function getItemDesc(itm) {
		var request = $.ajax({
			url: 'https://txt.am/v2/x_img_search.php?term='+itm, 
			type: \"GET\",
			cache: false,
			success: function(msg) {
				var item=JSON.parse(msg)
				var desc=item.desc
				var model=item.model
				var upc=item.upc
				var desc=item.desc
				var mclass=item.class
				var brand=item.brand
				var sku=item.sku
				var make=item.make
				var dept=item.dept
				var cat=item.cat
				var rating=item.rating
				var price=item.price
				var name=item.name				
				for (var k=0;k<uses.length;k++) {
					$(\"#myULTags\").tagit(\"createTag\", uses[k]);	
				}
			}
		})
	}
	</script>";
		return $js;
	} 
	
	public function get_ebay($q) {
		$url="http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=GautamSh-8747-4434-9413-ecec57e3bc53&GLOBAL-ID=EBAY-US&keywords=$q&paginationInput.entriesPerPage=20";
		$resp = simplexml_load_file($url);
		foreach($resp->searchResult->item as $item) {
			$pic   = $item->galleryURL;
			$link  = $item->viewItemURL;
			$title = $item->title[0];
			$t=$title."";
			$id	   = $item->itemId;
				$id=$id*1;
				$r[]=array("label"=>"$t", "image"=>"$pic", "id" => $id);			
		}
		echo $r=json_encode(($r));
	}

	public function getImageGoogle($k) {
		// domain .it works 26/04/2017
		$url = "https://www.google.it/search?q=##query##&tbm=isch";
		$web_page = $this->getPage( str_replace("##query##",urlencode($k), $url ));		
		preg_match_all("/ src=\"(http([^\"]*))\"/",$web_page,$a);
		return isset($a[1]) ? $a[1] : null;
	}
	public function getImage($key) {
		//
		// scraping content from picsearch
		$temp = file_get_contents("http://www.picsearch.com/index.cgi?q=".urlencode($key));
		preg_match_all("/<img class=\"thumbnail\" src=\"([^\"]*)\"/",$temp,$ar);
		if(is_array($ar[1])) return $ar[1];
		return false;
	}
	/*
		use the previous functions results to get a bigger picture 
		of the result.
	*/
	public function getImageBig($pic) {
		$ar = preg_split("/[\?\&]/",str_replace("&amp;","&",$pic));
		if(isset($ar[1])) {
			$temp = file_get_contents("http://www.picsearch.com/imageDetail.cgi?id=".$ar[1]."&amp;start=1&amp;q=");
			preg_match_all("/<a( rel=\"nofollow\")? href=\"([^\"]*)\">Full-size image<\/a>/i",$temp,$ar);
			if(isset($ar[2][0])) {
				return $ar[2][0];
			}
		}
	}

	
	/*
		get last Instagram pics and user data from instagram
		without the official api
	*/
	public function getInstagramPics($user) {
		$p = $this->getPage("https://www.instagram.com/".$user."/");
		
		// get a big json data
		preg_match("/window\._sharedData ?= (.*)<\/script>/Uis",$p,$a);
		$c = trim(preg_replace("/;$/","",trim($a[1])));
		$c = trim(preg_replace("/\n/","",trim($c)));
		$b = json_decode($c);

		if(isset($b->entry_data->ProfilePage[0]->graphql->user) && isset(
			$b->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges
		)) {
			$a = array();
			if(isset($b->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges)) {
				foreach($b->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges as $pic) {


					$a[] = array(
						"link"=>"https://www.instagram.com/p/".$pic->node->shortcode."/", 
						"code"=>$pic->node->shortcode, 
						"likes"=>isset($pic->node->edge_liked_by->count) ? $pic->node->edge_liked_by->count : 0, 
						"preview"=>isset($pic->node->edge_media_preview_like->count) ? $pic->node->edge_media_preview_like->count : 0, 
						"comments"=>isset($pic->node->edge_media_to_comment->count) ? $pic->node->edge_media_to_comment->count : 0, 
						"created"=>date("Y-m-d H:i:s",$pic->node->taken_at_timestamp), 
						"text"=>isset($pic->node->edge_media_to_caption->edges[0]->node->text) ? $pic->node->edge_media_to_caption->edges[0]->node->text : "", 
						"low_resolution"=>$pic->node->thumbnail_src,
						"standard_resolution"=>$pic->node->thumbnail_src,
						"full_resolution"=>$pic->node->display_url,
						"thumbnail"=>$pic->node->thumbnail_src,
						"width"=>$pic->node->dimensions->width,
						"height"=>$pic->node->dimensions->height,
						);
				}
			} else {
				$a="private user";
			}

			$q=0;




			if(isset($b->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->count)) $q=$b->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->count;

			//$b->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media = null;
			return array(
				"user"=>$b->entry_data->ProfilePage[0]->graphql->user,
				"pics"=>$a,
				"totalcount"=>$q
			);
		}
		return false;
	}
	public function getPage($url, $max_file_size=0) {

		if (!function_exists("curl_init")) die("getPage needs CURL module, please install CURL on your php.");
		$ch = curl_init();

		$https = preg_match("/^https/i",$url);

		if($this->use_file_get_contents=="yes") return file_get_contents($url);

		if($https && $this->use_file_get_contents=="https") {
			return file_get_contents($url);
		}

		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);       // Fail on errors
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    // allow redirects (abilitato per wikipedia)
		if($https) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			//curl_setopt($ch, CURLOPT_CERTINFO, true);
			//curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem");
		}
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);     // return into a variable
		//curl_setopt($ch, CURLOPT_PORT, 80);           //Set the port number
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);          // times out after 15s
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; he; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8");   // Webbot name
		curl_setopt($ch,CURLOPT_HTTPHEADER,array('Accept-Language: en-US;q=0.6,en;q=0.4'));
		if($max_file_size>0) {
			// if you want to reduce download size, set the byte size limit
			$this->max_file_size = $max_file_size;
			curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, 'on_curl_header'));
			curl_setopt($ch, CURLOPT_WRITEFUNCTION, array($this, 'on_curl_write'));
		}
		$web_page = curl_exec($ch);
		if(strlen($web_page) <= 1 && $max_file_size>0) {
			$web_page = $this->file_downloaded;
		}
		//if(curl_error($ch)) die(curl_error($ch));
		return $web_page;
	}

	
	public function create() {

	}
	private function dz_script() {
		return '
		<script>
			var filenames=""
			function upload_photo(f) {
				var url="../upload.php"
				var myDropzone, files=0, currImg, imagesUploaded, file_name, usr_img=[],filenames=[]
				if (!myDropzone) {
					myDropzone = new Dropzone("form#member", { 
						url: url,
						maxFilesize: 100000000,
						maxFiles:10,
						uploadprogress: function(file, progress, bytesSent) {
							console.log(progress)
							console.log(bytesSent)
						}
					});
				}
				myDropzone.on("sending", function(file, xhr, formData){
					var ext=file.name.split(".")[1]
					file_name=guid() + "." + ext
					formData.append("file_name", file_name);
					filenames += file_name + ","
					setCookie("filenames", JSON.stringify(filenames))
					currImg=file.name
					usr_img.push(currImg)
					imagesUploaded=usr_img.toString()
					console.log(imagesUploaded)
				});
				myDropzone.on("queuecomplete", function(file){
					$$(f).value = filenames.substr(0,filenames.length-1)
				});
			}
		</script>';		
	}
	
	private function page_init() {
		return '
		<div id="wrapper" class="clearfix">
			<header id="header" class="dark" data-sticky-class="dark">
				<div id="header-wrap">
					<div style="text-align:center" class="container clearfix">
						<h2 style="text-align:center" >' . $this->title . '</h2>
					</div>
				</div>
			</header>';
	}
	private function page_close() {
		return '</div></section>';
	}

	private function php_tag_open() {
		return '<?';
	}

	private function php_tag_close() {
		return '?>';
	}

	private function getArray($str) {
		return explode(",",$str);
	}
	
	public function createPHPForm() {
		$op  = "";
		$op	.= $pre_php;
		$op .= $this->html_open();
		$op .= $this->header_open();
		$op .= $this->meta();
		$op .= $this->css_files();
		$op .= $this->css_inline();
		$op .= $this->header_close();
		$op .= PHP_EOL;
		$op	.= $this->body_open();
		$op	.= $this->page_init();
		$op .= $this->printForm();
		$op .= $this->page_close();
		$op .= PHP_EOL;
		$op	.= $this->page_footer();
		$op .= PHP_EOL;
		$op .= $this->js_files();
		$op .= PHP_EOL;
		$op .= PHP_EOL;
		$op .= $this->activate_auto_location();
		$op .= $this->js_inline();
		$op .= $this->dz_script();
		$op .= PHP_EOL;
		$op	.= $this->body_close();
		$op .= PHP_EOL;
		$op	.= $this->html_close();
		$this->create_file($op);
	}

	public function createPHPBrowseTable($table) {
		$op  = "";
		$op	.= $pre_php;
		$op .= $this->html_open();
		$op .= $this->header_open();
		$op .= $this->page_title();
		$op .= $this->meta();
		$op .= $this->css_files();
		$op .= $this->css_inline();
		$op .= $this->header_close();
		$op .= PHP_EOL;
		$op	.= $this->body_open();
		$op	.= $this->page_init();
		$op .= $this->queryBrowse($table);
		$op .= $this->page_close();
		$op .= PHP_EOL;
		$op	.= $this->page_footer();
		$op .= PHP_EOL;
		$op .= $this->js_files();
		$op .= PHP_EOL;
		$op .= $this->js_inline();
		$op .= PHP_EOL;
		$op	.= $this->body_close();
		$op .= PHP_EOL;
		$op	.= $this->html_close();
		$this->create_file_browse($op);
	}

	public function SQLEdit($table) {
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
					
					function getDataView() {
						$.ajax({
								url		:	'getEditHTML.php?wideView='+getCookie('wideView')+'&qry=$qry',
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

	private function activate_auto_location() {
		$str = "<script>";
		for ($i=0; $i<count($auto_location_field_ids); $i++) {
			$str .= "initAutoComplete('" . $auto_location_field_ids[$i] . "')"  . PHP_EOL;
		}
		$str .= "</script>";
		return $str;
	}
	
	private function create_file($op) {
		if (file_put_contents("output/" . $this->user_file_name, $op)) echo $this->user_file_name;
	}
	
	private function create_file_browse($op) {
		if (file_put_contents("output/" . $this->user_file_name, $op)) echo $this->user_file_name;
	}
	
	private function create_file_edit($op) {
		if (file_put_contents("output/" . $this->user_file_name, $op)) echo $this->user_file_name;
	}
	
	public function php_helper() {
		return "";
	}
	
	public function getLatLng() {
		$latLng=file_get_contents("http://199.91.65.85:8080/json/".$this->getIP());
		return array($latLng->lat, $latLng->lng);
	}

	public function getCitySateFromIP($ip='') {
		$result  = "Unknown";
		if ($ip=='') $ip=$this->_ip();
		$ip_data = file_get_contents("http://gaysugardaddyfinder.com/json/$ip");
		$result = array($ip_data->city,$ip_data->state);
		return $result;
	}

	public function getLatLngFromIP($ip='') {
		$result  = "Unknown";
		if ($ip=='') $ip=$this->_ip();
		$ip_data = file_get_contents("http://gaysugardaddyfinder.com/json/$ip");
		$result = array($ip_data->lat,$ip_data->lng);
		return $result;
	}

	public function icrop($filename) {
		list($current_width, $current_height) = getimagesize($filename);
		$left = 0;
		$top = 0;
		$crop_width = 200;
		$crop_height = 200;
		$canvas = imagecreatetruecolor($crop_width, $crop_height);
		$current_image = imagecreatefromjpeg($filename);
		imagecopy($canvas, $im, 0, 0, $left, $top, $current_width, $current_height);
		imagejpeg($canvas, $filename, 100);
	}

	public function singleColor($filename1,$c="yellow"){ 
		$filename="/webroot/gaysugardaddyfinder/public_html/v3.0/sb/" . $filename1;
		require("/webroot/gaysugardaddyfinder/public_html/assets/wi/WideImage.php");

		$im = imagecreatefromjpeg($filename); 
		$height = imagesy($im); 
		$width = imagesx($im); 
		for($x=0; $x<$width; $x++){ 
			for($y=0; $y<$height; $y++){ 
				$rgb = ImageColorAt($im, $x, $y); 
				$r = ($rgb >> 16) & 0xFF; 
				$g = ($rgb >> 8) & 0xFF; 
				$b = $rgb & 0xFF; 
				$c=($r+$g+$b)/3; 
				if ($c=="green") {$r=$c;$g=$c; $b=$c;}//leaves only green 
				if ($c=="blue") {$r=$c;$g=$c; $b=$c;}//only blue 
				if ($c=="red") {$r=$c;$g=$c; $b=$c;}//only red 
				if ($c=="yellow"){$r=$c;$g=$c; $b=$c;}//only yellow 
				imagesetpixel($im, $x, $y,imagecolorallocate($im, $r,$g,$b)); 
			} 
		} 
		return imagejpeg($im); 
		imagedestroy($im);
		$img=WideImage::load($filename);

		//sreturn $im->writeImage("/webroot/gaysugardaddyfinder/public_html/undo/test.jpg");
	}  	

	public function adjustImage($filename1,$mode=0, $annotate="No Text Given!") {
//		require 'Instagraph.php';
//		$instagraph=new Instagraph;
//		$instagraph->setInput("../sb/".$filename1);
//		$instagraph->setOutput("../sb/".$filename1);
		require '../z/src/Image/Filter.php';
		require("/webroot/gaysugardaddyfinder/public_html/assets/wi/WideImage.php");
		$filename="/webroot/gaysugardaddyfinder/public_html/sb/" . $filename1;
		chmod($filename,0755);
		$filename_p="/webroot/gaysugardaddyfinder/public_html/sb1/" . $filename1;
		$filename_o="/webroot/gaysugardaddyfinder/public_html/original/" . $filename1;
		$filename_u="/webroot/gaysugardaddyfinder/public_html/undo/" . $filename1;
		$filename_r="sb/" . $filename1; 
		$im=WideImage::load($filename);
		if ($mode=="UNDO") {
			$im=WideImage::load($filename_u)->saveToFile($filename);
			return $filename;
		} else {
			$im->saveToFile($filename_u);
		}
		if (!getimagesize("/webroot/gaysugardaddyfinder/public_html/original/" . $filename1)) $im->saveToFile($filename_o);
		if (!getimagesize("/webroot/gaysugardaddyfinder/public_html/undo/" . $filename1)) $im->saveToFile($filename_u);
		if ($mode=="SINGLE") {
			$this->singleColor($filename1);
		} else {
			switch ( $mode ) {
				case "OLD":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->old();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "OLD2":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->old2();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "OLD3":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->old3();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "COOL":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->cool();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "LIGHT":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->light();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "FUZZY":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->fuzzy();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "ANTIQUE":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->antique();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "BLACKWHITE":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->blackwhite();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "GRAY":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->gray();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "BLUR":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->blur();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "VINTAGE":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->vintage();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "CONCENTRATE":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->concentrate();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "HERMAJESTY":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->hermajesty();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "FRESHGLOW":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->freshglow();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "EVERBLUE":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->everblue();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "FOREST":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->forest();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "TENDER":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->tender();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "DREAM":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->dream();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "FROZEN":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->frozen();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "RAIN":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->rain();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "ORANGEPEEL":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->orangepeel();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "DARKEN":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->darken();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "SUMMER":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->summer();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "RETRO":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->retro();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "COUNTRY":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->country();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "WASHED":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->washed();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "EMBOSS":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->embossed();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "SHARPEN":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->sharpen();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "BUBBLES":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->bubbles();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "EMBOSS2":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->emboss();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "BOOST":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->boost();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "BOOST2":
					$image = imagecreatefromjpeg($filename);
					$filter = (new Filter($image))->boost2();
					$image=imagejpeg($filter->getImage(),$filename);
					break;
				case "ROTATE1":
					$img=WideImage::load($filename)->rotate(+90)->saveToFile($filename);
					break;
				case "ROTATE2":
					$img=WideImage::load($filename)->rotate(-90)->saveToFile($filename);
					break;
				case "NEGATE":
					$img = new Imagick($filename);
					$img->negateImage(FALSE); 
					break;
				case "SEPIA":
					$img = new Imagick($filename);
					$img->sepiaToneImage(70);
					break;
				case "EDGE":
					$img = new Imagick($filename);
					$img->edgeImage(10);
					break;
				case "OIL":
					$img = new Imagick($filename);
					$img->oilPaintImage( 7 ); 
					break;
				case "SOLARIZE":
					$img = new Imagick($filename);
					$img->solarizeImage( 30000 ); 
					break;
				case "SHADE":
					$img = new Imagick($filename);
					$img->shadeImage(100,10,20); 
					break;
				case "CHARCOAL":
					$img = new Imagick($filename);
					$img->charcoalImage(5,2); 
					break;
				case "ENHANCE":
					$img = new Imagick($filename);
					$img->enhanceImage();
					break;
				case "MODULATE":
					$brightness=150;
					$saturation=100;
					$hue=100;
					$img = new Imagick($filename);
					$img->modulateImage($brightness, $saturation, $hue);
					break;
			case "EQUALIZE":
					$img = new Imagick($filename);
					$img->equalizeImage();
					break;
			case "ANNOTATE":
					$off=getimagesize($filename)[1]-50;
					$img = new Imagick($filename);
					$draw = new ImagickDraw();
					$pixel = new ImagickPixel( 'gray' );
					/* Black text */
					$draw->setFillColor('white');
					/* Font properties */
					$draw->setFont('Bookman-DemiItalic');
					$draw->setFontSize( 32 );
					/* Create text */
					$img->annotateImage($draw, 10, $off, 0, $annotate);
					break;
				case "PIXELATE1":
						$img = new Imagick($filename);
						$imageIterator = $img->getPixelIterator();
					 
						/** @noinspection PhpUnusedLocalVariableInspection */
						foreach ($imageIterator as $row => $pixels) { /* Loop through pixel rows */
							foreach ($pixels as $column => $pixel) { /* Loop through the pixels in the row (columns) */
								/** @var $pixel \ImagickPixel */
								if ($column % 1) {
									$pixel->setColor("rgba(50, 50, 50, 0)"); /* Paint every second pixel black*/
								}
							}
							$imageIterator->syncIterator(); /* Sync the iterator, this is important to do on each iteration */
						}
						break;
				case "PIXELATE2":
						$img = new Imagick($filename);
						$imageIterator = $img->getPixelIterator();
					 
						/** @noinspection PhpUnusedLocalVariableInspection */
						foreach ($imageIterator as $row => $pixels) { /* Loop through pixel rows */
							foreach ($pixels as $column => $pixel) { /* Loop through the pixels in the row (columns) */
								/** @var $pixel \ImagickPixel */
								if ($column % 2) {
									$pixel->setColor("rgba(50, 50, 50, 0)"); /* Paint every second pixel black*/
								}
							}
							$imageIterator->syncIterator(); /* Sync the iterator, this is important to do on each iteration */
						}
						break;
				case "PIXELATE3":
						$img = new Imagick($filename);
						$imageIterator = $img->getPixelIterator();
					 
						/** @noinspection PhpUnusedLocalVariableInspection */
						foreach ($imageIterator as $row => $pixels) { /* Loop through pixel rows */
							foreach ($pixels as $column => $pixel) { /* Loop through the pixels in the row (columns) */
								/** @var $pixel \ImagickPixel */
								if ($column % 3) {
									$pixel->setColor("rgba(50, 50, 50, 0)"); /* Paint every second pixel black*/
								}
							}
							$imageIterator->syncIterator(); /* Sync the iterator, this is important to do on each iteration */
						}
						break;
				case "UNDO":
					$img=WideImage::load($filename_u)->saveToFile($filename);
					break;
				case "RESET":
					$img=WideImage::load($filename_o)->saveToFile($filename);
					break;
					return 'sb/' . explode('/',$filename)[(count(explode('/',$filename))-1)];
					imagedestroy($im);
			}
		}
	}
	
	function isValidMobile($mob) {
		$num = trim($mob);
		$arr_a = array("-","."," ","(",")");
		$arr_b = array("","","","","");
		$num = str_replace($arr_a, $arr_b, $num);

		if ((strlen($num) < 10) || (strlen($num) > 11) || (substr($num,0,1)=='0') || (substr($num,1,1)=='0') || ((strlen($num)==10)&&(substr($num,0,1)=='1'))||((strlen($num)==11)&&(substr($num,0,1)!='1'))) return false;
		$num = (strlen($num) == 11) ? $num : ('1' . $num);	
		
		if ((strlen($num) == 11) && (substr($num, 0, 1) == "1")) {
			return $num;
		} else {
			return false;
		}
	}
	function formatMobile($mob, $format=false) {
		$num = trim($mob);
		$arr_a = array("-","."," ","(",")");
		$arr_b = array("","","","","");
		$num = str_replace($arr_a, $arr_b, $num);

		if ((strlen($num) < 10) || (strlen($num) > 11) || (substr($num,0,1)=='0') || (substr($num,1,1)=='0') || (substr($num,1,1)=='1')) return false;
		$num = (strlen($num) == 11) ? $num : ('1' . $num);	
		
		if ((strlen($num) == 11) && (substr($num, 0, 1) == "1")) {
			if($format) {
				$num = "(" . substr($num,1,3) . ") " . substr($num,4,3) . "-" . substr($num,7,4); 
			}
			return $num;
		} else {
			return false;
		}
	}	

		
	public function distance($point1, $point2) { 
		$radius      = 3958;
		$deg_per_rad = 57.29578;
		$distance = ($radius * pi() * sqrt( 
					($point1['lat'] - $point2['lat']) 
					* ($point1['lat'] - $point2['lat']) 
					+ cos($point1['lat'] / $deg_per_rad)
					* cos($point2['lat'] / $deg_per_rad)
					* ($point1['lng'] - $point2['lng']) 
					* ($point1['lng'] - $point2['lng']) 
			) / 180); 
		return round($distance,1);
	} 
	public function getLoc($ip) {
		$gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
		$record = geoip_record_by_addr($gi, $ip);
		$x_city =  $record->city;
		$x_state = $record->region;
		$x_zip = $record->postal_code;
		$x_lat = $record->latitude;
		$x_lng = $record->longitude;
		geoip_close($gi);
		return "$x_city, $x_state";
	}
	public function eSMS($to,$from="",$msg) {
		require '../voice/vendor/autoload.php';
		//use Plivo\RestAPI;
		$auth_id = "MAOWUYZMM5MDM4MWRHMW";
		$auth_token = "NGIzN2VlY2Y1NzY5Y2Y5Mzg4ZjBlYzlkYTUwNjQx";
		$p = new RestAPI($auth_id, $auth_token);
		$msg = $_GET['message'];
		if (isset($from)) $src=$from;
			else $src="19256669699";
		// Set message parameters
			$params = array(
			'src' => $src, // Sender's phone number with country code
			'dst' => $to, // Receiver's phone number with country code
			'text' => $msg, // Your SMS text message
			// To send Unicode text
			//'text' => 'こんにちは、元気ですか？' # Your SMS Text Message - Japanese
			//'text' => 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
			'url' => 'http://gaysugardaddyfinder.com/voice/report/', // The URL to which with the status of the message is sent
			'method' => 'POST' // The method used to call the url
		);
		// Send message
		$response = $p->send_message($params);

		// Print the response
		return $response['response'];
	}
	
	public function setSession($mobile,$data) {
		error_reporting('E_NONE');
		$this->_insert("insert into sms_sessions values('NULL','$mobile','$data')");
		return "insert into sms_sessions values('NULL','$mobile','$data')";
	}
	
	public function getLocationNew($ip="") {
		if ($ip=="") $ip=$this->getIP();
		return file_get_contents("http://199.91.65.85:8080/json/" . $ip);
	}
	public function getSession ($mobile) {
		return $this->query("select data from sms_sessions where mobile='$mobile'")[0]['data'];
	}

	public function send_mail($to, $from_login, $type, $subject='', $urgent='', $from='', $msg='', $attachments='',$header='', $footer='', $from_name='') {
		$str="http://gaysugardaddyfinder.com/email/send_mail.php?to_mid=$to&type=$type&from_login=$from_login&subject=$subject&msg=$msg&header=$header&footer=$footer&from=$from&from_name=$from_name&attachments=$attachments&x=" . rand(11111111,99999999);
		return file_get_contents($str);   
	}
	
	public function alt_mail($to, $from, $message, $alt="no", $subject="") {
		$headers = 	'From: cs@gaysugardaddyfinder.com' . "\r\n" .
					'Reply-To: cs@gaysugardaddyfinder.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		$subject="Message from $from";
		mail($to, $subject, $message, $headers);
	}
	
	public function email($to, $from, $message, $alt="no", $subject="") {
		$headers = 	'From: cs@gaysugardaddyfinder.com' . "\r\n" .
					'Reply-To: cs@gaysugardaddyfinder.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		$subject="Message from $from";
		mail($to, $subject, $message, $headers);
	}
	
	public function sms_mail($to, $from, $message, $alt="no", $subject="") {
		$m=$this->query("select mobile from dt_members where email='$to'");
		$mobile=	$m[0]['mobile'];
		$long_code=	$m[0]['long_code'];
		$headers = 	"From: $long_code@gaysugardaddyfinder.com" . "\r\n" .
					"Reply-To: cs@gaysugardaddyfinder.com" . "\r\n" .
					"X-Mailer: PHP/" . phpversion();
		$arrP=array('@vtext.com','@tmomail.net','@messaging.sprintpcs.com','@txt.att.net');
		for ($i=0;$i<count($arrP);$i++) {
			mail($mobile.$arrP[$i], '', $message, $headers);
		}
	}
	
	public function sendSMS($to, $from, $message,$type='SMS',$bal='') {
		file_get_contents("https://gaysugardaddyfinder.com/inc/x_send_api.php?to=$to&from=$from&message=$message&type=$type&bal=$bal");
	}
	
	public function getCredits($user) {
		return $this->query("select credits from dt_anon_sms where credits where mobile='$from' or long_code='$from'")[0]['credits'];		
	}

	public function sql($sql) {
		return $this->_sql($sql);
	}

	public function insert($sql) {
		return $this->_insert($sql);
	}

	public function query($sql) {
		return $this->_sql_arr($sql);
	}

	public function show($obj) {
		echo "<pre>";
			print_r($obj);
		echo "</pre>";
	}
	
	public function user_info($id) {
		$arr=$this->_sql_arr('select * from dt_members where id='.$id);
		return $arr;
	}

	public function user_long_code($long_code) {
		$arr=$this->_sql_arr('select id, login, filename_1, email, mobile, pswd from dt_members where long_code='.$long_code);
		return $arr[0];
	}

	public function user_mobile($mobile) {
		$arr=$this->_sql_arr('select id, login, filename_1, email, mobile, pswd from dt_members where mobile='.$mobile);
		return $arr[0];
	}

	public function user_login($id) {
		$arr=$this->_sql_arr('select login, filename_1, email, mobile, pswd from dt_members where id='.$id);
		return $arr[0];
	}

	public function login_info($mid) {
		$arr=$this->query("select email, login, pswd from dt_members where id='".$mid."'");
		$str = "\r\n\r\nPASS: " . $arr[0][pswd] . "\r\nLOGIN: " . $arr[0][login] . "\r\nEMAIL: " . $arr[0][email];
		return $str;
	}

	public function user_photo($id) {
		$arr=$this->_sql_arr('select filename_1 from dt_photos where member_id=$id');
		return array( "<img src='photos/" . $arr[filename_1] , $arr[filename_1] );
	}


	public function user_thumb($id, $size=30) {
		$arr=$this->_sql_arr('select filename_1 from dt_members where id='.$id.' limit 1');
		$f=$arr[0][filename_1];
		$f=explode('.',$f);
		$f1=$f[0];
		$f2=$f[1];
		$x=$size . "px";
	return array("<img onError='this.src=no_photo' style='width:$x; height:$x' src='photos/" . $f1 . "." . $f2 . "'>",$f1.".".$f2);
	}
	
	public function user_thumb_search($f='axx.png', $size=30) {
		if (empty($f)) $f='axx.png';
		$f=explode('.',$f);
		$f1=$f[0];
		$f2=$f[1];
		$x=$size . "px";
		$x_src='"photos/a29.png"';
		return array("<img onError='this.src=$x_src' class='' style='border:2px solid skyblue;width:$x; max-height:$x; height:$x; border-radius: 150px; --moz-corner-radius: 150px; margin:0px;' src='photos/" . $f1 . "." . $f2 . "'>",$f1.".".$f2);
	}
	
	protected function _sql($sql) {
		global $result;
		try {	
				$db=$this->conn;
				if($this->result = $db->query($sql)){
					return $this->result;
				} else {
					return null;
				}
			} catch (Exception $e) {
			return null;
		}
	}

	protected function _insert($sql) {
		global $result;
		try {	
				$db=$this->conn;
				if($db->query($sql)){
					return $db->insert_id;
				} else {
					return null;
				}
			} catch (Exception $e) {
			return null;
		}
	}

	protected function _update($sql) {
		global $result;
		try {	
				$db=$this->conn;
				if($db->query($sql)){
					return $db->insert_id;
				} else {
					return null;
				}
			} catch (Exception $e) {
			return null;
		}
	}

	protected function _sql_arr($sql) {
		global $dbs;
		global $row;
		global $rowset;
		try {
				$db=$this->conn;
			try {
					if($r = $db->query($sql)){
						while ($row =  $r->fetch_assoc()) {
							$arr[] = $row;
						}
						$this->rowset = $arr;
						$r->free();
						return $this->rowset;
					} else {
							return null;
					}
				} catch (Exception $e) {
					return null;
				}
			return $res;
		} catch (Exception $e) {
			return "Unable to connect";
			exit;
		}
	}

	public function add_date($date, $days, $unit="Days"){
		$date = strtotime("+".$days." ".$unit, strtotime($date));
		return  date("Y-m-d H:i:s", $date);
	}

	public function query2HTML($query) {
		echo '<style>';
		echo'.table_custom{font:Open Sans Condensed;color:#333; background:#f0f0f0; text-shadow:1px 1px 1px #fff} .table_header{color:#fff;background:#000;text-shadow:none} .table_row{background:#f0f0f0; color:#333; text-shadow:2px 2px 0px #fff} .table_row_alt{color:#000;background:lightblue}';
		echo '</style>';
		$x=0; $first_row = true;
		$header = "<table class='table_custom' cellpadding=10 cellspacing=0><tr id='th'>";	
		$f = $this->strAB('select','from', $query);
		$f = explode(',', $f);
		$f = $this->_sql_arr($query);
		$table  = $header;
		$rows = count($f);
			for($c=0; $c <= $rows; $c++){
				$class = ($x==0) ? 'table_row' : 'table_row_alt';
				$x = ($x == 1) ? 0 : 1;
				 if ($c == 0) $table .= "<tr class='$class' id='th'>";
					else $table .= "<tr class='$class' id='r$x'>";
					if ($f[$c]) {
					foreach($f[$c] as $_key => $_value)
						{
							if ($_key=='id') $id=$_value;
							if ($c == 0) $table .= "<td class='table_header'>" . strtoupper($_key) . "</td>";
								else $table .= "<td class='$class'><div contentEditable onblur=\"update(this,$_key)\" id=\"$_key|$id\">" . ($_value) . "</div></td>";
						}
					}
			}
		$table .= "</table>";
		echo $table;
		echo '	<script>
					function update(a,b,c) {
						if (currVal == b.textContent) return false
						var query="update `" + a + "` set `" + b.id.split(\'|\')[0] + "` = \'" + b.textContent + "\' where `id`=" + c;
						document.getElementById("up_msg").style.display="block"
						var request = $.ajax({
							url: "class/x_form_update.php?sql="+query, 
							type: "GET",
							dataType: "html",
							cache: false,
							success: function(msg) {
								setTimeout(function(){
									document.getElementById("up_msg").style.display="none"
								},1000)
							}
						})
					}
				</script>';
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
		
	public function fixMobile($mob) {
		$num = trim($mob);
		$arr_a = array("-","."," ","(",")");
		$arr_b = array("","","","","");
		$num = str_replace($arr_a, $arr_b, $num);

		if ((strlen($num) < 10) || (strlen($num) > 11) || (substr($num,0,1)=='0') || (substr($num,1,1)=='0') || (substr($num,1,1)=='1')) return false;
		$num = (strlen($num) == 11) ? $num : ("1$num");	
		
		if ((strlen($num) == 11) && (substr($num, 0, 1) == "1")) {
			return $num;
		} else {
			return false;
		}
	}

	function checkMobile($mob, $format=false) {
		$num = trim($mob);
		$arr_a = array("-","."," ","(",",");
		$arr_b = array("","","","","","");
		$num = str_replace($arr_a, $arr_b, $num);
		if ((strlen($num) < 10) || (strlen($num) > 11)) {
			return false;
		} else {
			if (strlen($num) == 10) {
				if (!ctype_digit($num)) {
					return false;
				}
				if ((substr($num,0,1)=='0') || (substr($num,1,1)=='0') || (substr($num,0,1)=='1') || (substr($num,3,1)*1 < 2) || (substr($num,4,2)=="11")) {
					return "false";
				} else {
					if($format) {
						$num = "(" . substr($num,0,3) . ") " . substr($num,3,3) . "-" . substr($num,6,4); 
					} else {
						$num = (strlen($num) == 11) ? $num : ("1$num");
					}
					return $num;
				}
			} else {
				if (!ctype_digit($num)) {
					return false;
				}
				if ((substr($num,0,1) != '1') || (substr($num,1,1)=='0') || (substr($num,1,1)=='1') || (substr($num,4,1)*1 < 2) || (substr($num,5,2)=="11")) {
					return "false";
				} else {
					if($format) {
						$num = "(" . substr($num,1,3) . ") " . substr($num,4,3) . "-" . substr($num,7,4); 
					} else {
						$num = (strlen($num) == 11) ? $num : ("1$num");
					}
					return $num;
				}
			}
		}
	}

	public function cpu_load() {
		$output = `vmstat`;
		$s = strpos(trim($output),'wa st');
			return str_replace(" ","",trim(substr($output, $s+7, 5)));
	}

	public function latlng($ip) {
		$latLng=file_get_contents("http://199.91.65.85:8080/json/".$this->getIP());
		return $latLng->lat ."|" . $latLng->lng;
			return "$lat|$lng";
	}
	
	public function get_lat_lng_zip($zip) {
		$arr=$this->_sql_arr('select latn, longw from dt_zips where zipcode='.$zip.' limit 1');
			return array($arr[0][latn], $arr[0][longw]);
	}
	
	public function getLatLngFromCityState($city, $state) {
		$r = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=$city+$state"));
			return array($r->results[0]->geometry->location->lat,$r->results[0]->geometry->location->lng);
	}

	public function getZip($city_state) {
		$r = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=$city_state"));
			return $r->results[0]->postal_code;
	}
	public function street($lat,$lng) {
		$r = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true"));
			return $r->results[0]->formatted_address;
	}
	
	public function cityState($lat,$lng) {
		error_reporting(1);
		$r = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true"));
		$r=$r->results[0]->address_components;
		$r=json_decode((json_encode($r)));
		for ($i = 0; $i < count($r); $i++) {
			$addr = $r[$i];
			$types=$addr->types[0];
			if ($types == 'street_number') $street = $addr->short_name;
			if ($types == 'route') $street .= " " . $addr->short_name;
			if ($types == 'postal_code') $zip = $addr->short_name;
			if ($types == 'administrative_area_level_1') $state = $addr->short_name;
			if ($types == 'locality') $city = $addr->long_name;
		}		
		return ($city . ", " . $state);
	}

	public function getUserLocation() {
		$ip=$this->_ip();
		$latLng = json_decode(file_get_contents("http://199.91.65.85:8080/json/$ip"));
		$lat=$latLng->latitude;
		$lng=$latLng->longitude;
		$r = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true"));
		$r=$r->results[0]->address_components;
		$r=json_decode((json_encode($r)));
		for ($i = 0; $i < count($r); $i++) {
			$addr = $r[$i];
			$types=$addr->types[0];
			if ($types == 'street_number') $street = $addr->short_name;
			if ($types == 'route') $street .= " " . $addr->short_name;
			if ($types == 'postal_code') $zip = $addr->short_name;
			if ($types == 'administrative_area_level_1') $state = $addr->short_name;
			if ($types == 'locality') $city = $addr->long_name;
		}		
		return json_encode(array($lat,$lng,$street,$city,$state,$zip));
	}
	public function getLocation($ip='') {
		if ($ip=='') $ip=$this->_ip();
		$latLng = json_decode(file_get_contents("http://199.91.65.85:8080/json/$ip"));
		$lat=$latLng->latitude;
		$lng=$latLng->longitude;
		$r = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true"));
		$r=$r->results[0]->address_components;
		$r=json_decode((json_encode($r)));
		for ($i = 0; $i < count($r); $i++) {
			$addr = $r[$i];
			$types=$addr->types[0];
			if ($types == 'street_number') $street = $addr->short_name;
			if ($types == 'route') $street .= " " . $addr->short_name;
			if ($types == 'postal_code') $zip = $addr->short_name;
			if ($types == 'administrative_area_level_1') $state = $addr->short_name;
			if ($types == 'locality') $city = $addr->long_name;
		}		
		return json_encode(array("lat"=>$lat,"lng"=>$lng));
	}

	public function location() {
		$ip=$this->_ip();
		return file_get_contents("http://199.91.65.85:8080/json/$ip");
	}

  
	public function cityStateToLatLng($city, $state) {
		$sql="select * from geo_city where city='$city' and state='$state' limit 1";      
		$result=$this->_sql_arr($sql);
		if ($result) {
			$lat=$result[0]['lat'];
			$lng=$result[0]['lng'];
		}
		return array($lat,$lng);
	}

	public function zipToLatLng($zip) {
		$sql="select * from geo_city where zip='$zip' limit 1";      
		$result=$this->_sql_arr($sql);
		if ($result) {
			$lat=$result[0]['lat'];
			$lng=$result[0]['lng'];
		}
		return array($lat,$lng);
	}

	public function latLngtoLocation($lat,$lng) {
		$sql="select zipcode from dt_zips where ((abs(round(latn, 4)-round(".$lat." ,4)) < 0.001)  and  (abs(round(longw, 4) - round(".$lng.", 4)) < 0.001))";
		$result=$this->_sql_arr($sql);
		if ($result) {
			$zip=$result[0][zipcode];
			$factor="0.001";
		} else {
			$sql="select zipcode, abs(round(latn, 4)-round(".$lat." ,4)) as lat, abs(round(longw, 4) - round(".$lng.", 4)) as lng from dt_zips where ((abs(round(latn, 4)-round(".$lat." ,4)) < 0.1)  and  (abs(round(longw, 4) - round(".$lng.", 4)) < 0.1)) order by lat asc";
			$result=$this->_sql_arr($sql);
				if ($result) {
					$zip=$result[0][zipcode];
					$factor="0.1";
				} else {
					$sql="select zipcode, abs(round(latn, 4)-round(".$lat." ,4)) as lat, abs(round(longw, 4) - round(".$lng.", 4)) as lng from dt_zips where ((abs(round(latn, 4)-round(".$lat." ,4)) < 1)  and  (abs(round(longw, 4) - round(".$lng.", 4)) < 1)) order by lat asc";
					$result=$this->_sql_arr($sql);
					if ($result) {
						$zip=$result[0][zipcode];
						$factor="1";
					}				
				}
		}
		$sql="select * from geo_city where zip='$zip' limit 1";
		$result=$this->_sql_arr($sql);
			if ($result) {
				$zip=$result[0][zip];
				$city=$result[0][city];
				$state=$result[0][state];
				$areacode=$result[0][areacode];
			}
		return json_encode(array("city"=>$city,"state"=>$state,"zip"=>$zip,"areacode"=>$areacode,"lat"=>$lat,"lng"=>$lng));
	}

		static public function set($name, $value)
		{
			$GLOBALS[$name] = $value;
		}

		static public function get($name)
		{
			return $GLOBALS[$name];
		}

       /** 256 Bit AES Encryption
        *   @returns Encrypted Text
        **/
		public function encrypt($string, $pass, $depth=256)	{	
			return AesCtr::encrypt($string, $pass, $depth);
		}
 
       /** 256 Bit AES Decryption
        *   @returns Decrypted Text
        **/
		public function decrypt($enc_string, $enc_pass, $depth=256)	{	
			return AesCtr::decrypt($enc_string, $enc_pass, $depth);
		}
 
       /** Coverts ASCII to Binary
        *   @returns void
        **/
		public function strToBin($string)	{	
			$bin='';
			for ($i=0; $i < strlen($string); $i++)
			{
				$string[$i] = str_replace("a","@",$string[$i]);
				$string[$i] = str_replace("b","!",$string[$i]);
				$string[$i] = str_replace("c","|",$string[$i]);
				$string[$i] = str_replace("d","$",$string[$i]);
				$string[$i] = str_replace("e","#",$string[$i]);
				$string[$i] = str_replace("f","O",$string[$i]);
				if (!($string[$i] == "|") && !($string[$i]=="@") && !($string[$i]=="#") && !($string[$i]=="$") && !($string[$i]=="O") && !($string[$i]=="!")){
					$bx4 .= (strlen(decbin($string[$i])) == 4) ? decbin($string[$i]) : ((strlen(decbin($string[$i])) == 3) ? "0".decbin($string[$i]) : ((strlen(decbin($string[$i])) == 2) ? "00".decbin($string[$i]) : "000".decbin($string[$i])));
				}
				else
				{
					$bx4 .= $string[$i];
				}
			}
			return $bx4;
		}
 
 
        /** Coverts Binary to ASCII
        *   @returns void
        **/
		public function BinToHex($string) {
			$string = str_replace("O","f",$string);
			$hex='';
			for ($i=0; $i < strlen($string); $i++)
			{
				if (in_array($string[$i], array("a","b","c","d","e","f"))) {
					$hex .= $string[$i];
				}
				else
				{
					$hex .= bindec(substr($string, $i, 4));
					$i = $i + 3;
				}
			}
			return $hex;
		}


		
	
 function getUrlContents($url, $maximumRedirections = null, $currentRedirection = 0)
 {
     $result = false;
     
     $contents = @file_get_contents($url);
     
     // Check if we need to go somewhere else
     
     if (isset($contents) && is_string($contents))
     {
         preg_match_all('/<[\s]*meta[\s]*http-equiv="?REFRESH"?' . '[\s]*content="?[0-9]*;[\s]*URL[\s]*=[\s]*([^>"]*)"?' . '[\s]*[\/]?[\s]*>/si', $contents, $match);
         
         if (isset($match) && is_array($match) && count($match) == 2 && count($match[1]) == 1)
         {
             if (!isset($maximumRedirections) || $currentRedirection < $maximumRedirections)
             {
                 return getUrlContents($match[1][0], $maximumRedirections, ++$currentRedirection);
             }
             
             $result = false;
         }
         else
         {
             $result = $contents;
         }
     }
     
     return $contents;
 }
	
	public function make_string($str_length,$str="",$fill)
	{
		$str="";
		for ($i=1; $i<=($str_length-strlen($str)*1); $i++) 
		{
			$str .= $fill;
		}
		return $str;
	}
	
	function IP2Loc($ip="") {
		require_once("geoipcity.inc");
		require_once("geoipregionvars.php");

		if (empty($ip)) {
			$ip=$this->_ip();
		}
		
		$gi	= geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);	
		$latLng=geoip_record_by_addr($gi, $ip);
		$lat=$latLng->latitude;
		$lng=$latLng->longitude;

		$sql="select zipcode from dt_zips where ((abs(round(latn, 4)-round(".$lat." ,4)) < 0.001)  and  (abs(round(longw, 4) - round(".$lng.", 4)) < 0.001))";
		$result=$this->_sql_arr($sql);
		if ($result) {
			$zip=$result[0][zipcode];
			$factor="0.001";
		} else {
			$sql="select zipcode, abs(round(latn, 4)-round(".$lat." ,4)) as lat, abs(round(longw, 4) - round(".$lng.", 4)) as lng from dt_zips where ((abs(round(latn, 4)-round(".$lat." ,4)) < 0.1)  and  (abs(round(longw, 4) - round(".$lng.", 4)) < 0.1)) order by lat asc";
			$result=$this->_sql_arr($sql);
			if ($result) {
				$zip=$result[0][zipcode];
				$factor="0.1";
			} else {
				$sql="select zipcode, abs(round(latn, 4)-round(".$lat." ,4)) as lat, abs(round(longw, 4) - round(".$lng.", 4)) as lng from dt_zips where ((abs(round(latn, 4)-round(".$lat." ,4)) < 1)  and  (abs(round(longw, 4) - round(".$lng.", 4)) < 1)) order by lat asc";
				$result=$this->_sql_arr($sql);
				if ($result) {
					$zip=$result[0][zipcode];
					$factor="1";
				}				
			}
		}
		$sql="select * from geo_city where zip='$zip' limit 1";
		$result=$this->_sql_arr($sql);
			if ($result) {
				$zip=$result[0][zip];
				$city=$result[0][city];
				$state=$result[0][state];
				$areacode=$result[0][areacode];
			}
		return json_encode(array("city"=>$city,"state"=>$state,"zip"=>$zip,"areacode"=>$areacode,"lat"=>$lat,"lng"=>$lng));
	}
	
	public function zip($lat,$lng) {
		$r = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true"));
			return $r->results[1]->address_components[0]->long_name;
	}
	
	public function city($lat,$lng) {
		$r = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true"));
			return $r->results[1]->address_components[1]->long_name;
	}

	function strAB($a, $b, $str)	{
		return substr($str, (strPos($str, $a) + strlen($a)), (strPos($str, $b) - (strPos($str, $a) + strlen($a))));
	}
	
	public function strGetAB($a, $b, $str)	{
		return substr($str, (strPos($str, $a) + strlen($a)), (strPos($str, $b) - (strPos($str, $a) + strlen($a))));
	}

	//Get all Characters between 2 strings or tags in a URL
	public function urlGetAB($a, $b, $url) {
		$str = file_get_contents($url);
		return substr($str, (strPos($str, $a) + strlen($a)), (strPos($str, $b) - (strPos($str, $a) + strlen($a))));
	}

	public function clean($objHTMLText){
		$event_desc = preg_replace("/(\\t|\\r|\\n)/","",trim($objHTMLText));  //recursively remove new lines \\n, tabs and \\r
	}

	public function strDate($strDate, $format = "D jS \of M \[h A\]") {
		return date_format(date_create($strDate), $format);
	}
	public function dateadd($objstr,$unit,$interval,$op='+') {
		$date=date_create($objstr);
		date_add($date,date_interval_create_from_date_string("$op$unit $interval"));
		return $date;
	}

	public function date_add($hours) {
		$ts1 = strtotime(date("Y")."-".date("m")."-".date("d"));
		return $ts1+$hours*60;
	}
	 function date_to_words($strDate) {
		$ts1 = strtotime(date("Y")."-".date("m")."-".date("d"));
		$ts2 = strtotime($strDate);
		$dateDiff    = $ts1 - $ts2;
		$units="Day";
		$fd    = floor($dateDiff/(60*60*24));
		$plurl = ($fd==1)?"":"s";
		
		if ($fd == 0) $rt = "Today!";
			
		if ($fd > 0) {
			$rt = "$fd $units{$plurl} Ago";
		}
			
		if ($fd < 0) $rt = "In ".$fd*(-1)." ".$units{$plurl};

		if ($fd==7){
			$datap = "1";
			$prefx = "";
			$units = "Week";
			$plurl = "";
			$tense = "Ago";
			$rt="$prefx $datap $units{$plural} $tense";

		} elseif (($fd>7)&&($fd<31)) {
			$datap = round($fd/7,0);
			$prefx = "Approx";
			$units = "Week";
			$plurl = ($datap*1 < 2)?"":"s";
			$tense = "Ago";
			$rt="$prefx $datap $units{$plurl} $tense";

		} elseif (($fd>31)&&($fd<=365)) {
			$datap = round($fd/30.5,0);
			$prefx = "Approx";
			$units = "Month";
			$plurl = ($datap*1 < 2)?"":"s";
			$tense = "Ago";
			if ($datap*1 >= 12) {
				$e_months = $datap-12;
				$datap=1;
				$units='year';
				$plurl = ($datap*1 < 2)?"":"s";
				if ($e_months > 0) {
					$extra=' and ';
					$rt="$prefx $datap $units{$plurl} $extra $e_months{$e_plurl} $tense";		
				} else {
					$rt="$prefx $datap $units{$plurl} $tense";
				}
			} else {
				$rt="$prefx $datap $units{$plurl} $tense";
			}
		} elseif ($fd>=365) {
			$bal_days = $fd%365;
			$datap = round($fd/365,0);
			$prefx = "Approx";
			$units = "Year";
			$plurl = ($datap*1 < 2)?"":"s";
			$tense = "Ago";

			if ($bal_days > 15) {
				$extra = "and";
				$e_month="1";
				$e_unit="Month";
				$e_plurl=($e_month>1)?"s":"";
			}

			if ($bal_days > 29) {
				$extra = "and";
				$e_month=round($bal_days/30.5,0);
				$e_unit="Month";
				$e_plurl=($e_month*1 > 1) ? "s" : "";
				if ($e_month>11) {
					$e_month='';
					$e_unit='';
					$e_plurl='';
					$extra='';
					$datap++;
				}
			}
			$rt="$prefx $datap $units{$plurl} $extra $e_month $e_unit{$e_plurl} $tense";
		}
			return $rt;
	}

	public function is_mobile() {
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
			return "mobile";
		} else {
			return FALSE;
		}
	}

	
    public function background($Command, $Priority = 0){
  //     if($Priority)
//           $PID = shell_exec("nohup nice -n $Priority $Command > /dev/null & echo $!");
  //     else
 //          $PID = shell_exec("nohup $Command > /dev/null & echo $!");
  $PID = shell_exec("nohup $Command > /dev/null & echo $!");
  return($PID);
   }
   /**
    * Check if the Application running !
    *
    * @param     unknown_type $PID
    * @return     boolean
    */
   public function is_running($PID){
       exec("ps $PID", $ProcessState);
       return(count($ProcessState) >= 2);
   }
   /**
    * Kill Application PID
    *
    * @param  unknown_type $PID
    * @return boolean
    */
   public function kill($PID){
       if(exec::is_running($PID)){
           exec("kill -KILL $PID");
           return true;
       }else return false;
   }
   
   public function getStateCode($state) {
		$state = str_replace("Outside United States","Non US",$state);
		$arr['California']="CA";
		$arr['Georgia']="GA";
		$arr['New Jersey']="NJ";
		$arr['New York']="NY";
		$arr['Arizona']="AZ";
		$arr['Texas']="TX";
		$arr['Oregon']="OR";
		$arr['Florida']="FL";
		$arr['Wyoming']="WY";
		$arr['Nevada']="NV";
		$arr['Pennsylvania']="PA";
		$arr['Illinois']="IA";
		$arr['Indiana']="IN";
		$arr['Nebraska']="NB";
		$arr['Wisconsin']="WI";
		$arr['Michigan']="MI";
		$arr['New Hampshire']="NH";
		$arr['North Carolina']="NC";
		$arr['South Carolina']="SC";
		$arr['Connecticut']="CN";
		$arr['Washington']="WA";
		$arr['North Dakota']="ND";
		$arr['South Dakota']="SD";
		$arr['Colorado']="CO";
		$arr['Oklahoma']="OK";
		$arr['Tennessee']="TN";
		$arr['Mississippi']="MS";
		$arr['Arkansas']="AK";
		$arr['New Mexico']="NM";
		$arr['Maryland']="MD";
		$arr['Delaware']="DA";
		$arr['Virginia']="VA";
		$arr['Massachusetts']="MA";
		$arr['Louisiana']="LA";
		$arr['Missouri']="MO"; 
		$arr['Montana']="MT"; 
		$arr['Utah']="UT";
		$arr['Kentucky']="KY";
		$arr['Alabama']="AL";
		$arr['Hawaii']="HI";
		$arr['West Virginia']="WV";
		$arr['Minnesota']="MN";
		$arr['Ohio']="OH";
		return(empty($arr[$state]))?$state:$arr[$state];
	}

	function getUserData($mid) {
		$q = $this->query("select * from dt_members where id=$mid");
		return $q[0];
	}
	
	function getUserName($mid) {
		$q = $this->query("select login from dt_members where id=$mid");
		return $q[0][login];
	}
	
	function getUserEmail($mid) {
		$q = $this->query("select email from dt_members where id=$mid");
		return $q[0][email];
	}
	
	function getUserMobile($input,$medium) {
		$q = $this->query("select mobile from dt_members where $medium='$input' limit 1");
		return $this->isValidMobile($q[0]['mobile']);
	}

 
	public function CheckForCellPhone($m) {
		$USER_ID = 'guatam@strikeiron.com';
		$PASSWORD = 'Strike1';
		$phoneNumber = $m;
		$WSDL = 'http://ws.strikeiron.com/MobileID2?WSDL';
		$client = new SoapClient($WSDL, array('trace' => 1, 'exceptions' => 1));
		$registered_user = array("RegisteredUser" => array("UserID" => $USER_ID,"Password" => $PASSWORD));
		$header = new SoapHeader("http://ws.strikeiron.com", "LicenseInfo", $registered_user);
		$client->__setSoapHeaders($header);
		$params = array("PhoneNumber" => $phoneNumber);
		$result = $client->__soapCall("CheckForCellPhone", array($params), null, null, $output_header);
		return $name = $result->CheckForCellPhoneResult;
	}
  
	public function getCallerID($m) {
		$USER_ID = 'guatam@strikeiron.com';
		$PASSWORD = 'Strike1';
		$phoneNumber = $m;
		$WSDL = 'http://ws.strikeiron.com/PhoneandAddressAdvanced?WSDL';
		$client = new SoapClient($WSDL, array('trace' => 1, 'exceptions' => 1));
		$registered_user = array("RegisteredUser" => array("UserID" => $USER_ID,"Password" => $PASSWORD));
		$header = new SoapHeader("http://ws.strikeiron.com", "LicenseInfo", $registered_user);
		$client->__setSoapHeaders($header);
		$params = array("PhoneNumber" => $phoneNumber);
		$result = $client->__soapCall("ReverseLookupByPhoneNumber", array($params), null, null, $output_header);
		return $name = $result->ReverseLookupByPhoneNumberResult->ServiceResult;
	}
 	
	function get_user_data($mid) {
		$sql="select login, ip, age,  lat, lng, cc_zip as zip, id as member_id, filename_1, cc_city as city, cc_state as state, general_info from dt_members where id='$mid'";
		$q = $this->query($sql);
			foreach($q as $r){
				$login = $r['login']; 
				$id = $r['member_id'];
				$pic = $r['filename_1'];
				$lat = $r['lat'];
				$lng = $r['lng'];
				$age = $r['age'];
				$gen = $r['gender'];
				$city = $r['city'];
				$state = str_replace("Outside United States","Non US",$r['state']);
				$ip = $r['ip'];
				$loc = "$city, $state";
				$p2['lat']=$lat;
				$p2['lng']=$lng;
				$dist=$this->distance($p1,$p2);
				try {
					$s=getimagesize("../v3.0/sb/".$pic);
					if ($s[0]!=$s[1]) {
						$filename="/webroot/sites/gaysugar/public_html/sb/".$pic;
					}
					$x_img=$this->user_thumb_search($id, 65)[0];
				} Catch (Exception $e) {}
			}
			$x_d="$dist Miles";
			if ($dist*1 > 7000) $x_d = "Far, far away";
		
			$arr=array('mask1','mask2','mask3','mask4','mask5','mask6','mask7','mask8','mask9','mask10','mask11','mask12');
			$mask = $arr[rand(0,12)];
			
			$x_d="$dist Mls";
			$x_login = '"'.$login.'"';
			$str[$ctr] = " 
				<div class = 'www_box2 row' style='width:420px;border-bottom:1px solid lightblue;font-family:Open Sans Condensed;font-size:18px;padding:10px;background:url(assets/images/$mask.png) center center;margin-top:-5px;margin-bottom:5px;padding-bottom:2px;padding-top:2px'>
					<div class='col-sm-2'>
						<a href='page.php?page=view_profile&member_id=$id'>$x_img</a>
					</div>
					<div class='col-sm-4' style='position:absolute;left:100px;margin-left:0;margin-right:0;margin-left:0;margin-right:0;padding:0;top:10px'> 
						<div>
							".substr($login,0,14).", $agex 
						</div>
						<div>
							<span>
								
							</span>
							<span>
								$x_d
							</span>
							<span>
								<a href='page.php?page=3dmap&track=$id'>
									<i class='fa fa-location-arrow' style='cursor:hand; cursor:pointer;color:#0093D9'></i>
								</a>
							</span>
						</div>
					</div>
					<div style='position:absolute;top:10px;right:0;margin-right:10px;padding:0;padding-right:15px;color:gold;'>
						<span>
							$loc
						</span>
					</div>
					<div style='position:absolute;top:50%;right:0;margin-right:10px;padding:0;padding-right:15px'>

						<span>
							<a onclick='initMsg($id,$x_login)' href='#'><img src='assets/images/i27g.png' style='height:30px; opacity:0.8'></a>
						</span>
						<span>
							<img src='assets/images/i31g.png' style='height:30px; opacity:0.8'>
						</span>
						<span>
							<img src='assets/images/i32g.png' style='height:30px; opacity:0.8'>
						</span>
						<span>
							<img src='assets/images/i04g.png' style='height:30px; opacity:0.8'>
						</span>
						<span>
							<img src='assets/images/i10g.png' style='height:30px; opacity:0.8'>
						</span>
					</div>						
				</div>";	
			return $str[$ctr];
	}

	public function track_user() {
		/* 1. Get Affiliate */
		if (($_COOKIE['aff'] !='') && (!empty($_COOKIE['aff']))){
			$aff=$_COOKIE['aff'];
		} else {
			if (!isset($_REQUEST[aff])) {
				$aff=$_SESSION['aff'];	
			} else {
				$aff = $_REQUEST[aff];
			}
		}
		
		/* 1. Get User Agent */
		$ua=$_SERVER['HTTP_USER_AGENT'];
		
		/* 1. Get IP Address */
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	
		/* 1. Get keyword used to search */
		$url=$_SERVER['REQUEST_URI'];
		$ref = $this->get_keywords($url);
		
		$host=$_SERVER['HTTP_REFERER']; 
		$keyword=$ref['keyword']; 

		if (empty($keyword)) $keyword=$_GET['q'];
		if (empty($keyword)) $keyword=$_GET['P'];
		if (empty($keyword)) $keyword=$_GET['wd'];
		if (empty($keyword)) $keyword=$_GET['query'];
		if (empty($keyword)) $keyword=$_GET['encquery'];
		
		if (!empty($aff)) setCookie("aff",$aff,time+3600*24,"/");
		if (!empty($host)) setCookie("HTTP_REFERER",$host,time+3600*24,"/");
		if (!empty($keyword)) setCookie("X_SOURCE",$keyword,time+3600*24,"/");
		if (!empty($ua)) setCookie("HTTP_USER_AGENT",$ua,time+3600*24,"/");
		if (!empty($ip)) setCookie("REMOTE_ADDR",$ip,time+3600*24,"/");
		
		return "$host|$keyword|$ua|$ip|$aff";
	}
	
	public function get_keywords($url = '') {
		// Get the referrer
		$referrer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
		$referrer = (!empty($url)) ? $url : $referrer;
		if (empty($referrer))
			return false;
	 
		// Parse the referrer URL
		$parsed_url = parse_url($referrer);
		if (empty($parsed_url['host']))
			return false;
		$host = $parsed_url['host'];
		$query_str = (!empty($parsed_url['query'])) ? $parsed_url['query'] : '';
		$query_str = (empty($query_str) && !empty($parsed_url['fragment'])) ? $parsed_url['fragment'] : $query_str;
		if (empty($query_str))
			return false;
	 
		// Parse the query string into a query array
		parse_str($query_str, $query);
	 
		// Check some major search engines to get the correct query var
		$search_engines = array(
			'q' => 'alltheweb|aol|ask|ask|bing|google',
			'p' => 'yahoo',
			'wd' => 'baidu'
		);
		foreach ($search_engines as $query_var => $se)
		{
			$se = trim($se);
			preg_match('/(' . $se . ')\./', $host, $matches);
			if (!empty($matches[1]) && !empty($query[$query_var]))
				return $query[$query_var];
		}
		return false;
	}

	public function strip_tags_content($text, $tags = '', $invert = FALSE) { 

	  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags); 
	  $tags = array_unique($tags[1]); 
		
	  if(is_array($tags) AND count($tags) > 0) { 
		if($invert == FALSE) { 
		  return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text); 
		} 
		else { 
		  return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text); 
		} 
	  } 
	  elseif($invert == FALSE) { 
		return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text); 
	  } 
	  return $text; 
	} 

	public function random_string($str_length=32) {
		$s=65;
		$r=97;
		$p=38;
		$length=128;
		if (1==1) {
			for ($i=48;$i<=57;$i++){
				$numbers[]=$i;
			}
		}

		if (1==1) {
			for ($i=$s;$i<$s+26;$i++){
				$upper[]=$i;
			}
		}
		if (1==1) {
			for ($i=$r;$i<$r+26;$i++){
				$lower[]=$i;
			}
		}
		if (1==1) {
			for ($i=176;$i<=179;$i++){
				$fractions[]=$i;
			}
		}
		if (1==1) {
			for ($i=188;$i<=190;$i++){
				$power[]=$i;
			}
			$power[]=137;
		}
		$symbols=array(58,59,60,61,62,63,64,153,169,174,156,167,176);
		$greek=array(140,166,167,164,133,134,135,181,182);
		$curr=array(128,131,142,154,158,159,161,162,163,165,169);

		$con=$numbers;
		$con=array_merge($con,$upper);
		$con=array_merge($con,$lower);
		//$con=array_merge($con,$fractions);
		//$con=array_merge($con,$power);
		//$con=array_merge($con,$symbols);
		//$con=array_merge($con,$greek);
		//$con=array_merge($con,$curr);
		for ($i=0;$i<=count($con)-1;$i++) {
			$arr[]=chr($con[$i]);
		}
		for ($i=0;$i<=$str_length;$i++){
			if (($i==3)||($i==9)) $str .= "-";
			$str .= $arr[rand(0,count($arr)-1)];
		}
		return $str;
	}

	public function google($q) {
		$this->query=$q;
		$this->userKey="AIzaSyCtYDYedySqc3VyEOsU2LyqC6l67MANF98&cx=002771127746944436221:nvhkzzltqom";
		$this->userKey="AIzaSyCAa916bQh0t1pz27oYQCPA7Z9z3Zdu_-k&cx=002771127746944436221:nvhkzzltqom";
		$this->curl = curl_init();
		curl_setopt( $this->curl , CURLOPT_URL , ltrim( "https://www.googleapis.com/customsearch/v1?key=" . $this->userKey . "&alt=atom&q=" . urlencode($this->query) ) );
		curl_setopt( $this->curl , CURLOPT_SSL_VERIFYPEER , false );
		curl_setopt( $this->curl , CURLOPT_RETURNTRANSFER , 1 );
		$this->response = curl_exec($this->curl);
		curl_close($this->curl);
		return $this->response;
	}
}

