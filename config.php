<?php
$lisk_nodes = array(0 => 'localhost');
$lisk_ports = array(0 => '9305');
return array(
    'host' => 'localhost',
    'username' => 'root',
	'password' => 'liskdbpool',
	'bdd' => 'lisk',
	'lisk_host' => $lisk_nodes,
	'lisk_port' => $lisk_ports,
	'protocol' => 'http',
	'pool_fee' => '25.0%',
	'pool_fee_payout_address' => '4556063719854360813S',
	'delegate_address' => '2675385658327038858S',
	'payout_threshold' => '0.2',
	'fixed_withdraw_fee' => '0.1',
	'withdraw_interval_in_sec' => '86400',
	'secret' => 'passphrase1',
	'secondSecret' => ''
);
?>
