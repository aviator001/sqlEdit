					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: TEXT:</label>
							<input onblur="check(this,'text',this.value)" placeholder="Generic Text Box" type="text" id="text"  name="text"  value="" class="form-control large-font">
							<div id="text_err"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: COLOR:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-palette"></i></span>
								<input onblur="check(this,'color',this.value);is_valid(this)" placeholder="Text Box for Color" type="color" id="color"  name="color" value="" class="form-control large-font">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: PHONE:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								<input onblur="check(this,'mobile',this.value);is_valid_mobile(this)" required placeholder="Text Box for Phone Numbers" type="tel" id="mobile"  name="register-form-phone" autocomplete="tel-national"  value="" class="form-control large-font">
								<div id="err_mobile"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: NUMBER:</label>
							<div class="input-group">
								<span class="input-group-addon"> <b>#</b> </span>
								<input onblur="check(this,'number',this.value);is_valid_number(this)" placeholder="Text Box for Numbers" type="number" id="number"  name="number" autocomplete="number"  value="" class="form-control large-font">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: EMAIL:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-at"></i></span>
								<input onblur="check(this,'email',this.value);is_valid_email(this)" placeholder="Text Box for Email" type="email" id="email"  name="email" autocomplete="email"  value="" class="form-control large-font">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: CURRENCY:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input onblur="check(this,'currency',this.value);is_valid_currency(this)" placeholder="Text Box for Currency" type="currency" id="currency"  name="email" autocomplete="email"  value="" class="form-control large-font">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: URL:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="i-rounded i-light icon-globe"></i></span>
								<input onblur="check(this,'url',this.value);is_valid_url(this)" placeholder="Text Box for URLs" type="url" id="url"  name="url" autocomplete="url"  value="" class="form-control large-font">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: SEARCH:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-search-plus"></i></span>
								<input onblur="check(this,'search',this.value)" placeholder="Text Box for Search Term" type="search" id="search"  name="search" value="" class="form-control large-font">
							</div>
						</div>
					</div>					
					<div class="row" style="">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: USERNAME:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input onblur="check(this,'login',this.value);is_valid_login(this)" placeholder="Text Box for Usernames" type="username" id="login"  name="login" value="" class="form-control large-font">
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: PASSWORD:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input onblur="check(this,'password',this.value)" placeholder="Text Box for Passwords" type="password" id="password" name="password" value="" class="form-control large-font">
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: TIME:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-clock"></i></span>
								<input type="time" id="time" name="time" class="form-control" value="10:10" class="hasTimepicker">
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: DATE:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="i-rounded i-light icon-calendar"></i></span>
								<input type="date" id="date" name="date" class="form-control" value="2019-02-02" class="hasDatepicker">
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: WEEK:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-calendar-week"></i></i></span>
								<input type="week" id="week" name="week" class="form-control" value="2019-W05" class="hasTimepicker">
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: MONTH:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-calendar-day"></i></span>
								<input type="month" id="month" name="month" class="form-control" value="2019-02" class="hasDatepicker">
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: PHOTO UPLOADER:</label>
							<form action="upload.php"  style="border:3px dashed gainsboro!Important;width:100%" class="dropzone dz-preview" id="member"></form>
							<div style="border:none;inset 1px 1px 10px rgba(0,0,0,0.8);width:250px;height:40px;display:none;" id="pbar_holder"><div id="pbar" class="www_box3" style="width:0;height:40px;background:url(http://sugardaddyscore.com/images/led_bar3.png);background-size:cover"></div>
								<div id="pc" style="width:75px;position:absolute;margin-top:-37px;margin-left:260px"></div>										
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: SELECT</label>
							<div class="input-group">
								<select data-live-search="true" onchange="saveSite(this.value)" id="ss" class="select-1 form-control select2-hidden-accessible" multiple="" style="width:350px" tabindex="-1" aria-hidden="true">
									<optgroup label="Member Sites" style="width:100%;max-width:100%">
										<option onselect="savesite('Option 1')" value="SugarDaddyForMe">Option 1</option>
										<option onselect="savesite('Option 2')" value="SeekingArrangement">Option 2</option>
										<option onselect="savesite('Option 3')" value="SugarDaddie">Option 3</option>
										<option onselect="savesite('Option 4')" value="AshleyMadison">Option 4</option>
										<option onselect="savesite('Option 5')" value="WealthyMen">Option 5</option>
										<option onselect="savesite('Option 6')" value="Other">Option 6</option>
									</optgroup>
								</select>
							</div>									
						</div>									
					</div>									
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: CHECKBOX</label>
							<div class="input-group">
								<div>
									<input onclick="selMultiCheck('Option 1')" id="checkbox-7" class="checkbox-style" name="checkbox-7" type="checkbox">
									<label for="checkbox-7" class="checkbox-style-2-label"></label>Select Option 1
								</div>										
								<div>
									<input onclick="selMultiCheck('Option 2')" id="checkbox-8" class="checkbox-style" name="checkbox-8" type="checkbox">
									<label for="checkbox-8" class="checkbox-style-2-label"></label>Select Option 2
								</div>
								<div>
									<input onclick="selMultiCheck('Option 3')" id="checkbox-9" class="checkbox-style" name="checkbox-9" type="checkbox">
									<label for="checkbox-9" class="checkbox-style-2-label"></label>Select Option 3
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="">
						<div class="col-md-6" style="">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: RADIO</label>
							<input type="hidden" id="selRadio1">
							<div class="input-group">
								<div>
									<input data-group="selRadio1" checked onclick="selRadio('selRadio1', this.id,  'Unique Option 1')" id="checkbox-10" class="checkbox-style" name="checkbox-10" type="checkbox">
									<label for="checkbox-10" class="checkbox-style-1-label">Unique Option 1</label>
								</div>										
								<div>
									<input data-group="selRadio1" onclick="selRadio('selRadio1', this.id, 'Unique Option 2')" id="checkbox-20" class="checkbox-style" name="checkbox-20" type="checkbox">
									<label for="checkbox-20" class="checkbox-style-1-label">Unique Option 2</label>
								</div>
								<div>
									<input data-group="selRadio1" onclick="selRadio('selRadio1', this.id, 'Unique Option 3')" id="checkbox-30" class="checkbox-style" name="checkbox-20" type="checkbox">
									<label for="checkbox-30" class="checkbox-style-1-label">Unique Option 3</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: REMOTE CONTENT [AJAX]</label>
							<input onblur="fetch_remote(this.value)" placeholder="Enter URL to fetch content from" type="url" id="remote"  name="remote"  value="" class="form-control large-font">
							<div id="remote_err"></div>
							<div data-remote></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="javascript:popup()"><i class="fas fa-info-circle silver"></i></a> <label for="login-form-username"> TYPE: CODE</label>
							<input onblur="fetch_code(this.value)" placeholder="Enter path/filename to fetch code from" type="url" id="code"  name="code"  value="" class="form-control large-font">
							<div id="code_err"></div>
							<div data-code></div>
						</div>
					</div>				
