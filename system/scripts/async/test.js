function newTestKey() {
	var button = $("#newkeybtn");
	button.html("Generating...");
	var xhr = $.post("/async/test.php", { req: "newkey"} );

	// on communication failure
	xhr.fail(function () {
		setTimeout(function () {
			button.html("Connection Failed");
		}, 150);

		setTimeout(function () {
			button.html('<i class="material-icons button-icon">vpn_key</i>&nbsp;New Test Key');
		}, 500);
	});

	// show key
	xhr.done(function (data) {
		setTimeout(function () {
			button.html("Generated.");
			$("#newkey").html(data);
		}, 150);

		setTimeout(function () {
			button.html('<i class="material-icons button-icon">vpn_key</i>&nbsp;New Test Key');
		}, 1000);
	});
}
