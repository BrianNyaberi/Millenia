<?php
/**
* WORK SMART
*/
?>
<div class="infoBlock"><h1>Checking environment...</h1></div>
<?php

$error = false;

echo '<div class="error_text">';

if(!version_compare(phpversion(), '5.2.4', '>='))
{ 
  echo "ERROR: requires PHP >= 5.2.4', 'Current version is " .phpversion() . '<br>';
  $error = true;
}

if(ini_get('zend.ze1_compatibility_mode'))
{
  echo "ERROR: php.ini - requires zend.ze1_compatibility_mode set to off" . '<br>';
  $error = true;
}


if(ini_get('arg_separator.output')!='&')
{ 
  echo "ERROR: php.ini - requires arg_separator.output set to &" . '<br>';
  $error = true;
}

if((int)ini_get('memory_limit')<32)
{
  echo  "ERROR  php.ini - requires memory_limit 32M or more" . '<br>';
  $error = true;
}

if(!class_exists('PDO'))
{ 
  echo "ERROR: Install PDO and PDO driver: mysql" . '<br>';
  $error = true;
}
else
{
  $drivers = PDO::getAvailableDrivers();
  if(!in_array('mysql',$drivers))
  {
    echo "ERROR: Install PDO driver: mysql" . '<br>';
    $error = true;
  }
}  

if(!class_exists('DomDocument'))
{
  echo "ERROR: Install the php-xml module" . '<br>';
  $error = true;
}

if(!is_writable('../core/cache'))
{
  echo "ERROR: folder 'core/cache' is not writable" . '<br>';
  $error = true;
}

if(!is_writable('../core/config'))
{
  echo "ERROR: folder 'core/config' is not writable" . '<br>';
  $error = true;
}

if(!is_writable('../core/log'))
{
  echo "ERROR: folder 'core/log' is not writable" . '<br>';
  $error = true;
}

if(!is_writable('../uploads/attachments'))
{
  echo "ERROR: folder 'uploads/attachments' is not writable" . '<br>';
  $error = true;
}

if(!is_writable('../uploads/users'))
{
  echo "ERROR: folder 'uploads/users' is not writable" . '<br>';
  $error = true;
}

echo '</div>';

if(!$error)
{
  echo '<br><div>Environment checked. No errors found. You can install qdPM.</div>';
  echo '<br><div><input type="button" value="Database Config"  class="btn" onClick="location.href=\'index.php?step=database_config\'"></div>';
}
else
{
  echo '<div>Please check all of the lines above when reporting installation problems.</div>';
  echo '<br><div><input type="button" value="Checking environment"  class="btn"  onClick="location.href=\'index.php\'"></div>';
}
