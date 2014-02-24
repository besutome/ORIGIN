<?php
require_once('../conf/conf.php');	

if(isset($_GET['sessionKill']) && $_GET['sessionKill'] == 1) removeSession();
if(!isSession('sagyohokokuCopy_0')) setSession('sagyohokokuCopy_0',' ');






return require_once(RETTEMP);
?>