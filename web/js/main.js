$(document).ready(function () {

	$('#country_id').change(function () {
		var country_id = $(this).val();
		console.log(country_id);
		$.ajax({
			url:'{{ (path('history_index')) }}',
			type: "POST",
			dataType: "json",
			data: {
				"some_var_name": "some_var_value"
			},
			async: true,
			success: function (data)
			{
				console.log(data)
				//$('div#ajax-results').html(data.output);

			}
		});
		return false;
	});
});

