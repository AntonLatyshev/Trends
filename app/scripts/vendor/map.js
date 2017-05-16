if (document.getElementById('map-location')) {
    const buildMap = function(locations) {
        var styles = [
            {
             featureType: "all",
             stylers: [
               { saturation: -100 }
             ]
           },{
             featureType: "road.arterial",
             elementType: "geometry",
             stylers: [
               { hue: "#ffcc00" },
               { saturation: 0 }
             ]
           }
        ];
    const mapOptions = {
      zoom: 14,
      scrollwheel: false,
      navigationControl: false,
      mapTypeControl: false,
      scaleControl: false,
      draggable: true,
      styles: styles
  };

    const map = new google.maps.Map(document.getElementById("map-location"), mapOptions);

    const image = '/data/marker.png';

    const infowindow = new google.maps.InfoWindow();
    const markers = [];
    const bounds = new google.maps.LatLngBounds();
    for (let i in locations) {
      const marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        title: locations[i][0],
        icon: image
      });
      bounds.extend(marker.position);
      google.maps.event.addListener(marker, 'click', function() {
          console.log(i);
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      });

      google.maps.event.addListener(marker, 'mouseover', function mouseover(event) {
        $('.gm-style > div').removeAttr('title')
      });
      markers.push(marker);
    }
    google.maps.event.addListener(map, 'zoom_changed', function() {
      zoomChangeBoundsListener =
        google.maps.event.addListener(map, 'bounds_changed', function(event) {
          if (this.getZoom() > 15 && this.initialZoom == true) {
            // Change max/min zoom here
            this.setZoom(15);
            this.initialZoom = false;
          }
          google.maps.event.removeListener(zoomChangeBoundsListener);
        });
    });
    map.initialZoom = true;
    map.fitBounds(bounds);
    // google.maps.event.trigger(markers[0], 'click');

    // $(document).on('click', '.links-maps a', function() {
    //   google.maps.event.trigger(markers[$(this).index()], 'click');
    // });
  }
  buildMap(window[$('.links-maps li:first-child a').data('location')]);

  $('.product-list .link-map').on('click', function() {
    buildMap(window[$(this).data('location')]);
  })
}
