<?php
//業務委託Conf

static $PAYMENT_TYPE = array(
		0 => '銀行振込',
		1 => 'クレジットカード',

	);


//ギークス
static $GEECS = array(
		'name' => 'ギークス',
		'name_kabu' => 'ギークス株式会社',
		'kabu' => '1',		//前株：0,後株:1
		'paymentType' => 0,		//$PAYMENT_TYPE
		'paymentFor' => array(
			'name' => 'みずほ銀行',
			'shiten' => '第五集中支店',
			'kamoku' => '普通',
			'kozaNo' => '1233501',
			'kozaName' => 'ギークス株式会社'
			),
		'paymentWhen' => 1,	//0：月初,1：月末
	);





$GYOMUITAKU = array(
		0 => $GEECS,


	);

static $ITAKU_STAFF = array(
		0 => array(
			0 => array(
				'nameFull' => '樋口智昭',
				'nameSei' => '樋口',
				'nameMei' => '智昭',
				'tanka' => 650000,
			),
			1 => array(
				'nameFull' => '竹田憲太郎',
				'nameSei' => '竹田',
				'nameMei' => '憲太郎',
				'tanka' => 690000,
			),
			2 => array(
				'nameFull' => '小林博幸',
				'nameSei' => '小林',
				'nameMei' => '博幸',
				'tanka' => 680000,
			),
			3 => array(
				'nameFull' => '井田勇',
				'nameSei' => '井田',
				'nameMei' => '勇',
				'tanka' => 680000,
			),





		),

	);

static $SAGYOHOKOKUSYO_FORMAT = array(
	0 => '期間start',
	1 => '期間end',
	2 => '案件No.',
	3 => '案件名',
	4 => 'タスク内容',
	5 => '完了予定日',
	6 => '工数(h)',
	7 => '進捗率(%)',


	);

static $KENSYUSYO_FORMAT = array(
	0 => 'No.',
	1 => '内容',
	2 => '単価',
	3 => '数量',
	4 => '金額',
	5 => '備考',


	);


?>