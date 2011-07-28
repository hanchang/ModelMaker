<pre><?php // print_r($debug); ?></pre>

<h2><?php echo $username; ?></h2>

<div class="third-box">
	<p>
	<?php echo img(array('src' => "img/uploads/$pic_face", 'class' => 'profile')); ?>
	<br />
	<?php echo img(array('src' => "img/uploads/$pic_upper", 'class' => 'profile')); ?>
	<br />
	<?php echo img(array('src' => "img/uploads/$pic_full", 'class' => 'profile')); ?>
	</p>
</div>

<div class="half-box">
<p>
	<?php echo lang('profile.name') . ": $name"; ?>
</p>

<p>
	<?php echo lang('profile.gender') . ': ' . lang("profile.$gender"); ?>
</p>

<p>
	<?php echo lang('profile.birthday') . ": $birthday"; ?>
</p>

<p>
	<?php echo lang('profile.ethnicity') . ': ' . lang("profile.$ethnicity"); ?>
</p>

<p>
	<?php echo lang('profile.height') . ": $height"; ?> cm
</p>

<p>
	<?php echo lang('profile.weight') . ": $weight"; ?> kg
</p>

<p>
	<?php echo lang('profile.hair_color') . ': ' . lang("profile.$hair_color"); ?>
</p>


<p>
	<?php echo lang('profile.hair_length') . ': ' . lang("profile.$hair_length"); ?>
</p>


<p>
	<?php echo lang('profile.city') . ": $city"; ?>
</p>

<p>
	<?php echo lang('profile.telephone') . ": $telephone"; ?>
</p>

<p>
	<?php echo lang('profile.nickname') . ": $nickname"; ?>
</p>

<p>
	<?php echo lang('profile.bra_waist_hips') . ": $bra_size-$waist-$hips"; ?>
</p>

<p>
	<?php echo lang('profile.shoe_size') . ": $shoe_size"; ?>
</p>

<p>
	<?php echo lang('profile.bio') . ": $bio"; ?>
</p>
</div>

<div class="clear"></div>
