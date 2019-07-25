// In HTML
// <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
// <script src="web/js/googlemap.js"></script>

function load() {

	var mapIcon = new google.maps.LatLng(55.429602, -5.604778);

	var stylez = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];

	var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0); // Stops draggable on mobile phones
	var isDraggable = w > 480 ? true : false; // Stops draggable on mobile phones

	var myMapOptions = {
		zoom: 15,
		center: mapIcon,
		//zoomControl: false, // Removes Zoom Control Bar
		scaleControl: false, // Scale Control
		scrollwheel: false, // Stops Mouse Wheel Controlling Map
		draggable: isDraggable, // Stops draggable on mobile phones
		mapTypeControl: false, // Stops Styles Changing
		//draggable: false, // Stops Dragging of Map
		panControl: false, // Removes Pan Circle
		//disableDoubleClickZoom: true, // Stops Double Click Zoom
		streetViewControl: false, // Removes Pegman
		overviewMapControl: false, // Removes Overview Box
		mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID // SATELLITE // TERRAIN
	};

	var map = new google.maps.Map(document.getElementById("googlemap"),myMapOptions);

	var image = new google.maps.MarkerImage(
		'/web/images/google_marker.png',
		new google.maps.Size(45,45), // Marker Width, Height
		new google.maps.Point(0,0),
		new google.maps.Point(22,22) // Marker Position e.g. Half-Width, Height for pin end OR Half-Width, Half-Height for centered
	);

	var marker = new google.maps.Marker({
		draggable: false,
		raiseOnDrag: false,
		icon: image,
		map: map,
		position: mapIcon
	});

	var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
	map.mapTypes.set('googlemap', mapType);
	map.setMapTypeId('googlemap');

	// Optional Popup Message onClick
	var Mes1 = new google.maps.InfoWindow({
		content: "Glen Scotia Distillery"
	});
	google.maps.event.addListener(marker, "click", function (e) { Mes1.open(map, this); }); // Open When Click Marker

	// Mes1.open(map,marker); // Message Always Open

}

$(document).ready(load);