<?php
/**
* WORK SMART
*/
?>

<?php
if((int)sfConfig::get('app_ldap_default_user_group')==0)
{
  echo __('Default users group for LDAP users is not setup. LDAP login is not allowed.');
}
else
{
?>

<form class="login-form" name="LdapLoginForm" id="LdapLoginForm" onSubmit="return validateForm(this.id, '<?php echo url_for('home/validateForm',true); ?>')" action="<?php echo url_for('login/ldap',true) ?>" method="POST">
<?php echo $form->renderHiddenFields(false) ?>
<?php echo $form->renderGlobalErrors() ?>
<input type="hidden" name="formName" value="LdapLoginForm" />

<h3><?php echo __('LDAP Login') ?></h3>
<p>&nbsp;</p>

<?php if($sf_user->hasFlash('userNotices')) include_partial('global/userNotices', array('userNotices' => $sf_user->getFlash('userNotices'))); ?>

<div class="form-group">
  <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
  <label class="control-label visible-ie8 visible-ie9"><?php echo $form['user']->renderLabelName() ?></label>
  <div class="input-icon">
  	<i class="fa fa-user"></i>
  	<input class="form-control placeholder-no-fix required" type="text" autocomplete="off" placeholder="<?php echo $form['user']->renderLabelName() ?>" name="ldaplogin[user]"/>
  </div>
</div>

<div class="form-group">
	<label class="control-label visible-ie8 visible-ie9"><?php echo $form['password']->renderLabelName() ?></label>
	<div class="input-icon">
		<i class="fa fa-lock"></i>
		<input class="form-control placeholder-no-fix required" type="password" autocomplete="off" placeholder="<?php echo $form['password']->renderLabelName() ?>" name="ldaplogin[password]"/>
	</div>
</div>

<div class="form-actions">
	<button type="button" id="back-btn" class="btn btn-default" onClick="location.href='<?php echo url_for('login/index')?>'"><i class="fa fa-arrow-circle-left"></i> </button>
	<button type="submit" class="btn btn-info pull-right"><?php echo __('Login') ?> </button>
</div>

</form>

<?php include_partial('global/formValidator',array('form_id'=>'LdapLoginForm')); ?>

<?php } ?>
