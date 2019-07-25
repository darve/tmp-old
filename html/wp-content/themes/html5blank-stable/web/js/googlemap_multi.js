// In HTML
// <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
// <script src="web/js/googlemap.js"></script>

function load() {

	var stylez = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

	
	var mapCenter = new google.maps.LatLng(54.559322, -4.174804); // Map Center Point

	var properties = [
		// ['Glasgow', 55.864237, -4.251806, 4, 22, 'url'],
		// ['Edinburgh', 55.953252, -3.188267, 5, 22, 'url'],
		// ['London', 51.507351, -0.127758, 3, 22, 'url'],
		// ['Manchester', 53.480759, -2.242631, 2, 22, 'url'],
		['Liverpool', 53.408371, -2.991573, 1, 22, 'url']
	];

	// Stop Dragable on Mobiles
	//var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0); // Stops draggable on mobile phones
	//var isDraggable = w > 480 ? true : false; // Stops draggable on mobile phones

	var myMapOptions = {
		zoom: 6,
		center: mapCenter,
		zoomControl: false, // Removes Zoom Control Bar
		scaleControl: false, // Scale Control
		scrollwheel: false, // Stops Mouse Wheel Controlling Map
		//draggable: isDraggable, // Stops draggable on mobile phones
		mapTypeControl: false, // Stops Styles Changing
		draggable: false, // Stops Dragging of Map
		panControl: false, // Removes Pan Circle
		disableDoubleClickZoom: true, // Stops Double Click Zoom
		streetViewControl: false, // Removes Pegman
		overviewMapControl: false, // Removes Overview Box
		mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID // SATELLITE // TERRAIN
	};

	var map = new google.maps.Map(document.getElementById("googlemap"),myMapOptions);

	var image = new google.maps.MarkerImage(
		'/web/images/google_marker.png',
		new google.maps.Size(22,39), // Marker Width, Height
		new google.maps.Point(0,0),
		new google.maps.Point(11,39) // Marker Position e.g. Half-Width, Height for pin end OR Half-Width, Half-Height for centered
	);

	var infowindow = new google.maps.InfoWindow();

	var marker, i;

	for (i = 0; i < properties.length; i++) {

		var propLocation = properties[i];
        
        marker = new google.maps.Marker({
        	draggable: false,
			raiseOnDrag: false,
			icon: image,
			map: map,
			position: {lat: propLocation[1], lng: propLocation[2]},
			title: propLocation[0],
			zIndex: propLocation[3]
        });        

        // Marker InfoWindow
		google.maps.event.addListener(marker, 'click', (function(marker, i) {

			var contentTXT = "<span>" + propLocation[0] + "</span><br />" + propLocation[4] + " Properties<br /><a href=\"" + propLocation[5] + "\">VIEW PROPERTIES</a>"

			return function() {
				infowindow.setContent(contentTXT);
				infowindow.open(map, marker);
			}

		})(marker, i));
		
		// Keep marker Open with message
		// infowindow.setContent("Hello World");
		// infowindow.open(map, marker);

    }

	var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
	map.mapTypes.set('googlemap', mapType);
	map.setMapTypeId('googlemap');

}

$(document).ready(load);
