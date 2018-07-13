<?php  /* Template Name: Contato */ ?>
<?php  get_header(); ?>

<div class="title_page contato">
	<div class="container">
		<h1><strong>CONTATOS</strong></h1>
	</div>
</div>

<section class="content_contatos">
	<div class="container">
		<div class="title_ancora">
			<h2>FALE<strong> CONOSCO</strong></h2>
			<span></span>
		</div>

		<p class="text_contato">
			Entre em contato conosco e conheça um pouco mais sobre Lisieux Treinammento
		</p>

		<div class="info_contatos">
			<div class="item_info">
				<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/icon_telefone.png">
				<p>
					<strong>Telefone</strong><br>
					<br class="hidden-sm hidden-md hidden-lg">
					11 94224.<span class="tel" data-number="5480">CLIQUE</span>
				</p>
			</div>
			<div class="item_info">
				<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/ico-whats-amarelo.png">
				<p>
					<strong>Whatsapp</strong><br>
					<br class="hidden-sm hidden-md hidden-lg">
					16 99104.<span class="tel" data-number="5480">CLIQUE</span>
				</p>
			</div>
			<div class="item_info">
				<img class="img-responsive" src="<?php  bloginfo('template_url') ?>/images/icon_mail.png">
				<p>
					<strong>E-mail</strong><br>
					treinamento@eslisieux.com.br
				</p>
			</div>
			<div class="item_info nobd">
				<a href="">
					<img src="<?php  bloginfo('template_url') ?>/images/icon_facebook.png">
				</a>
				<a href="">
					<img src="<?php  bloginfo('template_url') ?>/images/icon_insta.png">
				</a>
			</div>
		</div>

		<form class="formContato">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<input type="text" name="txt_nome" placeholder="Seu nome">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<input type="text" name="txt_email" placeholder="Seu e-mail">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<input type="text" name="txt_telefone" placeholder="Seu telefone">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<input type="text" name="txt_assunto" placeholder="Assunto do email">
				<!-- <select name="txt_assunto">
					<option value="" default>Assunto</option>
				</select> -->
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<textarea name="txt_mensagem" placeholder="Escreva sua mensagem"></textarea>
			</div>

			<input type="submit" class="submitContato" value="ENVIAR">

		</form>

		<div class="clear"></div>

		<div class="title_ancora">
			<h2>NOSSA<strong> LOCALIZAÇÃO</strong></h2>
			<span></span>
		</div>

	</div>
</section>

<section class="map">
	<div id="maps-canvas"></div>
	<div class="container">
		<div class="caption-map">
			<img src="<?php  bloginfo('template_url') ?>/images/ico_mark.gif">
			<p>
				Alameda Grajaú, 614 cj. 1508<br>
				Alphaville (Barueri/SP)
			</p>
		</div>
	</div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYcisbNDE8k3xF7GSPYLO8mLjao0mZo2o&libraries=places&callback=initMap" async defer></script>
<script>function initMap() {
    var mapOptions = {
        zoom: 16,
        scrollwheel: false,
        streetViewControl: false,
        center: new google.maps.LatLng(-23.4928945, -46.8469114),
    };
    var map = new google.maps.Map(document.getElementById('maps-canvas'), mapOptions);
    var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(-23.4928945, -46.8469114),
        icon: 'http://lisieuxtreinamento.com.br/wp-content/themes/Site/images/icon_marker.png'
    });
    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
    var styleArray = [{
        featureType: "all",
        stylers: [{
            saturation: -80
        }]
    }, {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [{
            hue: "#00ffee"
        }, {
            saturation: 50
        }]
    }, {
        featureType: "poi.business",
        elementType: "labels",
        stylers: [{
            visibility: "off"
        }]
    }];

    map.setOptions({
        styles: styleArray
    });
}
</script>
<?php  get_footer(); ?>


