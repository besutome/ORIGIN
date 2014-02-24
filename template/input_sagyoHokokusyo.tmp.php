<html>
<head>
<meta http-equiv="Content-Style-Type" content="text/css; charset=utf-8" />
<?php echo getCssTag('common'); ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<?php echo getJsTag('input'); ?>
<?php echo getTitleTag('山Pの傑作 - 作業報告書コピペ'); ?>
</head>
<body>
<form action="kaiseki.php" method="post">
★作業報告書をコピペしてください<br />
<?php for($i=0;isSession('sagyohokokuCopy_'.$i)>false;$i++): ?>
<div class="cloneArea_<?php echo $i; ?>">
<textarea name="sagyohokokuCopy_<?php echo $i; ?>" class="sagyohokokuCopy_<?php echo $i; ?>" <?php if(isSession('sagyohokokuCopy_'.$i) && getSession('sagyohokokuCopy_'.$i) != ' '): ?>style="width:100px;height:30px;"<?php endif; ?> >
<?php if(isSession('sagyohokokuCopy_'.$i) && getSession('sagyohokokuCopy_'.$i) != ' ') echo getSession('sagyohokokuCopy_'.$i); ?>
</textarea>
<br />
<?php echo getErrorMsg('sagyohokokuCopy_'.$i); ?>
<?php $element=' size="5" '; ?>
<?php if(isSession('sagyohokokuCopy_'.$i) && getSession('sagyohokokuCopy_'.$i) != ' ') $element .= 'style="width:100px;height:11px;font-size:11px;"'; ?>
<span class="sagyosyaText">作業者：<br /></span><?php echo makeGyomuItakuStaff('gyomuitakuStaff_'.$i,$element); ?>
<br />
</div>
<?php endfor; ?>
<input type="button" class="plus" rel="<?php echo --$i; ?>" value="＋" title="報告書追加" />
<br />
<br />
<br />
<input type="submit" value="送信" class="submitSoshin" />
</form>
</body>
</html>
<?php removeSession(); ?>