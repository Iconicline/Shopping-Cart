<h1><?php echo t('step_7'); ?></h1>

<p>
	<?php echo t('config_1'); ?><br />
	<b><?php echo $path; ?>config.php</b><br />
	<b><?php echo $path; ?>.htaccess</b><br />
</p>
<p><?php echo t('config_2'); ?></p>
<p><?php echo t('config_3'); ?></p>

<form id="step-form"></form>

<div class="buttons">
    <input class="button button-rounded button-flat-action" type="button" name="next" id="btn-next" value="<?php echo t('next'); ?>" onclick="submitStep()" />
</div>