<pre><?php // print_r($debug); ?></pre>

<div class="half-box"> 
	<h2><?php echo lang('profile.apply'); ?></h2>
	<p><?php echo lang('profile.required_intro'); ?></p>
</div>
<!-- 
<div class="half-box buttons">
	<button class="fright" style="margin-top: 40px" onclick="window.location.href='<?php echo site_url('profile/manage_pic'); ?>'">
		<?php echo img('img/icons/photos.png') . ' ' . lang('profile.manage_photos'); ?>
	</button>
</div>
 -->
<div class="clear"></div>

<?php
$attributes = array('class' => '', 'id' => 'app', 'name' => 'app');
echo form_open_multipart('profile/edit', $attributes); 
?>

<?php if (!empty($error)) { ?>
<div class="error rounded">
<?php echo lang('profile.error') . " $error"; ?>
</div>
<?php } ?>

<div style="float: left; width: 320px">
<p>
	<label for="name" class="main"><?php echo lang('profile.name');?> <span class="required">*</span></label>
	<?php echo form_error('name'); ?>
	<br />
	<input id="name" name="name" type="text" maxlength="120" onchange="updateCompletionPercentage()"
		value="<?php isset($name) ? print $name : print set_value('name'); ?>" />
</p>

<p>
	<label for="gender" class="main"><?php echo lang('profile.gender'); ?> <span class="required">*</span></label>
	<?php echo form_error('gender'); ?>
	<br />
		<input id="gender" name="gender" type="radio" value="male" onchange="updateCompletionPercentage()"
		<?php if (isset($gender) && $gender == 'male') { print 'checked="true"'; } else echo $this->form_validation->set_radio('gender', 'male'); ?> />
		<label for="gender"><?php echo lang('profile.male'); ?></label>
	<br />
		<input id="gender" name="gender" type="radio" value="female" onchange="updateCompletionPercentage()"
		<?php if (isset($gender) && $gender == 'female') { print 'checked="true"'; } else echo $this->form_validation->set_radio('gender', 'female'); ?> />
		<label for="gender"><?php echo lang('profile.female'); ?></label>
</p>

<p>
	<label for="height" class="main"><?php echo lang('profile.height');?> <span class="required">*</span></label>
	<?php echo form_error('height'); ?>
	<br /><input id="height" type="text" name="height" size="6" onchange="updateCompletionPercentage()"
		value="<?php isset($height) ? print $height : print set_value('height'); ?>"  /> cm
</p>

<p>
	<label for="weight" class="main"><?php echo lang('profile.weight'); ?> <span class="required">*</span></label>
	<?php echo form_error('weight'); ?>
	<br /><input id="weight" type="text" name="weight" size="6" onchange="updateCompletionPercentage()"
		value="<?php isset($weight) ? print $weight : print set_value('weight'); ?>"  /> kg
</p>

<p>
	<label for="birthday" class="main"><?php echo lang('profile.birthday'); ?> (YYYY/MM/DD) <span class="required">*</span></label>
	<?php echo form_error('birthday_year'); ?>
	<br />
	<select id="birthday_year" name="birthday_year" onchange="updateCompletionPercentage()">
		<?php $years = range(date('Y'), 1900); foreach ($years as $year) { ?>
		<option value="<?php echo $year; ?>"
			<?php if (isset($birthday_year) && $birthday_year == $year) echo set_select('birthday_year', $year, TRUE); ?>><?php echo $year; ?></option>
		<?php } ?>
	</select> /
	<select id="birthday_month" name="birthday_month" onchange="updateCompletionPercentage()">
		<?php $months = range(1, 12); foreach ($months as $month) { ?>
		<option value="<?php echo $month; ?>"
			<?php if (isset($birthday_month) && $birthday_month == $month) echo set_select('birthday_month', $month, TRUE); ?>><?php echo $month; ?></option>
		<?php } ?>
	</select> /
	<select id="birthday_date" name="birthday_date" onchange="updateCompletionPercentage()">
		<?php $days = range(1, 31); foreach ($days as $day) { ?>
		<option value="<?php echo $day; ?>"
			<?php if (isset($birthday_date) && $birthday_date == $day) echo set_select('birthday_date', $day, TRUE); ?>><?php echo $day; ?></option>
		<?php } ?>
	</select>
</p>

<p>
	<label for="city" class="main"><?php echo lang('profile.city'); ?> <span class="required">*</span></label>
	<?php echo form_error('city'); ?>
	<br /><input id="city" type="text" name="city" maxlength="32" onchange="updateCompletionPercentage()"
	 value="<?php isset($city) ? print $city : print set_value('city'); ?>"  />
</p>

<p>
	<label for="telephone" class="main"><?php echo lang('profile.telephone'); ?> <span class="required">*</span></label>
	<?php echo form_error('telephone'); ?>
	<br /><input id="telephone" type="text" name="telephone" maxlength="32" onchange="updateCompletionPercentage()"
	 value="<?php isset($telephone) ? print $telephone : print set_value('telephone'); ?>"  />
</p>
</div>

<div style="float: left; width: 320px">
<p>
	<label for="ethnicity" class="main"><?php echo lang('profile.ethnicity'); ?> <span class="required">*</span></label>
	<?php echo form_error('ethnicity'); ?>
	<br />
		<input id="ethnicity" name="ethnicity" type="radio" value="asian" onchange="updateCompletionPercentage()"
		 <?php if (isset($ethnicity) && $ethnicity == 'asian') { print 'checked="true"'; } else echo $this->form_validation->set_radio('ethnicity', 'asian'); ?> />
		<label for="ethnicity"><?php echo lang('profile.asian'); ?></label>
	<br />
		<input id="ethnicity" name="ethnicity" type="radio" value="caucasian" onchange="updateCompletionPercentage()"
		 <?php if (isset($ethnicity) && $ethnicity == 'caucasian') { print 'checked="true"'; } else echo $this->form_validation->set_radio('ethnicity', 'caucasian'); ?> />
		<label for="ethnicity"><?php echo lang('profile.caucasian'); ?></label>
	<br />
		<input id="ethnicity" name="ethnicity" type="radio" value="african" onchange="updateCompletionPercentage()"
		 <?php if (isset($ethnicity) && $ethnicity == 'african') { print 'checked="true"'; } else echo $this->form_validation->set_radio('ethnicity', 'african'); ?> />
		<label for="ethnicity"><?php echo lang('profile.african'); ?></label>
	<br />
		<input id="ethnicity" name="ethnicity" type="radio" value="latino" onchange="updateCompletionPercentage()"
		 <?php if (isset($ethnicity) && $ethnicity == 'latino') { print 'checked="true"'; } else echo $this->form_validation->set_radio('ethnicity', 'latino'); ?> />
		<label for="ethnicity"><?php echo lang('profile.latino'); ?></label>
	<br />
		<input id="ethnicity" name="ethnicity" type="radio" value="other" onchange="updateCompletionPercentage()"
		 <?php if (isset($ethnicity) && $ethnicity == 'other') { print 'checked="true"'; } else echo $this->form_validation->set_radio('ethnicity', 'other'); ?> />
		<label for="ethnicity"><?php echo lang('profile.other'); ?></label>
</p>

<p>
	<label for="hair_color" class="main"><?php echo lang('profile.hair_color'); ?> <span class="required">*</span></label>
	<?php echo form_error('hair_color'); ?>
	<br />
		<input id="hair_color" name="hair_color" type="radio" value="black" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_color) && $hair_color == 'black') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_color', 'black'); ?> />
		<label for="hair_color"><?php echo lang('profile.black'); ?></label>
	<br />
		<input id="hair_color" name="hair_color" type="radio" value="brunette" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_color) && $hair_color == 'brunette') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_color', 'brunette'); ?> />
		<label for="hair_color"><?php echo lang('profile.brunette'); ?></label>
	<br />
		<input id="hair_color" name="hair_color" type="radio" value="blonde" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_color) && $hair_color == 'blonde') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_color', 'blonde'); ?> />
		<label for="hair_color"><?php echo lang('profile.blonde'); ?></label>
	<br />
		<input id="hair_color" name="hair_color" type="radio" value="other" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_color) && $hair_color == 'other') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_color', 'other'); ?> />
		<label for="hair_color"><?php echo lang('profile.other'); ?></label>
</p>


<p>
	<label for="hair_length" class="main"><?php echo lang('profile.hair_length'); ?> <span class="required">*</span></label>
	<?php echo form_error('hair_length'); ?>
	<br />
		<input id="hair_length" name="hair_length" type="radio" value="short" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_length) && $hair_length == 'short') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_length', 'short'); ?> />
		<label for="hair_length"><?php echo lang('profile.short'); ?></label>
	<br />
		<input id="hair_length" name="hair_length" type="radio" value="medium" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_length) && $hair_length == 'medium') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_length', 'medium'); ?> />
		<label for="hair_length"><?php echo lang('profile.medium'); ?></label>
	<br />
		<input id="hair_length" name="hair_length" type="radio" value="long" onchange="updateCompletionPercentage()"
		 <?php if (isset($hair_length) && $hair_length == 'long') { print 'checked="true"'; } else echo $this->form_validation->set_radio('hair_length', 'long'); ?> />
		<label for="hair_length"><?php echo lang('profile.long'); ?></label>
</p>
</div>

<div style="float: left; width: 320px">
<p>
		<label for="nickname" class="main"><?php echo lang('profile.nickname'); ?></label>
		<?php echo form_error('nickname'); ?>
		<br /><input id="nickname" type="text" name="nickname" maxlength="120" onchange="updateCompletionPercentage()"
		 value="<?php isset($nickname) ? print $nickname : print set_value('nickname'); ?>"  />
</p>

<p>
		<label for="bra_size" class="main"><?php echo lang('profile.bra_waist_hips'); ?><br /><span class="light">32C-28-34</span></label>
		<?php echo form_error('bra_size'); ?>
		<?php echo form_error('waist'); ?>
		<?php echo form_error('hips'); ?>
		
		<br />
		<input id="bra_size" size="6" type="text" name="bra_size" maxlength="6" onchange="updateCompletionPercentage()"
		 value="<?php isset($bra_size) ? print $bra_size : print set_value('bra_size'); ?>"  /> -
		<input id="waist" size="6" type="text" name="waist" maxlength="11" onchange="updateCompletionPercentage()"
		 value="<?php isset($waist) ? print $waist : print set_value('waist'); ?>"  /> -
		<input id="hips" size="6" type="text" name="hips" maxlength="11" onchange="updateCompletionPercentage()"
		 value="<?php isset($hips) ? print $hips : print set_value('hips'); ?>"  />
</p>

<p>
		<label for="shoe_size" class="main"><?php echo lang('profile.shoe_size'); ?></label>
		<?php echo form_error('shoe_size'); ?>
		<br /><input id="shoe_size" type="text" name="shoe_size" maxlength="11" onchange="updateCompletionPercentage()"
		 value="<?php isset($shoe_size) ? print $shoe_size : print set_value('shoe_size'); ?>"  />
</p>

<p>
		<label for="bio" class="main"><?php echo lang('profile.bio'); ?></label>
		<?php echo form_error('bio'); ?>
		<br />
		<textarea id="bio" name="bio" rows="10" cols="50" onchange="updateCompletionPercentage()"><?php isset($bio) ? print $bio : print set_value('bio'); ?></textarea>
</p>

<div class="buttons" style="margin-top: 20px; padding: 10px;">
	<button type="submit" class="positive">
		<?php echo img('img/icons/bullet_go.png') . ' ' . lang('profile.submit_application'); ?>
	</button>
</div>
</div>

<div class="clear"></div>

<?php echo form_close(); ?>
