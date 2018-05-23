<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	_include('htmlpage');

	$page = new HTMLPage('Home');
	$page->include_system_script("background-resize", "ui");
	$page->include_system_stylesheet("bkgnd");
	$page->import_element("button");
	$page->import_element("material-icons");

	// html page headers
	$page->document_start();

	// set variable background
	$bkg = "bkg" . random_int(1, 9);
 ?>

 <!-- page content -->
 <div class='root_container <?php echo $bkg; ?>'>
 	<div id="page_header_bg" class='<?php echo $bkg; ?>'></div>
	<div id='page_header'>
		<div id="header_title">WPI Bar Harbor Visitor Tracking 2018</div>
	</div>

	<div id='side_bar' class='side_bar'>
		<div id="side_bar_bg" class='<?php echo $bkg; ?>'></div>
		<br/><br/><br/>
		<h3>Admin Console</h3>

		<div class='side_bar main_item sect_0'>BHIQP-VT-2018</div>
			<a class='side_bar sub_item' href="#/"><i class="material-icons button-icon">dashboard</i>&nbsp;&nbsp;Admin Dashboard</a>
			<a class='side_bar sub_item' href="#/data"><i class="material-icons button-icon">pin_drop</i>&nbsp;&nbsp;View Raw Data</a>
			<a class='side_bar sub_item' href="#/keys"><i class="material-icons button-icon">phonelink_lock</i>&nbsp;&nbsp;View Device Keys</a>
			<a class='side_bar sub_item' href="#/test"><i class="material-icons button-icon">assignment</i>&nbsp;&nbsp;System Test</a>
			<a class='side_bar sub_item' href="#/conf"><i class="material-icons button-icon">settings</i>&nbsp;&nbsp;Configuration</a>
			<a class='side_bar sub_item' href="#/logs"><i class="material-icons button-icon">receipt</i>&nbsp;&nbsp;Logs</a>
			<a class='side_bar sub_item' href="/phpmyadmin"><i class="material-icons button-icon">storage</i>&nbsp;&nbsp;Database</a>
		</div>
	</div>

	<div id='main_content_box'>
		<div class='content_card'>
			<h3 class='content_title'>System</h3>
			<?php
				$str   = @file_get_contents('/proc/uptime');
				$num   = floatval($str);
				$secs  = (int)fmod($num, 60);
				$num   = intdiv($num, 60);
				$mins  = $num % 60;
				$num   = intdiv($num, 60);
				$hours = $num % 24;
				$num   = intdiv($num, 24);
				$days  = $num;
				echo "<p>Server uptime is <b>$days:$hours:$mins:$secs</b></p>";
				echo "<p>Virtual server hostname is <b>" . gethostbyaddr($_SERVER['SERVER_ADDR']) . "</b></p>";
				echo "<p>Virtual server IP is <b>{$_SERVER['SERVER_ADDR']}</b></p>";
				echo "<p>Reverse proxy server IP is <b>{$_SERVER['REMOTE_ADDR']}</b></p>";

				// Function to check response time
function pingDomain($domain){
    $starttime = microtime(true);
    $file      = fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) $status = -1;  // Site is down
    else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}


echo "<p>Reverse proxy server response time is <b>" . pingDomain($_SERVER['REMOTE_ADDR']) . " ms</b></p>";
echo "<p>Internet response time is <b>" . pingDomain("1.1.1.1") . " ms</b></p>";

			 ?>
			 <button class='clean-button' onclick='refreshSystem()'><i class="material-icons button-icon">refresh</i></button>
			 <a class='clean-button' href='#/conf'>Configuration</a>
		</div>
		<div class='content_card'>
			<h3 class='content_title'>Devices</h3>
			<p><b>0</b> active devices in the last 24 hours.</p>
			<p><b>0</b> authorized devices.</p>
			<button class='clean-button' onclick='refreshDevices()'><i class="material-icons button-icon">refresh</i></button>
			<a class='clean-button' href='#/keys'>View Devices</a>
		</div>
		<div class='content_card'>
			<h3 class='content_title'>Data Collected</h3>
			<p>Date and time of start of colelction is <b>null</b>.</p>
			<p><b>0</b> GPS data points collected.</p>
			<p><b>0</b> unique paths collected.</p>
			<button class='clean-button' onclick='refreshData()'><i class="material-icons button-icon">refresh</i></button>
			<a class='clean-button' href='#/data'>View Data</a>
		</div>
	</div>
 </div>

 <?php $page->document_end(); ?>
