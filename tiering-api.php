<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("HTTP/1.1 200 OK");

$data = json_decode(file_get_contents('php://input'), true);

$product_arr = array();


$array_data = array("amount" => 50000);

$arr_availableSpins = array(
	array(
		'status' => 3,
		'type' => 'welcome'
	),
	array(
		'level' => 1,
		'status' => 0,
		'type' => 'tier'
	),
	array(
		'level' => 2,
		'status' => 0,
		'type' => 'tier'
	)
);

$arr_booster = 	array(
	'amountAdded' => 0,
	'eligible' => false
);

$arr_mainTask = array(
	'title' => 'Treaasure Hunt Musim ke 4 berakhir',
	'info' => 'Kamu sudah mendapatkan hadiah Grand Prize',
	'type' => 3,
	'infoPosition' => 0,
	'listImage' => array(
		array(
			'image' => 'https://custinfo.smartfren.com/engine/v3/treasurehunt/images/season3End-winner.png',
			'label' => '',
			'info' => '',
		)
	),
	'tips' => array(
		'title' => '',
		'subTitle' => '',
	),
	'prizes' => array(
		'titleReward' => '',
		'rewards' => array(),
		'titleNextReward' => '',
		'infoNextReward' => '',
		'rewardsCurrentLevel' => '',
		'rewardsNextLevel' => '',
		'nextRewards' => array(),
	),
	'caption' => '',
	'captionNavigate' => ''

);
$arr_superGrandPrize = array(
	'achieve' => false,
	'treshold' => 500000,
);
$arr_task = array(
	array(
		'mode' => 'booster',
		'name' => 'veteran',
		'data' => array(
			'eligible' => true,
			'amountAdded' => 50000,
			'title' => 'WOW! Selamat!',
			'images' => array(
				"https://custinfo.smartfren.com/assembly/engine/v3/treasurehunt/images/prizes_wheels_icon.png"
			),
			'texts' => array(
				"Mobil Petualanganmu langsung melaju",
				"*50.000 Langkah*",
				"Spesial buat Kamu yang selalu setia\nbareng Smartfren."
			),
			'buttons' => array("YEAYYY!"),
		),
	)
);

$arr_tierTresholds = array(
	array(
		'level' => 1,
		'treshold' => 100000,
	),
	array(
		'level' => 2,
		'treshold' => 200000,
	),
	array(
		'level' => 3,
		'treshold' => 300000,
	),

);
$arr_veteranBooster = array(
	'amountAdded' => 0,
	'eligible' => false
);

$arr_data = array(
	'amount' => 50000,
	'availableSpins' => $arr_availableSpins,
	'booster' => $arr_booster,
	'currentLevel' => 1,
	'endOfSeason' => '2021-12-20',
	'grandPrizeEndAt' => '2021-12-30',
	'grandPrizePeriod' => true,
	'grandPrizeStartAt' => '2021-11-01',
	'hasPreseason' => false,
	'hurryUp' => false,
	'mainTask' => $arr_mainTask,
	'nextSeason' => 2,
	'physicalVoucher' => '',
	'preseason' => false,
	'preseasonEndAt' => '',
	'preseasonFunctions' => array(),
	'preseasonName' => '',
	'preseasonStartAt' => '',
	'previousAmount' => 50000,
	'previousSeasonAmount' => 0,
	'season' => 3,
	'seasonId' => 20,
	'startOfSeason' => '2021-10-01',
	'superGrandPrize' => $arr_superGrandPrize,
	'task' => $arr_task,
	'tierTresholds' => $arr_tierTresholds,
	'topupInfo' => '',
	'veteranBooster' => $arr_veteranBooster
);

$arr = array(
	'code' => 200,
	'message' => "success",
	'data' => $arr_data
);

//=== RETURN FINAL ARRAY ===
echo json_encode($arr);
