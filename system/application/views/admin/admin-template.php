<?php require_once 'admin-menu.php'; ?>

<div class="two-thirds-box">
<h2><?php echo $title; ?></h2>
<?php 
if (empty($list)) {
	if ($admin_page == 'all') echo lang('admin.no_profiles');
	if ($admin_page == 'unapproved') echo lang('admin.no_unapproved');
	if ($admin_page == 'approved') echo lang('admin.no_approved');
	if ($admin_page == 'rejected') echo lang('admin.no_rejected');
} 
else { 
?>
<table id="search-results">
	<tr>
		<th colspan="2"><?php echo lang('profile.name'); ?></th>
		<th><?php echo lang('profile.gender'); ?></th>
		<th><?php echo lang('profile.ethnicity'); ?></th>
		<th><?php echo lang('profile.height'); ?></th>
		<th><?php echo lang('profile.weight'); ?></th>
	</tr>
	<tr>
		<th width="28%" colspan="2"><?php echo lang('profile.pic_face'); ?></th>
		<th width="28%" colspan="2"><?php echo lang('profile.pic_upper'); ?></th>
		<th width="28%" colspan="2"><?php echo lang('profile.pic_full'); ?></th>
	</tr>
<?php foreach($list as $l) { ?>
	<tr>
		<td colspan="2"><?php echo anchor("profile/view/$l->id", $l->name); ?></td>
		<td><?php echo lang("profile.$l->gender"); ?></td>
		<td><?php echo lang("profile.$l->ethnicity"); ?></td>
		<td><?php echo $l->height; ?> cm</td>
		<td><?php echo $l->weight; ?> kg</td>
		<!-- 
		<td><?php echo lang("profile.$l->hair_color"); ?></td>
		<td><?php echo lang("profile.$l->hair_length"); ?></td>
		-->
	</tr>
	<tr>
		<td colspan="2"><?php $face = array('src' => "img/uploads/$l->pic_face", 'style' => 'max-width: 200px'); echo img($face); ?></td>
		<td colspan="2"><?php $upper = array('src' => "img/uploads/$l->pic_upper", 'style' => 'max-width: 200px'); echo img($upper); ?></td>
		<td colspan="2"><?php $full = array('src' => "img/uploads/$l->pic_full", 'style' => 'max-width: 200px'); echo img($full); ?></td>
	</tr>
	<?php if ($admin_page != 'all') { ?>
	<tr>
		<td colspan="2">
		<p class="fleft">
		<?php 
			if ($l->approved == 0) echo lang('admin.unapproved'); 
			if ($l->approved == 1) echo lang('admin.approved'); 
			if ($l->approved == -1) { echo lang('admin.rejected');
		?>
		</p>
		<div class="buttons fright" style="vertical-align: middle">
		<button type="button" onclick='window.location.href="mailto:<?php echo $l->email; ?>"'>
			<?php echo img('img/icons/email.png') . ' ' . lang('admin.contact_user'); ?>
		</button>
		</div>
		<?php }	?>
		</td>
		<?php if ($admin_page == 'unapproved' || $admin_page == 'rejected') { ?>
		<td colspan="2">
		<div class="buttons">
		<button type="button" class="positive" onclick='window.location.href="<?php echo site_url("admin/approve/$l->id"); ?>"'>
			<?php echo img('img/icons/accept.png') . ' ' . lang('admin.approve') ?>
		</button>
		</div>
		</td>
		<?php } if ($admin_page == 'approved' || $admin_page == 'rejected') { ?>
		<td colspan="2">
		<div class="buttons">
		<button type="button" onclick='window.location.href="<?php echo site_url("admin/unapprove/$l->id"); ?>"'>
			<?php echo img('img/icons/help.png') . ' ' . lang('admin.unapprove'); ?>
		</button>
		</div>
		</td>
		<?php } if ($admin_page == 'unapproved' || $admin_page == 'approved') { ?>
		<td colspan="2">
		<div class="buttons">
		<button type="button" class="negative" onclick='window.location.href="<?php echo site_url("admin/reject/$l->id"); ?>"'>
			<?php echo img('img/icons/cancel.png') . ' ' . lang('admin.reject'); ?>
		</button>
		</div>
		</td>
		<?php } if ($admin_page == 'rejected') { ?>
		
		<?php } ?>
	</tr>
<?php }}} ?>
</table>
</div>