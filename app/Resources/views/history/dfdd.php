<head>
	<meta charset="UTF-8" />
	<title>{% block title %}SgDatatablesBundleDev{% endblock %}</title>
	{% block stylesheets  %}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/fc-3.2.2/fh-3.1.2/r-2.1.0/datatables.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css">
	<link rel="stylesheet" href="https://cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.css">
	{% endblock %}
	{% block head_javascripts %}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment-with-locales.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js" charset="UTF-8"></script>
	<script src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/fc-3.2.2/fh-3.1.2/r-2.1.0/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="https://cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.js"></script>

	<script src="{{ asset('bundles/sgdatatables/js/pipeline.js') }}"></script>

	<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>
	<script language = "javascript">

		$(document).ready(function () {

			$('#country_id').change(function () {
				var car_id = $(this).val();
				//console.log(country_id);
				$.ajax({
					url:'{{ (path('history_index')) }}',
					type: "POST",
					dataType: "json",
					data: {
						"id_car": car_id
					},
					async: true,
					success: function (data)
					{
						console.log(data);

						//$('tbody').html(data);

					}
				});
				return false;
			});
		});
	</script>
	{% endblock %}
	<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
</head>
{% include('nav.html.twig') %}
{% block main %}

<h2>История проката</h2>
<div style="margin: 10px"><select name="country_id" id="country_id">
		<option selected="" value="0">- выберите машину -</option>
		{% for car in cars %}
		<option value="{{ car.id}}">{{ car.brand}}</option>
		{% endfor %}
	</select>
</div>
{{ sg_datatables_render(datatable) }}
<a class="btn btn-primary" href="{{ path('history_new') }}">Взять в прокат</a>
{% endblock %}

