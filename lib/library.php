<?php

function redirect($redirectTo)
{
	return header('Location: '.DOMAIN.PHPD.$redirectTo.'.php');
}

function setSession($sessionKey,$value)
{
	$_SESSION[$sessionKey] = $value;
	return true;
}

function toSession($array=array(),$isError=false)
{
	if($isError && !is_array($array))
	{
		echo 'toSessionエラー!配列じゃない'; exit;
	}
	if(!is_array($array)) return false;
	foreach($array as $key => $val)
	{
		$_SESSION[$key] = $val;
	}
	return true;
}

function removeSession($sessionKey=null)
{
	if(is_null($sessionKey))
	{
		unset($_SESSION);
	}
	if(strlen(@$sessionKey) && isset($_SESSION[$sessionKey]))
	{
		unset($_SESSION[$sessionKey]);
	}
	return true;
}

function isSession($sessionKey,$empty=true)
{
	$return = false;
	if(isset($_SESSION[$sessionKey])) $return = true;
	if(!strlen(@$_SESSION[$sessionKey])) $return = false;
	return $return;
}

function getSession($sessionKey)
{
	$return = '';
	if(isSession($sessionKey)) $return = $_SESSION[$sessionKey];
	return $return;
}

function getErrorMsg($errorSessionKey,$withHtmlTag = true)
{
	$return = '';
	if(isSession($errorSessionKey.ERROR)) $return = getSession($errorSessionKey.ERROR);
	if($withHtmlTag && isSession($errorSessionKey.ERROR)) $return = '<span class="'.ERROR_MSG_CLASS.'">'.$return.'</span><br />';
	return $return;
}

function setErrorMsg($errorSessionKey,$value)
{
	setSession($errorSessionKey.ERROR,$value);
	return true;
}


//ViewFunction

function getCssTag($cssFileName)
{
	return '<link type="text/css" rel="stylesheet" href="'.CSS_DIR.$cssFileName.'.css?'.date("YmdHis").'" />';
}

function getJsTag($jsFileName)
{
	return '<script type="text/javascript" src="'.JS_DIR.$jsFileName.'.js?'.date("YmdHis").'" /></script>';
}

function getTitleTag($title)
{
	return '<title>'.$title.'</title>';
}

function makeGyomuItakuStaff($selectBoxName='gyomuitakuStaff',$element='')
{
	require('../conf/confArrays.php');
	$return = '<select name="'.$selectBoxName.'" class="gyomuitakuStaff" '.$element.' >';
	foreach($GYOMUITAKU as $companyId => $companyInfo)
	{
		if(!isset($ITAKU_STAFF[$companyId])) continue;
		$return .= '<optgroup label="'.$companyInfo['name_kabu'].'" class="company company'.$companyId.'">';
		foreach($ITAKU_STAFF[$companyId] as $staffId => $staffInfo)
		{
			$selected = '';
			if(getSession($selectBoxName) == $companyId.'_'.$staffId) $selected = 'selected';
			$return .= '<option value="'.$companyId.'_'.$staffId.'" class="staff staff'.$staffId.'" '.$selected.' >'.$staffInfo['nameFull'].'</option>';
		}
		$return .= '</optgoup>';
	}
	$return .= '</select><br />';
	return $return;
}


?>