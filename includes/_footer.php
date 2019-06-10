<footer id="footer-main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 tcenter">
				<nav>
					<a href="<?= base_url; ?>">HOME</a>
					<a href="<?= base_url; ?>hotels">HOTELS</a>
					<a href="<?= base_url; ?>blog">BLOG</a>
					<a href="<?= base_url; ?>contacto">CONTACT US</a>
				</nav>

				<div class="h10"></div>

				<p class="copy">Copyright© 2019 Babilon Travel, All rights reserved. <a href="javascritp:;">Notice of privacy</a>. </p>
			</div>
		</div>
	</div>
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?= base_url; ?>js/plugins.js"></script>
<script src="<?= versionarArchivo('js/main.js') ?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
	$("#search-hotels").click(function(){
		$(this).fadeOut();
		$("#ajaxBusy").fadeIn(300);
		let pass = "1";
		$('.formulario-informacion input, .formulario-informacion select').each(function () {
			let data = $(this).val();
			if (data !== "") {
				obj[$(this).attr('name')] = data;
			}
			$(this).removeClass('error');
			if (data === '' && (!$(this).hasClass('norequired'))) {
				$(this).addClass('error');
				pass = "0";
				return false;
			}
		});
		if (pass !== "0") {
			$("#frm-hotels").submit();
		}else{
			$("#ajaxBusy").fadeOut(300);
			$(this).fadeIn();
		}
	});
	$( function() {
		var dateFormat = "mm/dd/yy",
		from = $( "#from" )
		.datepicker({
			defaultDate: "+1w",
			numberOfMonths: 3
		})
		.on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
		}),
		to = $( "#to" ).datepicker({
			defaultDate: "+1w",
			numberOfMonths: 3
		})
		.on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
		});

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}

			return date;
		}
	} );
</script>