(function() {

	var views = {};

	views.page_main_index = Backbone.View.extend({
		events: {
			'click #authenticate': 'startAuth',
			'click #hipsterize': 'startHipster'
		},
		initialize: function() {
			this.$auth_button = $('#authenticate');
		},
		startAuth: function() {

			// disable auth button
			this.$auth_button.attr('disabled', 'disabled');

			url = 'https://api.via.me/oauth/authorize/?client_id=7tbat98a5fjiby3wef5lo1hix&redirect_uri=http://instahipster.com/oauth&response_type=code';

			parent.location = url;

		},
		startHipster: function() {
			url = '/hipsterize';
			window.location = url;
		}
	});

	// Initialize the app here
	$(function() {
		var $body = $('body');
		var body_id = $body.attr('id');

		if (views[body_id])
		{
			new views[body_id]({
				el: $body
			});
		}
	});
})();
(function() {
	// Global app object everything will be inside of
	app = {
		controller: {},
		model: {},
		view: {}
	};
})();
