// Ask GPS
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

// Get coords
function showPosition(position) {
  var name = document.getElementById("name");
  var lat = document.getElementById("lat");
  var long = document.getElementById("long");

  // Update values with lat long.
  lat.value = position.coords.latitude;
  long.value = position.coords.longitude;

  // Enter a default name if none is entered.
  if (name.value == "") {
    name.value = "Current Location";
  }
}
