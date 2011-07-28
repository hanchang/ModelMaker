<h2><?php echo lang('profile.photo_error'); ?></h2>

<?php if (!empty($error)) { ?>
<div class="error rounded">
<p><?php echo lang('profile.error') . " $error"; ?></p>
<p><?php echo lang('profile.contact_try_again'); ?></p>
</div>
<?php } ?>