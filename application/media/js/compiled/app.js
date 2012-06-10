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

			url = 'http://api.via.me/oauth/authorize/?client_id=7tbat98a5fjiby3wef5lo1hix&redirect_uri=http://instahipster.me/oauth&response_type=code';

			window.location = url;

		},
		startHipster: function() {
			url = '/hipsterize';
			window.location = url;
		}

	});

	views.page_hipsterize_index = Backbone.View.extend({
		events: {
			'change #file_select': 'submitForm'
		},
		initialize: function() {

		},
		submitForm: function() {
			$('#submit_btn').attr('disabled', 'disabled');
			$('#upload_pic').submit();
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
