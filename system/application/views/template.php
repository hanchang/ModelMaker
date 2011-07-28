<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <title><?=lang('title');?> - modelmaker</title>
	<script type="text/javascript" src="<?php echo site_url('js/jquery-1.4.4.min.js'); ?>"></script>
	<link href="<?php echo site_url('css/style.css'); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="bannerad border">
	<?php echo $this->content_model->getContent('cms.home.topAd', $this->uri->segment(1, 'cn'));?>
</div>

<div id="logo">
	<h1 class="logo"><?php printModelMaker(); ?></h1>

<?php 
	$url = '';
	$originalUrl = $this->uri->segment_array();
	$flag = true;
	foreach ($originalUrl as $segment) {
		if ($flag) { $flag = false; continue; }
		$url .= "$segment/";	
	}
?>
	<div id="auth">
		<?php echo anchor("en/$url", img('img/lang/us.gif') . ' English', 'class="lang"'); ?> /
		<?php echo anchor("cn/$url", img('img/lang/cn.gif') . ' 中文', 'class="lang"'); //简体 ?>
		<?php // echo anchor("tw/$url", img('img/lang/tw.gif') . ' 繁體中文', 'class="lang"'); ?><br />
<?php 
	$username = $this->tank_auth->get_username();
	if ($username === FALSE) {
		echo anchor('auth/login', lang('global.login'));
		echo ' | ';
		echo anchor('auth/register', lang('global.register'));
	} else {
		if ($this->tank_auth->is_logged_in()) {
			echo lang('global.welcome') . ', ' . anchor('auth/cp', $username) . '! | '; 
			if ($this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
				echo anchor('admin', lang('global.admin')) . ' | ';
			}
			echo anchor('auth/logout', lang('global.logout'));
		}
		else {
			echo anchor('auth/login', lang('global.login'));
			echo ' | ';
			echo anchor('auth/register', lang('global.register'));
		}
	}
?>
	</div>
</div>

<div id="clear"></div>

<table class="rounded border" id="menu" width="100%">
	<tr id="links">
		<td><?php echo anchor('welcome', lang('global.home'), 'class="links"');?></td>
		<td><?php echo anchor('models', lang('global.models'), 'class="links"');?></td>
		<td><?php echo anchor('fashion', lang('global.fashion'), 'class="links"');?></td>
		<td><?php echo anchor('portfolio', lang('global.portfolio'), 'class="links"');?></td>
		<td><?php echo anchor('cases', lang('global.cases'), 'class="links"');?></td>
		<td><?php echo anchor('blog', lang('global.blog'), 'class="links"'); ?></td>
	</tr>
</table>

<div id="clear"></div>

<div id="content">
<?php require_once 'flashdata.php'; ?>
<?php echo $contents; ?>
</div>

<div id="footer">
<?php 
	echo anchor('contact', lang('global.contact')) . ' | ' . 
		anchor('about', lang('global.about')) . ' | ' .
		anchor('terms', lang('global.terms')) . ' | ' .
		anchor('privacy', lang('global.privacy'));
?>
</div>

</body>
</html>
