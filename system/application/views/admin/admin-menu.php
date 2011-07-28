<div id="admin-menu" class="border">
	<center><h2><?php echo lang('admin.admin_panel'); ?></h2></center>
	<div class="third-box">
		<h3><?php echo lang('admin.cms'); ?></h3>
		<?php echo anchor('admin/cms', lang('admin.cms'))?>
	</div>
	
	<div class="third-box">
		<h3><?php echo lang('profile.profiles'); ?></h3>
		<?php echo anchor('admin/show_unapproved', lang('admin.show_unapproved')); ?><br />
		<?php echo anchor('admin/show_approved', lang('admin.show_approved')); ?><br />
		<?php echo anchor('admin/show_rejected', lang('admin.show_rejected')); ?><br />
		<?php echo anchor('admin/show_all', lang('admin.show_all')); ?>
	</div>
	
	<div class="third-box">
		<h3><?php echo lang('case.cases')?></h3>
		<?php echo anchor('admin/add_case', lang('case.add_case')); ?><br />
		<?php echo anchor('admin/manage_cases', lang('case.manage_cases')); ?><br />
	</div>
	
	<div class="clear"></div>
</div>