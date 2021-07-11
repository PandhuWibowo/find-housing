function initMap () {
  const centerPoint = {
    lat: -6.2293867,
    lng: 106.6894316
  }

  const options = {
    center: centerPoint,
    zoom: 10,
    mapTypeId: "roadmap",
  }

  map = new google.maps.Map(document.getElementById('map'), options)
  const initMarker = new google.maps.Marker({
    position: centerPoint,
    map: map,
    draggable: true
  })

  google.maps.event.addListener(initMarker, 'dragend', function(marker) {
    const latLng = marker.latLng;
    document.getElementById('latitude').value = latLng.lat();
    document.getElementById('longitude').value = latLng.lng();
  });
  
  const input = document.getElementById('autocomplete')
  if (input) {
    const searchBox = new google.maps.places.SearchBox(input)

    // autocomplete.addListener('place_changed', function () {
    //   const place = autocomplete.getPlace();
    //   $('#latitude').val(place.geometry['location'].lat());
    //   $('#longitude').val(place.geometry['location'].lng());
    // });
    // return false
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
      searchBox.setBounds(map.getBounds());
    });
    let markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
      const places = searchBox.getPlaces();

      if (places.length == 0) return;
      // Clear out the old markers.
      markers.forEach((marker) => {
        marker.setMap(null);
      });
      markers = [];
      // For each place, get the icon, name and location.
      const bounds = new google.maps.LatLngBounds();
      places.forEach((place) => {
        if (!place.geometry || !place.geometry.location) {
          console.log("Returned place contains no geometry");
          return;
        }
        const icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25),
        };
        
        // Create a marker for each place.
        markers.push(
          newMarker = new google.maps.Marker({
            map,
            icon,
            title: place.name,
            position: place.geometry.location,
            draggable: true
          })  
        );

        markers.forEach(marker => {
          google.maps.event.addListener(marker, 'dragend', function(marker) {
            const latLng = marker.latLng;
            document.getElementById('latitude').value = latLng.lat();
            document.getElementById('longitude').value = latLng.lng();
          });
        })

        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      
      map.fitBounds(bounds);

      initMarker.setMap(null)
    });
    return false
  }
}

