<?php require_once 'admin-menu.php'; ?>

<div class="clear"></div>

<?php chdir(dirname(__FILE__)); require_once '../flashdata.php'; ?>

<h2><?php echo lang('case.manage_cases'); ?></h2>

<!-- Add search functionality at some point. -->

<?php function displayCase($case) { ?>
	<div class="case border" style="overflow: auto; width: 928px">
		<br />
		<div class="photos" style="float: left; width: 300px; margin-right: 25px;">
			<?php echo img(array('src' => $case->photo, 'width' => '300')); ?>
		</div>
		
		<div style="float: left; width: 600px">
			<div class="fleft"><h2><?php echo $case->name; ?></h2></div>
			<div class="buttons fright">
				<button type="button" class="negative" style="display: inline" onclick='window.location.href="<?php echo site_url("admin/delete_case/$case->id"); ?>"'>
					<?php echo img('img/icons/table_delete.png') . ' ' . lang('case.delete_case'); ?></button>
				<button type="button" style="display: inline" onclick='window.location.href="<?php echo site_url("admin/edit_case/$case->id"); ?>"'>
					<?php echo img('img/icons/table_edit.png') . ' ' . lang('case.edit_case'); ?></button>
			</div>
			<div class="clear"></div>
			
			<div style="float: left; width: 200px">
				<p><strong><?php echo lang('case.information'); ?></strong></p>
				<?php 
				echo "<p>$case->client</p>\n";
				echo "<p>$case->type</p>\n";
				echo "<p>$case->location</p>\n";
				?>
			</div>
			
			<div style="float: left; width: 200px">
				<p><strong><?php echo lang('case.requirements'); ?></strong></p>
				<?php
				echo lang("profile.$case->gender_req") . br();
				echo lang('case.greater_than') . ' ' . $case->height_req . ' cm' . br();
				echo lang('case.less_than') . ' ' . $case->weight_req . ' kg' . br() . br();
				echo "0 / $case->models_needed " . lang('case.models_hired'); 
				?>
			</div>
			
			<div style="float: left; width: 200px">
				<p class="blue">
					<strong><?php echo lang('case.event_date'); ?></strong><br />
					<?php echo $case->case_date . ' ' . $case->case_time; ?>
				</p>
				<p class="yellow">
					<strong><?php echo lang('case.casting_date'); ?></strong><br />
					<?php echo $case->casting_date . ' ' . $case->casting_time; ?>
				</p>
				<p class="red">
					<strong><?php echo lang('case.apply_by'); ?></strong><br />
					<?php echo $case->application_deadline; ?>
				</p>
			</div>
			
			<div class="clear"></div>
			
			<div>
				<?php if (!empty($case->details)) { ?>
				<p><strong><?php echo lang('case.details'); ?></strong></p>
				<?php echo $case->details; } ?>
			</div>
		</div>
		
		<div class="clear"></div>
	
		<div class="inside-half-box">
		<h3><?php echo lang('case.applicants'); ?></h3>
		<?php 
		if (empty($case->applicants)) { echo lang('case.no_applicants'); }
		else {
			foreach ($case->applicants as $x) {
				echo "<div class='center fleft' style='width: 105px'>\n";
				echo anchor("profile/view/$x->user_id", img(array('src' => $x->thumb_face, 'width' => 100))) . br(); 
				echo anchor("profile/view/$x->user_id", $x->name) . br() . br();
				echo "<div class='buttons'><button class='center positive' onclick=\"window.location.href='" . 
					site_url("admin/accept_to_case/$x->user_id/$case->id") . "'\">" . 
					img('img/icons/accept.png') . ' ' . lang('case.accept') . "</button></div>\n";
				echo "</div>\n";
			} 
		} ?>
		</div>
		
		<div class="inside-half-box">
		<h3><?php echo lang('case.accepted'); ?></h3>
		<?php 
		if (empty($case->accepted)) { echo lang('case.no_accepted'); }
		else {
			foreach ($case->accepted as $y) {
				echo "<div class='center fleft' style='width: 105px'>\n";
				echo anchor("profile/view/$y->user_id", img(array('src' => $y->thumb_face, 'width' => 100))) . br(); 
				echo anchor("profile/view/$y->user_id", $y->name) . br() . br();
				echo "<div class='buttons'><button class='center negative' onclick=\"window.location.href='" . 
					site_url("admin/remove_from_case/$y->user_id/$case->id") . "'\">" . 
					img('img/icons/cancel.png') . lang('case.remove') . "</button></div>\n";
				echo "</div>\n";
			} 
		} ?>
		</div>
		
		<br style="clear:both" />
	</div>
<?php } // end displayCase() method ?>

<h3><?php echo lang('case.current_cases'); ?></h3>
<?php foreach ($current_cases as $cc) { displayCase($cc); } ?>

<h3><?php echo lang('case.past_cases'); ?></h3>
<?php foreach ($past_cases as $pc) { displayCase($pc); } ?>
