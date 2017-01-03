function initMap() {
    geocoder = new google.maps.Geocoder();
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(displayLocation, displayError);
    } else {
        document.getElementById("locationData").innerHTML = "Sorry - your browse";
	}
  }  
  
var displayLocation = function (position) {

    //build text string including co-ordinate data passed in parameter
    var displayText = "User latitude is " + position.coords.latitude + " and longitude is " + position.coords.longitude;
    //display the string for demonstration
    //alert(displayText);
	var lat = position.coords.latitude;
    var lng = position.coords.longitude;
	codeLatLng(lat, lng)
};

function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
         //alert(results[0].formatted_address)
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    var state= results[0].address_components[i];
					$.session.set('state', state.long_name);
                    break;
                }
				if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                    //this is the object you are looking for
                    var city= results[0].address_components[i];
					$.session.set('city', city.long_name);
                    break;
                }
				if (results[0].address_components[i].types[b] == "sublocality_level_1") {
                    //this is the object you are looking for
                    var locArea= results[0].address_components[i];
					$.session.set('locArea', locArea.long_name);
                    break;
                }
				if (results[0].address_components[i].types[b] == "sublocality_level_2") {
                    //this is the object you are looking for
                    var street= results[0].address_components[i];
					$.session.set('street', street.long_name);
                    break;
                }
				if (results[0].address_components[i].types[b] == "premise") {
                    //this is the object you are looking for
                    var premise= results[0].address_components[i];
					$.session.set('premise', premise.long_name);
                    break;
                }
				if (results[0].address_components[i].types[b] == "postal_code") {
                    //this is the object you are looking for
                    var zipCode= results[0].address_components[i];
					$.session.set('zipCode', zipCode.long_name);
                    break;
                }
            }
        }
        //city data
        //alert(city.short_name + " " + city.long_name)


        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }

var displayError = function (error) {

    //get a reference to the HTML element for writing result
    var locationElement = document.getElementById("locationData");

    //find out which error we have, output message accordingly
    switch (error.code) {
        case error.PERMISSION_DENIED:
            //locationElement.innerHTML = "Permission was denied";
			cosole.log("Permission was denied");
            break;
        case error.POSITION_UNAVAILABLE:
            //locationElement.innerHTML = "Location data not available";
			cosole.log("Location data not available");
            break;
        case error.TIMEOUT:
            //locationElement.innerHTML = "Location request timeout";
			cosole.log("Location request timeout");
            break;
        case error.UNKNOWN_ERROR:
            //locationElement.innerHTML = "An unspecified error occurred";
			cosole.log("An unspecified error occurred");
            break;
        default:
            //locationElement.innerHTML = "Who knows what happened...";
			cosole.log("Who knows what happened...");
            break;
    }
};