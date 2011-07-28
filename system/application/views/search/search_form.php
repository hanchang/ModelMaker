<?php 
function generateInputTag($id, $size) {
	return array('id' => $id, 'name' => $id, 'size' => $size);
}
?>

<?php echo lang('search.intro'); ?>
<?php echo form_open('search/results'); ?>
<?php if (!empty($error)) { ?>
<div class="error rounded"><?php echo lang('search.no_criteria'); ?></div>
<?php } ?>

<p>
<label class="main"><?php echo lang('profile.gender'); ?></label><br />
<?php 
	echo form_checkbox('gender[]', 'male') . ' ' . lang('profile.male') . br();
	echo form_checkbox('gender[]', 'female') . ' ' . lang('profile.female') . br();
?>
</p>

<p>
<label class="main"><?php echo lang('search.age'); ?></label><br />
<?php 
	echo lang('search.between') . ' ' . 
		form_input(generateInputTag('age_from', 5)) . ' ' . 
		lang('search.and') . ' ' . 
		form_input(generateInputTag('age_to', 5)) . ' ' .
		lang('search.years_old');
?>
</p>

<p>
<label class="main"><?php echo lang('profile.ethnicity'); ?></label><br />
<?php 
	echo form_checkbox('ethnicity[]', 'asian') . ' ' . lang('profile.asian') . br();
	echo form_checkbox('ethnicity[]', 'white') . ' ' . lang('profile.white') . br();
	echo form_checkbox('ethnicity[]', 'black') . ' ' . lang('profile.black') . br();
	echo form_checkbox('ethnicity[]', 'latino') . ' ' . lang('profile.latino') . br();
	echo form_checkbox('ethnicity[]', 'other') . ' ' . lang('profile.other') . br();
?>
</p>

<p>
<label class="main"><?php echo lang('profile.height'); ?></label><br />
<?php 
	echo lang('search.between') . ' ' . 
		form_input(generateInputTag('height_from', 6)) . ' cm ' . 
		lang('search.and') . ' ' . 
		form_input(generateInputTag('height_to', 6)) . ' cm'; 
?>
</p>

<p>
<label class="main"><?php echo lang('profile.weight'); ?></label><br />
<?php 
	echo lang('search.between') . ' ' . 
		form_input(generateInputTag('weight_from', 6)) . ' kg ' . 
		lang('search.and') . ' ' . 
		form_input(generateInputTag('weight_to', 6)) . ' kg'; 
?>
</p>

<p>
<label class="main"><?php echo lang('profile.hair_color'); ?></label><br />
<?php 
	echo form_checkbox('hair_color[]', 'black') . ' ' . lang('profile.black') . br();
	echo form_checkbox('hair_color[]', 'brunette') . ' ' . lang('profile.brunette') . br();
	echo form_checkbox('hair_color[]', 'blonde') . ' ' . lang('profile.blonde') . br();
	echo form_checkbox('hair_color[]', 'other') . ' ' . lang('profile.other') . br();
?>
</p>

<p>
<label class="main"><?php echo lang('profile.hair_length'); ?></label><br />
<?php 
	echo form_checkbox('hair_length[]', 'short') . ' ' . lang('profile.short') . br();
	echo form_checkbox('hair_length[]', 'medium') . ' ' . lang('profile.medium') . br();
	echo form_checkbox('hair_length[]', 'long') . ' ' . lang('profile.long') . br();
?>
</p>

<p>
<label class="main"><?php echo lang('profile.bra_waist_hips')?></label><br />
<?php echo form_input(generateInputTag('bra', 4)) . '-' . 
		form_input(generateInputTag('waist', 4)) . '-' . 
		form_input(generateInputTag('hips', 4)); 
?>
</p>

<p>
<label class="main"><?php echo lang('profile.shoe_size'); ?></label><br />
<?php 
	echo lang('search.between') . ' ' . 
		form_input(generateInputTag('shoe_size_from', 4)) . ' ' .
		lang('search.and') . ' ' . 
		form_input(generateInputTag('shoe_size_to', 4));
?>
</p>

<p>
<label class="main"><?php echo lang('profile.city'); ?></label><br />
<?php 
	echo form_input(generateInputTag('city', 20));
?>
</p>

<div class="buttons" style="margin: 20px 0;">
	<button type="submit">
		<?php echo img('img/icons/zoom.png') . ' ' . lang('search.do_search'); ?>
	</button>
</div>

</form>