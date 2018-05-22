<?php
	/*
		error.php
		This file generates possible error pages.
	*/

	require_once('../core.php');
	_include('htmlpage');

	if (isset($_GET['code'])) {
		$code = $_GET['code'];
	} else {
		$code = "???";
	}

	$error_p = new HTMLPage('Error ' . $code);

	$error_p->include_system_stylesheet('error');
	$error_p->import_element('button');
	$error_p->document_start();

	switch($code){
		case '400':
			$error = "Bad request";
			$description = "Looks like your browser sent an invalid request.";
			$todo = "Try refreshing the page or contact an administrator.";
			break;
		case '401':
			$error = "Unauthorized";
			$description = "Looks like you don't have permission to be here.";
			$todo = "If you believe you do, contact an administrator.";
			break;
		case '403':
			$error = "Forbidden";
			$description = "You are not allowed to access this page.";
			$todo = "If you believe you should be, contact an administrator.";
			break;
		case '404':
			$error = "File not found";
			$description = "Uh oh. This page does not exist.";
			$todo = "Please check back later or contact an administrator.";
			break;
		case '405':
			$error = "Method not allowed";
			$description = "Uh oh. Something might be wrong here.";
			$todo = "Please contact an administrator.";
			break;
		case '408':
			$error = "Request timeout";
			$description = "Uh oh. Something might be wrong here. Whatever you did took too long to process.";
			$todo = "Please contact an administrator.";
			break;
		case '410':
			$error = "Gone";
			$description = "This doesn't exist. Not sure what you are looking for.";
			$todo = "Please contact an administrator.";
			break;
		case '500':
			$error = "Internal server error";
			$description = "The server had a problem.";
			$todo = "Please contact an administrator or refresh the page.";
			break;
		case '501':
			$error = "Not implemented";
			$description = "The server is confused about what you asked.";
			$todo = "Please contact an administrator or refresh the page.";
			break;
		case '502':
			$error = "Bad gateway";
			$description = "The server received an invalid response from the upstream server.";
			$todo = "Please contact an administrator or refresh the page.";
			break;
		case '503':
			$error = "Service unavailable";
			$description = "The server is currently down for maintence or is overloaded";
			$todo = "Please contact an administrator or refresh the page.";
			break;
		case '504':
			$error = "Gateway timeout";
			$description = "The server did not recieve a response in time.";
			$todo = "Please contact an administrator or refresh the page.";
			break;
		case '505':
			$error = "HTTP version not supported";
			$description = "The server does not support the HTTP protocol version you are using. Try another browser?";
			$todo = "Please contact an administrator or refresh the page.";
			break;
		default:
			$error = "Error";
			$description = "The server had an unknown problem.";
			$todo = "Please contact an administrator or refresh the page.";
			break;
	}
?>

<br/><br/><br/><br/>

<div class='standalone' id='error_page'>
	<span id='code' class='error'><?php echo $code ?></span>
	<span id='name' class='error'>&nbsp; <?php echo $error ?></span>

	<br/><br/>
	<?php echo $description ?> <br/>
	<?php echo $todo ?>
	<br/><br/>

	<a href='javascript:void' class="clean-button" onclick="window.history.back();">&#8592; Click here to go back.</a>
	<a href='javascript:void' class="clean-button" onclick="location.reload();">&#8635; Refresh</a>
</div>

<?php $error_p->document_end(); ?>
