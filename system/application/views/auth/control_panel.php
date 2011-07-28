<link href="<?php echo site_url('css/pika.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo site_url('js/jquery.pikachoose.full.js'); ?>"></script>
<script language="javascript">
	$(document).ready(function (){
		$("#photogallery").pikachoose({showCaption:false, showTooltips:false, autoPlay:false, carousel:true, text: {previous: "", next: ""}});
	});
</script>

<?php chdir(dirname(__FILE__)); require_once '../flashdata.php'; ?>

<h2><?php echo lang('auth.welcome') . ', ' . $this->tank_auth->get_username(); ?>!</h2>

<div id="profile" class="border">
<h3><?php echo lang('auth.my_profile'); ?></h3>

<?php if ($create) { ?>
<div class="buttons" style="text-align: center;">
	<?php echo lang('profile.not_yet'); ?>
	<button type="button" onclick='window.location.href="<?php echo site_url('profile/edit'); ?>"'>
		<?php echo img('img/icons/group_add.png') . ' ' . lang('profile.create'); ?>
	</button>
</div>
<?php } else { ?>
<div id="photos" style="float: left">
<?php if ($photos) { ?>
<ul id="photogallery">
	<li><img src="<?php echo site_url("img/uploads/$profile->pic_face"); ?>" style="width: 150px" /></li>
	<li><img src="<?php echo site_url("img/uploads/$profile->pic_upper"); ?>" style="width: 150px" /></li>
	<li><img src="<?php echo site_url("img/uploads/$profile->pic_full"); ?>" style="width: 150px" /></li>
</ul>
<?php } else { ?>
<div class="buttons" style="text-align: center;">
	<?php echo lang('profile.not_yet_photos'); ?>
	<button type="button" onclick='window.location.href="<?php echo site_url('profile/manage_pic'); ?>"'>
		<?php echo img('img/icons/photos.png') . ' ' . lang('profile.manage_pic'); ?>
	</button>
</div>
<?php } ?>
</div>

<div id="contact" style="float: left; width: 220px">
<h4><?php echo $profile->name; ?></h4>
<p><?php echo $user->username; ?></p>
<p><?php echo $profile->city; ?></p>
<p><?php echo $profile->telephone; ?></p>

<p><?php echo mailto($user->email, $user->email); ?></p>
</div>

<div id="stats" style="float: left; width: 170px">
<p><?php echo $profile->birthday; ?></p>
<p>
<?php 
echo lang("profile.$profile->ethnicity") . br();
echo lang("profile.$profile->hair_length") . ' ' . lang("profile.$profile->hair_color") . ' ' .  lang('profile.hair') . br();
echo lang("profile.$profile->gender"); 
if ($profile->gender == 'female') {
	echo "($profile->bra_size-$profile->waist-$profile->hips)"; 
} ?>
</p>
<p><?php echo "$profile->height cm, $profile->weight kg"; ?></p>
</div>

<div id="controls" style="float: left; width: 280px">
	<h3>
	<?php 
	if ($profile->approved == 1) { echo "<span class='green'>" . lang('profile.approved') . "</span>\n"; }
	else if ($profile->approved == 0) { echo "<span class='purple'>" . lang('profile.under_review') . "</span>\n"; }
	else { echo "<span class='red'>" . lang('profile.rejected') . "</span>\n"; }
	?>
	</h3>
	
	<div class="buttons">
		<button type="button" onclick='window.location.href="<?php echo site_url('auth/change_email'); ?>"'>
			<?php echo img('img/icons/email_edit.png') . ' ' . lang('auth.change_email'); ?></button><br />
		<button type="button" onclick='window.location.href="<?php echo site_url('auth/change_password'); ?>"'>
			<?php echo img('img/icons/key.png') . ' ' . lang('auth.change_password'); ?></button><br />
		<button type="button" onclick='window.location.href="<?php echo site_url('profile/edit'); ?>"'>
			<?php echo img('img/icons/vcard_edit.png') . ' ' . lang('profile.edit'); ?></button><br />
		<button type="button" onclick="window.location.href='<?php echo site_url('profile/manage_pic'); ?>'">
			<?php echo img('img/icons/photos.png') . ' ' . lang('profile.manage_photos'); ?></button>
	</div>
</div>
<?php } // end if create ?>
<br class="clear" />
</div>

<?php if ($profile->approved == 1) { ?>
<h2><?php echo lang('auth.upcoming_cases'); ?></h2>
<div id="upcoming-cases">
<?php 
if (empty($upcoming_cases)) { 
	echo lang('case.no_upcoming'); 
}
else {
	$this->load->view('cases/case-template.php');
} 
?>
</div>

<div id="my-cases" class="half-box border" style="margin-right: 15px">
<h3><?php echo lang('auth.applied_cases'); ?></h3>
<?php 
if (empty($my_cases)) { 
	echo lang('case.you_have_no_applications'); 
}
else { ?>
<table width="100%">
	<tr>
		<th><?php echo lang('case.name'); ?></th>
		<th><?php echo lang('case.casting_date'); ?></th>
		<th><?php echo lang('case.casting_time'); ?></th>
		<th><?php echo lang('case.location'); ?></th>
		<th><?php echo lang('case.payrate'); ?></th>
	</tr>
	<?php foreach ($my_cases as $mc) { ?>
	<tr>
		<td><?php echo anchor(site_url("cases/view/$mc->case_id"), $mc->name); ?></td>
		<td><?php echo $mc->casting_date; ?></td>
		<td><?php echo $mc->casting_time; ?></td>
		<td><?php echo $mc->location; ?></td>
		<td><?php echo $mc->payrate; ?></td>
	</tr>
	<?php } // end foreach ?>
</table>
<?php } // end else ?>
</div>

<div id="accepted-cases" class="half-box border">
<h3><?php echo lang('auth.accepted_cases'); ?></h3>
<?php 
if (empty($accepted_cases)) { 
	echo lang('case.you_have_no_accepted'); 
}
else { ?>
	<table width="100%">
	<tr>
		<th><?php echo lang('case.name'); ?></th>
		<th><?php echo lang('case.case_date'); ?></th>
		<th><?php echo lang('case.case_time'); ?></th>
		<th><?php echo lang('case.location'); ?></th>
		<th><?php echo lang('case.payrate'); ?></th>
	</tr>
	<?php foreach ($accepted_cases as $ac) { ?>
	<tr>
		<td><?php echo anchor(site_url("cases/view/$ac->case_id"), $ac->name); ?></td>
		<td><?php echo $ac->case_date; ?></td>
		<td><?php echo $ac->case_time; ?></td>
		<td><?php echo $ac->location; ?></td>
		<td><?php echo $ac->payrate; ?></td>
	</tr>
	<?php } // end foreach ?>
</table>
<?php } // end else ?>
</div>
<?php } // if profile approved ?>
<div class="clear"></div>
