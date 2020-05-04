getRoute() { this.directionsService = new google.maps.DirectionsService()
this.directionsDisplay = new google.maps.DirectionsRenderer()
this.directionsDisplay.setMap(this.$refs.googleMap.$mapObject) const _self =
this this.directionsService.route({ origin: this.location.position, destination:
{ lat: 62, lng: 15 }, travelMode: 'DRIVING' }, function (response, status) { if
(status === 'OK') { _self.directionsDisplay.setDirections(response) } else {
console.log('Directions request failed due to ' + status) } })
