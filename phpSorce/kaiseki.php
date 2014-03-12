<?php
require_once('../conf/conf.php');

$returns = array();

$excelFormat = $SAGYOHOKOKUSYO_FORMAT;
$excelFormat2 = $KENSYUSYO_FORMAT;
toSession(@$_POST);

if(!isset($_POST) && !is_array($_POST))
{
	return redirect('input_sagyoHokokusyo');
}

for($postCount=0;isset($_POST['gyomuitakuStaff_'.$postCount])>false;$postCount++)
{

	//会社情報・業務委託スタッフ情報
	$gyomuitakuStaff = $_POST['gyomuitakuStaff_'.$postCount];
	$staffIds = explode('_',$gyomuitakuStaff);

	$companyInfo = $GYOMUITAKU[$staffIds[0]];
	$staffInfo = $ITAKU_STAFF[$staffIds[0]][$staffIds[1]];
	$returns[$postCount]['staffInfo'] = $staffInfo;
	$returns[$postCount]['companyInfo'] = $companyInfo;

	//POST値(tsv)ParsingStart!
	$sagyohokokuCopy = $_POST['sagyohokokuCopy_'.$postCount];
	$kugiri = '|||||';

	$hokokuStr = str_replace('	',$kugiri,$sagyohokokuCopy);
	$parsePart = explode($kugiri,$hokokuStr);
	foreach($parsePart as $partKey => $partVal)
	{
		if($partKey !=0 && $partKey % (count($excelFormat)-1) == 0)
		{
			$parsePart[$partKey] = str_replace('<br />',',',str_replace(array("\r\n","\r","\n"), '',nl2br($partVal)));
		}
	}
	$parsePart2 = implode(',',$parsePart);
	$parse = explode(',',$parsePart2);
	$parsed = array();

	if(count($parse) <= 2)
	{
		setErrorMsg('sagyohokokuCopy','※EXCELからコピーしたものを送信してください。');
		return redirect('input_sagyoHokokusyo');
	}

	$count = 0;
	$countRow = 0;
	foreach($parse as $cellCount => $val)
	{
		if($count == 4) $val = str_replace('"', '', $val);
		if($count == 6) $val = str_replace('h', '', $val);
		if($count == 7) $val = str_replace('％','',str_replace('%', '', $val));
		$parsed[$countRow][$count] = $val;
		$parsed[$countRow][$excelFormat[$count]] = $val;
		$count++;
		if($count >= count($excelFormat))
		{
			$countRow++;
			$count = 0;
		}
	}
	$returns[$postCount]['parsedData'] = $parsed;
	//POST値(tsv)ParsingEnd!

	//print_r($parsed); exit;

	//外注稼働レポート生成変数
	$sagyoStart = '';
	$sagyoEnd = '';
	$sagyoKosu = 0;
	$sagyoNaiyo = array();

	//検収書生成変数
	$kensyuSyo = array();

	foreach($parsed as $key => $val)
	{
		//外注稼働レポート
		//[作業期間]
		$sagyoStart = (!strlen($sagyoStart) || strtotime($sagyoStart) >= strtotime($val[0]))? $val[0]:$sagyoStart;
		$sagyoEnd = (!strlen($sagyoEnd) || strtotime($sagyoEnd) <= strtotime($val[1]))? $val[1]:$sagyoEnd;
		$sagyoKosu += (isset($val[6]))? str_replace('h','',$val[6]):0;
		//[作業内容]
		if(!isset($sagyoNaiyo[$val[2]]) && strlen(@$val[2])) $sagyoNaiyo[$val[2]] = $val[3];

		//検収書
		if(strlen(@$val[2]))
		{
			if(!isset($kensyuSyo[$val[2]]['kosu'])) $kensyuSyo[$val[2]]['kosu'] = 0;
			$kensyuSyo[$val[2]]['kosu'] += $val[6];
			$kensyuSyo[$val[2]]['name'] = $val[3];
			if(!isset($kensyuSyo[$val[2]]['task']) || !is_array($kensyuSyo[$val[2]]['task']) || !in_array($val[4],$kensyuSyo[$val[2]]['task']))
			{
				$kensyuSyo[$val[2]]['task'][] = $val[4];
				$kensyuSyo[$val[2]]['shintyoku'][] = $val[7];
			}
		}

	}
	$returns[$postCount]['kensyuSyo'] = $kensyuSyo;
	$returns[$postCount]['hourTanka'] = floor($staffInfo['tanka']/$sagyoKosu);
	//echo $return['hourTanka']; exit;
	$returns[$postCount]['sagyoStart'] = date('n/j',strtotime($sagyoStart));
	$returns[$postCount]['sagyoEnd'] = date('n/j',strtotime($sagyoEnd));
	$returns[$postCount]['sagyoKosuH'] = $sagyoKosu.'h';
	$returns[$postCount]['sagyoKosu'] = $sagyoKosu;
	$returns[$postCount]['sagyoNaiyo'] = $sagyoNaiyo;
}


return require_once(RETTEMP);
?>
