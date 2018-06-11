// hash navigation
window.addEventListener("hashchange", handleHashChange);

// on page load, process hash status
$(function () { handleHashChange(); });

function handleHashChange(event) {
	var hash = window.location.hash.substring(1);
    var nav = hash.split("/");

	switch (nav[1]) {
		// main pages
		case "data":
		break;
		case "keys":
		break;
		case "test":
			loadSubpage("test");
		break;
		case "conf":
		break;
		case "logs":
		break;
		default:
		break;
	}
}
function subpageSelect(id) {
	// set the proper item as selected
	$('#' + id).addClass('side_bar_item_selected');

	// clear other tabs if it wasn't them that was selected
	if (id != "dashboard_tab")	{ $('#dashboard_tab').removeClass('side_bar_item_selected'); }
	if (id != "data_tab")		{ $('#data_tab').removeClass('side_bar_item_selected'); }
	if (id != "keys_tab")		{ $('#keys_tab').removeClass('side_bar_item_selected'); }
	if (id != "test_tab")		{ $('#test_tab').removeClass('side_bar_item_selected'); }
	if (id != "conf_tab")		{ $('#conf_tab').removeClass('side_bar_item_selected'); }
	if (id != "logs_tab")		{ $('#logs_tab').removeClass('side_bar_item_selected'); }
}

function loadSubpage(page_name, id = 0) {
	subpageSelect(page_name + "_tab");

	var container = $('#main_content_box');
	var xhr;

	// show loading
	container.fadeOut(100);
	setTimeout(function () {
		container.html(__loading_html);
		container.fadeIn(100);
	}, 150);

	// setup xhr
	switch (page_name) {
		case 'dashboard':
			xhr = $.post("/async/account.php", { mode: "view"} );
		break;
		case 'data':
			xhr = $.post("/async/projects.php", { mode: "manage" } );
		break;
		case 'keys':
			xhr = $.post("/async/projects.php", { mode: "modify", pid: id } );
		break;
		case 'test':
			xhr = $.post("/async/test.php", { req: "pageview"} );
		break;
		case "conf":
			xhr = $.post("/async/orders.php", { mode: "new", pid: id } );
		break;
		case "logs":
			xhr = $.post("/async/parts.php", { mode: "new", pid: id } );
		break;
	}

	// load data when ready
	xhr.done(function (new_page_data) {
		container.fadeOut(100);

		setTimeout(function(){
			container.html(new_page_data);
			setupInputs();
			// setupTextAreaInputs();
			container.fadeIn(100);
		}, 150);
	});
}
