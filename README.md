# Lisk Pool
This is first LISK delegate forging pool. Written in PHP.

#Requirements
<a href="https://mariadb.org" target="_blank">MariaDB server</a><br>
<a href="http://nginx.org" target="_blank">Nginx/Apache (optional)</a><br>
<a href="https://lisk.io/documentation" target="_blank">LISK Node</a><br>
<a href="http://www.highcharts.com" target="_blank">Highcharts (included in project)</a><br>
 
#Setup on Linux
Install all software mentioned above.<br>
Setup your mysql server and import database scheme <pre>lisk_pool_scheme_db.sql</pre>
Now please navigate to config.php
<pre>
'host' => 'localhost',    <- don't change if mariadb is running on the same machine
'username' => 'root',     <- Database user
'password' => 'SQL_PASSWORD',  <- Database Password
'bdd' => 'lisk',    <- Database Name
'lisk_host' => 'localhost',   <- Lisk Node Host, acually pool can be running on different machine, it's also possible to point to login.lisk.io
'lisk_port' => '7000',    <- Lisk Testnet port, 8000 - Mainnet
'pool_fee' => '0.0%',     <- adjustable pool fee as float for ex. "1.25%"
'pool_fee_payout_address' => '17957303129556813956L',   <- Payout address if fee > 0.0
'delegate_address' => '17957303129556813956L',    <- Delegate address - must be valid forging delegate address
'payout_threshold' => '1',    <- Payout threshold in LISK
'fixed_withdraw_fee' => '0.1',    <- Fixed Wihtdraw fee in LISK
'withdraw_interval_in_sec' => '43200',   <- Wihtdraw script interval represented in seconds
'secret' => 'passphrase1',    <- Main passphrase the same your as in your forging delegete
'secondSecret' => 'passphrase2' <- Second passphrase, if you dont have one leave it empty ex. ""
</pre>

#Start Pool
Start LISK node as usual, and set up it to forge.

Now start background scripts:<br>
<br>Block Processing - this script check if delegate has forged new block, if yes it will be splited as definied in config
<pre>screen<br>Push Enter key<br>sudo php /var/private/processing.php</pre>
<br>Updating charts - this script updates data to keep charts up to date.
<pre>screen<br>Push Enter key<br>sudo php /var/private/stats.php</pre>
<br>Withdraw script - this script withdraws earned and split revenue as definied in config.
<pre>screen<br>Push Enter key<br>sudo php /var/private/withdraw.php</pre>
<br><br>
Optional
Balance checker - Simple script to compare total LISK value stored in database in refernce to actual LISK stored on delegate account.
<pre>php /var/private/check.php</pre>

<br>
You can easily access all background scripts by
<pre>
screen -ls<br>then pick one by<br>screen -x INTEGER</pre>

#Contributing
If you want to contribute, fork and pull request or open issue.


#License
Entire PHP is under The MIT License (MIT)<br>
Front-end(site theme) is used from http://themes.3rdwavemedia.com/website-templates/responsive-bootstrap-theme-web-development-agencies-devstudio/<br>
Personally i own license, so better buy license or use your own front-end.

#Donate
Bitcoin -> 1MsCcLLzaZtgEiMsigFoRJjz149mPSoFKC<br>
![alt tag](http://s16.postimg.org/xbne92mdx/image.png)<br>
