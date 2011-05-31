(function() {
	// Global app object everything will be inside of
	app = {
		controller: {},
		model: {},
		view: {}
	};
})();
(function() {
	// Initialize the app here
	$(function() {
		var body_id = $('body').attr('id');

		if (app.controller[body_id] && app.controller[body_id].init)
		{
			app.controller[body_id].init();
		}
	});
})();