function refreshSystem() {
	// send data to system to create
	var xhr = $.post("async/dashboard.php", { req: "refresh_system" });

	// on communication failure, do nothing
	xhr.fail(function () {});

	// update info
	xhr.done(function (data) { $("#system_data").html(data); });
}
