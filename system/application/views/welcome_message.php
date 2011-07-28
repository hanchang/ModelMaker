
<div id="coin-slider">
	<a href=""><?php echo img('img/slider/1.jpg'); ?><span>Hot Girl Blurry Picture</span></a>
	<a href=""><?php echo img('img/slider/2.jpg'); ?><span>Battlestar Galactica Last Supper</span></a>
	<a href=""><?php echo img('img/slider/3.jpg'); ?><span>Grace Park's Bodacious Body</span></a>
	<a href=""><?php echo img('img/slider/4.jpg'); ?><span>Swimsuit Edition</span></a>
</div>

<div id="intro" class="border">
	<h2><?php echo lang('home.what_is') . getModelMaker() . '?'; ?></h2>
	<p><?php echo $this->content_model->getContent('cms.home.whatismodelmaker', $this->uri->segment(1, 'cn')); ?></p>
</div>

<div id="clear"></div>

<div class="bannerad border">
<?php echo $this->content_model->getContent('cms.home.middleAd', $this->uri->segment(1, 'cn'));?>
</div>

<div id="announcements" class="border">
<h2><?php echo lang('home.announcements'); ?></h2>
<?php echo $this->content_model->getContent('cms.home.announcements', $this->uri->segment(1, 'cn')); ?>
</div>

<div id="video-lessons"  class="border">
<h2><?php echo lang('home.video_lessons'); ?></h2>
<?php echo $this->content_model->getContent('cms.home.video-lessons', $this->uri->segment(1, 'cn')); ?>
</div>

<div id="clear"></div>

<div id="top-models" class="border">
<h2><?php echo lang('home.top_models'); ?></h2>
</div>

<div id="partners" class="border">
<h2><?php echo lang('home.partners'); ?></h2>
<?php echo $this->content_model->getContent('cms.home.partners', $this->uri->segment(1, 'cn')); ?>
</div>

<div id="links" class="border">
<h2><?php echo lang('home.links'); ?></h2>
<?php echo $this->content_model->getContent('cms.home.links', $this->uri->segment(1, 'cn')); ?>
</div>

<div id="clear"></div>

<div id="new-models" class="border">
<h2><?php echo lang('home.newest_models'); ?></h2>
<?php foreach ($recent_profiles as $model) { 
	if ($model->thumb_face == '') continue;
	$props = array('src' => "$model->thumb_face", 'style' => 'width: 200px; border: 1px solid #ccc; padding: 5px; margin: 10px'); 
	echo anchor("profile/view/$model->id", img($props));
} ?>
</div>

<div id="something">
</div>

<div id="events" class="border">
<h2><?php echo lang('home.events'); ?></h2>
<?php echo $this->content_model->getContent('cms.home.events', $this->uri->segment(1, 'cn')); ?>
</div>

<div id="clear"></div>

<!--  
<div id="academy" class="border">
</div>
-->
<script type="text/javascript" src="<?php echo site_url('js/coin-slider.min.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() { $('#coin-slider').coinslider({height: 400, width: 600, delay: 3000, effect: 'rain'}); });
</script>
