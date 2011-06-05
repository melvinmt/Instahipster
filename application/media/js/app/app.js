(function() {
	// Initialize the app here
	$(function() {
		var $body = $('body');
		var body_id = $body.attr('id');

		if (app.controller[body_id] && app.controller[body_id].init)
		{
			$.ajax(Kohana.media_url + '/js/app/compiled/templates.mustache',{
				success: function(response){
					$body.append(response);
					app.controller[body_id].init();
				}
			});
		}
	});
})();