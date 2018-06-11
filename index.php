<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/system/core.php');
	_include('htmlpage');

	$page = new HTMLPage('Home');
	$page->include_system_script("background-resize", "ui");
	$page->include_system_script("index", "async");
	$page->include_system_script("nav", "async");
	$page->include_system_stylesheet("bkgnd");
	$page->import_element("button");
	$page->import_element("loading");
	$page->import_element("dropdown");
	$page->import_element("material-icons");
	$page->import_element("text-input");

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
			<a id='dashboard_tab' class='side_bar sub_item side_bar_item_selected' href="/"><i class="material-icons button-icon">dashboard</i>&nbsp;&nbsp;Admin Dashboard</a>
			<a id='data_tab' class='side_bar sub_item' href="#/data"><i class="material-icons button-icon">pin_drop</i>&nbsp;&nbsp;View Raw Data</a>
			<a id='keys_tab' class='side_bar sub_item' href="#/keys"><i class="material-icons button-icon">phonelink_lock</i>&nbsp;&nbsp;View Device Keys</a>
			<a id='test_tab' class='side_bar sub_item' href="#/test"><i class="material-icons button-icon">assignment</i>&nbsp;&nbsp;System Test</a>
			<a id='testdata_tab' class='side_bar sub_item' href="#/testdata"><i class="material-icons button-icon">assignment_late</i>&nbsp;&nbsp;View Test Data</a>
			<a id='testkeys_tab' class='side_bar sub_item' href="#/testkeys"><i class="material-icons button-icon">developer_mode</i>&nbsp;&nbsp;View Test Keys</a>
			<a id='conf_tab' class='side_bar sub_item' href="#/conf"><i class="material-icons button-icon">settings</i>&nbsp;&nbsp;Configuration</a>
			<a id='logs_tab' class='side_bar sub_item' href="#/logs"><i class="material-icons button-icon">receipt</i>&nbsp;&nbsp;Logs</a>
			<a class='side_bar sub_item' href="https://aether.ky8.io/phpMyAdmin/index.php"><i class="material-icons button-icon">storage</i>&nbsp;&nbsp;Database</a>
		</div>
	</div>

	<div id='main_content_box'>
		<div class='content_card'>
			<h3 class='content_title'>System</h3>
			<div id='system_data'>
				<?php
					$uptime = get_uptime();
					echo "<p>Server uptime is <b>{$uptime['days']}:{$uptime['hours']}:{$uptime['mins']}:{$uptime['secs']}</b></p>";
					echo "<p>Server hostname is <b>" . gethostname() . "</b></p>";
					echo "<p>Server IP is <b>{$_SERVER['SERVER_ADDR']}</b></p>";
					echo "<p>Reverse proxy server IP is <b>{$_SERVER['REMOTE_ADDR']}</b></p>";
					echo "<p>Reverse proxy server response time is <b>" . ping_domain($_SERVER['REMOTE_ADDR']) . " ms</b></p>";
					echo "<p>Internet response time is <b>" . ping_domain("1.1.1.1") . " ms</b></p>";
				 ?>
		 	</div>
			 <button class='clean-button' onclick='refreshSystem()'><i class="material-icons button-icon">refresh</i></button>
			 <a class='clean-button' href='#/conf'>Configuration</a>
		</div>
		<div class='content_card'>
			<div id='device_data'>
				<h3 class='content_title'>Devices</h3>
				<p><b>0</b> active devices in the last 24 hours.</p>
				<p><b>0</b> authorized devices.</p>
			</div>
			<button class='clean-button' onclick='refreshDevices()'><i class="material-icons button-icon">refresh</i></button>
			<a class='clean-button' href='#/keys'>View Devices</a>
		</div>
		<div class='content_card'>
			<div id='data_data'>
				<h3 class='content_title'>Data Collected</h3>
				<p>Date and time of start of colelction is <b>null</b>.</p>
				<p><b>0</b> GPS data points collected.</p>
				<p><b>0</b> unique paths collected.</p>
			</div>
			<button class='clean-button' onclick='refreshData()'><i class="material-icons button-icon">refresh</i></button>
			<a class='clean-button' href='#/data'>View Data</a>
		</div>
	</div>
 </div>

 <?php $page->document_end(); ?>
