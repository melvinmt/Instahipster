(function() {
	// Initialize the app here
	$(function() {
		var body_id = $('body').attr('id');

		if (app.controller[body_id].init)
		{
			app.controller[body_id].init();
		}
	});
})();