<?php
	error_reporting(error_reporting() & ~E_NOTICE);
	$config = include('../config.php');

	$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die(mysqli_error($mysqli));
	$df = 0;
	$delegate = $config['delegate_address'];
	$lisk_host = $config['lisk_host'];
	$lisk_port = $config['lisk_port'];
	$pool_fee = floatval(str_replace('%', '', $config['pool_fee']));
	$pool_fee_payout_address = $config['pool_fee_payout_address'];

while(1) {
	$df++;
	echo "\n";echo $df.":Checking last forged block...\n";
	//Retrive Public Key
	$ch1 = curl_init('http://'.$lisk_host.':'.$lisk_port.'/api/accounts?address='.$delegate);                                                                      
	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");                                                                                      
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);     
	$result1 = curl_exec($ch1);
	$publicKey_json = json_decode($result1, true); 
	$publicKey = $publicKey_json['account']['publicKey'];
	//Retrive last forged block
	$ch1 = curl_init('http://'.$lisk_host.':'.$lisk_port.'/api/blocks/?generatorPublicKey='.$publicKey.'&limit=1&offset=0&orderBy=height:desc');
	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");                                                                                      
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);     
	$result1 = curl_exec($ch1);
	$forged_block_json = json_decode($result1, true); 
	$forged_block = $forged_block_json['blocks'][0]['height'];
	$forged_block_revenue = $forged_block_json['blocks'][0]['reward'];

	$task = "INSERT INTO blocks (blockid) SELECT * FROM (SELECT '$forged_block') AS tmp WHERE NOT EXISTS (SELECT * FROM blocks WHERE blockid = '$forged_block' LIMIT 1)";
	$query = mysqli_query($mysqli,$task) or die(mysqli_error($mysqli));
	$affected = $mysqli -> affected_rows;

	if ($forged_block_revenue == 0) {
		$affected = 0;
	}

	if ($affected == 1) {
		echo "\nForged block at height:".$forged_block;
		//Retrive current voters
		$ch1 = curl_init('http://'.$lisk_host.':'.$lisk_port.'/api/delegates/voters?publicKey='.$publicKey);
		curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");                                                                                      
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);     
		$result1 = curl_exec($ch1);
		$voters = json_decode($result1, true); 
		$voters_array = $voters['accounts'];
		echo "\nCurrent Voters:";
		$total_voters_power = 0;
		foreach ($voters_array as $key => $value) {
			//Count total power of users and add them to miners table if not added before
			$address = $value['address'];
			$balance = $value['balance'];
			$total_voters_power = $total_voters_power + $balance;
			$task = "INSERT INTO miners (address,balance) SELECT * FROM (SELECT '$address','0') AS tmp WHERE NOT EXISTS (SELECT * FROM miners WHERE address = '$address' LIMIT 1)";
			$query = mysqli_query($mysqli,$task) or die(mysqli_error($mysqli));
		}
		echo "\nTotal Power -> ".$total_voters_power;

		//Split forging reward
		echo "\nMined block worth -> ".$forged_block_revenue;
		echo "\nPool fee ".$pool_fee.'%';
		if ($pool_fee > 0) {
			//Pool takes fee - lets deduce
			$pool_revenue = ($forged_block_revenue * $pool_fee)/100;
			$forged_block_revenue = $forged_block_revenue - $pool_revenue;
			$task = "INSERT INTO miners (address,balance) SELECT * FROM (SELECT '$pool_fee_payout_address','0') AS tmp WHERE NOT EXISTS (SELECT * FROM miners WHERE address = '$address' LIMIT 1)";
			$query = mysqli_query($mysqli,$task) or die(mysqli_error($mysqli));
			$task = "UPDATE miners SET balance=balance+'$pool_revenue' WHERE address='$pool_fee_payout_address';";	
			$query = mysqli_query($mysqli,$task) or die("Database Error");	
			echo "\nPool revenue -> ".$pool_revenue;
		}
		echo "\nTotal Pool Revenue to Split -> ".$forged_block_revenue;


		foreach ($voters_array as $key => $value) {
			$address = $value['address'];
			$balance = $value['balance'];
			$total = $total_voters_power;
			$precentage = $balance / $total;
			$user_revenue = $precentage * $forged_block_revenue;
			echo "\n".$key.' => '.$address.' => '.$balance.' / '.$total.' = '.$precentage.'% -> '.$user_revenue;
			$task = "UPDATE miners SET balance=balance+'$user_revenue' WHERE address='$address';";	
			$query = mysqli_query($mysqli,$task) or die("Database Error");
			$splitted = $splitted + $user_revenue;
		}
		echo "\nSplitted:".$splitted;
		echo "\n___Block:".$forged_block_revenue;
		echo "\nDone...Resting for 30s";
		sleep(30);
		$result1 = 0;
	} else {
		echo "\nNot Forged block...Retry in 30s";
		sleep(30);
	}
}


?>
