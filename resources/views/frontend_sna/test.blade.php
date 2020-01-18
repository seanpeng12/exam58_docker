{{-- 版本一 --}}
{{-- <div id="demo1" class="xm-select-demo"></div>
<button class="btn" id="demo1-getValue">获取选中值</button>
<pre id="demo1-value"></pre>

<!-- 引入插件 -->



<script src="dist/xm-select.js" type="text/javascript" charset="utf-8"></script>

<script>
    var demo1 = xmSelect.render({
	el: '#demo1', 
	language: 'zn',
	data: [
		{name: '张三', value: 1},
		{name: '李四', value: 2},
		{name: '王五', value: 3},
	]
})

document.getElementById('demo1-getValue').onclick = function(){
	//获取当前多选选中的值
	var selectArr = demo1.getValue();
	document.getElementById('demo1-value').innerHTML = JSON.stringify(selectArr, null, 2);
}
</script> --}}



{{-- 版本二 --}}
<!-- 首先引入css, 和js, 唯一依赖: jQuery -->
{{-- <link href="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.css" rel="stylesheet" />
<script src="//unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.min.js"></script>

<select name="city" xm-select="search-local" xm-select-search>
    <option value=""></option>
    <option value="1">北京</option>
    <option value="2">上海</option>
    <option value="3">广州</option>
    <option value="4">深圳</option>
    <option value="5">天津</option>
</select>

<!-- 执行渲染, 把原始select美化~~ -->
<script type="text/javascript">
    formSelects.render('search-local');
</script> --}}

{{-- 版本三 --}}
{{-- <script src="dist/xm-select.js" type="text/javascript" charset="utf-8"></script>
<div id="demo2" class="xm-select-demo"></div>

<script>
    var demo2 = xmSelect.render({
	el: '#demo2', 
    filterable: true,
    // initValue = 一開始選擇的東西
    initValue: [4],
	data: [
		{name: '水果', value: 1, selected: true, disabled: true},
		{name: '蔬菜', value: 2, selected: true},
		{name: '桌子', value: 3, disabled: true},
		{name: '北京', value: 4},
	]
})
</script> --}}
<!DOCTYPE html>
<html>

<head>
	<title>Place Autocomplete and Directions</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<style>
		/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
		#map {
			height: 100%;
		}

		/* Optional: Makes the sample page fill the window. */
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		.controls {
			margin-top: 10px;
			border: 1px solid transparent;
			border-radius: 2px 0 0 2px;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
			height: 32px;
			outline: none;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		}

		#origin-input,
		#destination-input,
		#middle-input {
			background-color: #fff;
			font-family: Roboto;
			font-size: 15px;
			font-weight: 300;
			margin-left: 12px;
			padding: 0 11px 0 13px;
			text-overflow: ellipsis;
			width: 200px;
		}

		#origin-input:focus,
		#destination-input,
		#middle-input:focus {
			border-color: #4d90fe;
		}

		#mode-selector {
			color: #fff;
			background-color: #4d90fe;
			margin-left: 12px;
			padding: 5px 11px 0px 11px;
		}

		#mode-selector label {
			font-family: Roboto;
			font-size: 13px;
			font-weight: 300;
		}
	</style>
</head>

<body>
	<div style="display: none">
		<input id="origin-input" class="controls" type="text" placeholder="Enter an origin location">
		<input id="middle-input" class="controls" type="text" placeholder="Enter a destination location">

		<input id="destination-input" class="controls" type="text" placeholder="Enter a destination location">



		<div id="mode-selector" class="controls">
			<input type="radio" name="type" id="changemode-walking" checked="checked">
			<label for="changemode-walking">Walking</label>

			<input type="radio" name="type" id="changemode-transit">
			<label for="changemode-transit">Transit</label>

			<input type="radio" name="type" id="changemode-driving">
			<label for="changemode-driving">Driving</label>
		</div>
	</div>

	<div id="map"></div>

	<script>
		// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    mapTypeControl: false,
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13
  });

  new AutocompleteDirectionsHandler(map);
}

/**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
  this.map = map;
  this.originPlaceId = null;
  this.destinationPlaceId = null;
  this.travelMode = 'WALKING';
  this.directionsService = new google.maps.DirectionsService;
  this.directionsRenderer = new google.maps.DirectionsRenderer;
  this.directionsRenderer.setMap(map);

  var originInput = document.getElementById('origin-input');
  var destinationInput = document.getElementById('destination-input');
  var middleInput = document.getElementById('middle-input');
  var modeSelector = document.getElementById('mode-selector');

  var originAutocomplete = new google.maps.places.Autocomplete(originInput);
  // Specify just the place data fields that you need.
  originAutocomplete.setFields(['place_id']);

  var destinationAutocomplete =
      new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.
  destinationAutocomplete.setFields(['place_id']);

  this.setupClickListener('changemode-walking', 'WALKING');
  this.setupClickListener('changemode-transit', 'TRANSIT');
  this.setupClickListener('changemode-driving', 'DRIVING');

  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
      destinationInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
AutocompleteDirectionsHandler.prototype.setupClickListener = function(
    id, mode) {
  var radioButton = document.getElementById(id);
  var me = this;

  radioButton.addEventListener('click', function() {
    me.travelMode = mode;
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
  var me = this;
  autocomplete.bindTo('bounds', this.map);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();

    if (!place.place_id) {
      window.alert('Please select an option from the dropdown list.');
      return;
    }
    if (mode === 'ORIG') {
      me.originPlaceId = place.place_id;
    } else {
      me.destinationPlaceId = place.place_id;
    }
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.route = function() {
  if (!this.originPlaceId || !this.destinationPlaceId) {
    return;
  }
  var me = this;

  this.directionsService.route(
      {
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode
      },
      function(response, status) {
        if (status === 'OK') {
          me.directionsRenderer.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
};

	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkS6nBwtRIUe55-p_oHZh6QocvIyUAG2A&libraries=places&callback=initMap">
	</script>
</body>

</html>