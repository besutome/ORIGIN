<html>
<head>
<?php echo getCssTag('common'); ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<?php echo getJsTag('kaiseki'); ?>
<?php echo getTitleTag('山Pの傑作 - 作業報告書Parse'); ?>
</head>
<body>
<div class="fullBlack"></div>
<div class="main">
<div id="staffTab">
<ul class="tab clear">
<li class="none"><a href="#" class="allTab" ><div class="companyName">　</div>すべて表示</a></li>
<?php foreach($returns as $returnNo => $return): ?>
	<li><a href="#" class="datas<?php echo $returnNo; ?>"><div class="companyName"><?php echo $return['companyInfo']['name']; ?></div><?php echo $return['staffInfo']['nameFull']; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<div id="data">
<div id="kadoReportAll">
<span class="close">☓</span>
◎外注稼働レポート(一括表示)：<br /><br />
<?php foreach($returns as $returnNo => $return): ?>
■<?php echo $return['companyInfo']['name']; ?>(<?php echo $return['staffInfo']['nameSei']; ?>さん)<br />
[作業期間]<br />
・<?php echo $return['sagyoStart']; ?>-<?php echo $return['sagyoEnd']; ?><br />
・<?php echo $return['sagyoKosuH']; ?><br />
[作業内容]<br />
・<?php echo implode('<br />・',$return['sagyoNaiyo']); ?><br /><br />
<?php endforeach; ?>
</div>
<br />
<a href="#" class="gaityuReportSwitch">外注レポート一括表示</a>
<?php foreach($returns as $returnNo => $return): ?>
<div id="datas<?php echo $returnNo; ?>" class="datas">
<div id="staffInfo<?php echo $returnNo; ?>" class="staffInfo">
◎エンジニアInfo：<br />
&nbsp;&nbsp;名前　　：<?php echo $return['staffInfo']['nameSei']; ?>&nbsp;<?php echo $return['staffInfo']['nameMei']; ?><br />
&nbsp;&nbsp;契約単価：¥<?php echo number_format($return['staffInfo']['tanka']); ?>&nbsp;/&nbsp;月<br />
</div>
<br />
<a href="#parseInfo<?php echo $returnNo; ?>">@作業報告書Parse内容確認</a>&nbsp;&nbsp;
<a href="#gaityuKadoReport<?php echo $returnNo; ?>">@外注稼働レポート</a>&nbsp;&nbsp;
<a href="#kensyuSyo<?php echo $returnNo; ?>">@検収書</a>&nbsp;&nbsp;
<br />
<br />
<div id="gaityuKadoReport<?php echo $returnNo; ?>">
◎外注稼働レポート(週末用)：----------------------------------------------------------------------------------------<br /><br />

■<?php echo $return['companyInfo']['name']; ?>(<?php echo $return['staffInfo']['nameSei']; ?>さん)<br />
[作業期間]<br />
・<?php echo $return['sagyoStart']; ?>-<?php echo $return['sagyoEnd']; ?><br />
・<?php echo $return['sagyoKosuH']; ?><br />
[作業内容]<br />
・<?php echo implode('<br />・',$return['sagyoNaiyo']); ?><br />


<br />
------------------------------------------------------------------------------------------------------------------------------
</div>
<br />
<br />
<br />
<div id="kensyuSyo<?php echo $returnNo; ?>">
◎検収書(月末用)：------------------------------------------------------------------------------------------------------<br />
<br />
<br />
<table class="kensyuSyoTable">
<tr>
	<?php foreach($excelFormat2 as $val): ?>
		<th><?php echo $val; ?></th>
	<?php endforeach; ?>
</tr>
<?php $seq = 1; ?>
<?php $kingakuGokei = 0; ?>
<?php foreach($return['kensyuSyo'] as $key => $vals): ?>
<tr>
	<td>
		<?php echo $seq; ?>
	</td>
	<td>
		<?php echo $vals['name']; ?><br />
		<?php foreach($vals['task'] as $key3 => $val3): ?>
			-<?php echo $val3; ?>(<?php echo $vals['shintyoku'][$key3]; ?>%)<br />
		<?php endforeach; ?>
	</td>
	<td>
		<?php $kingaku = ($vals['kosu'] != $return['sagyoKosu'])? $vals['kosu']*$return['hourTanka']:$staffInfo['tanka']; ?>
		<?php echo number_format($kingaku); ?>
	</td>
	<td>
		1
	</td>
	<td>
		<?php echo number_format($kingaku); ?>
	</td>
	<td>
		<?php echo $return['staffInfo']['nameFull']; ?>さんの作業内容
	</td>
</tr>
<?php $seq++; ?>
<?php $kingakuGokei += $kingaku; ?>
<?php endforeach; ?>
</table>
<br />
<div class="kensyuSyoKigakuGokei <?php if($kingakuGokei != $staffInfo['tanka']) echo 'errorMsg' ?>">
	<u>合計¥<?php echo number_format($kingakuGokei); ?></u>
<?php if($kingakuGokei != $staffInfo['tanka']): ?>
	<br />※工数(h)から算出した単価合計がエンジニア月単価と合いません。<br />手動でご調整ください。
<?php endif; ?>
</div>
<br />
------------------------------------------------------------------------------------------------------------------------------
</div>
<br />
<br />
<br />
<br />
<br />
<br />
※Parseした作業報告書(EXCELシートと照らしあわせてください)<br />
<table class="sagyohokokusyoTable" id="parseInfo<?php echo $returnNo; ?>">
<tr>
	<?php foreach($excelFormat as $val): ?>
		<th><?php echo $val; ?></th>
	<?php endforeach; ?>
</tr>
<?php foreach($return['parsedData'] as $key => $vals): ?>
	<tr>
	<?php foreach($vals as $key2 => $val): ?>
		<?php if(!is_numeric($key2)) continue; ?>
		<td><?php echo ($key2 != 4)? $val:nl2br($val); ?></td>
	<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
<br />
</div>
<?php endforeach; ?>
<br />
</div>
<a href="input_sagyoHokokusyo.php?sessionKill=1">戻る(セッションクリア)</a>
</div>
</body>
</html>
