window.onload = function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
};

function showPosition(position) {
    console.log(position.coords.latitude);
    console.log( position.coords.longitude);
}

function getWeatherForSpecifiedCity() {
    let city = document.getElementById("autocomplete").value;
    let getRequestedCityWeatherInformation = fetch('/' + city, {
        method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
            addWeatherInformationAboutCityToHtml(data);
        });
}

function addWeatherInformationAboutCityToHtml(data) {
    let arbitraryCityDiv = document.querySelector(".another-city");
    arbitraryCityDiv.innerHTML = '';
    arbitraryCityDiv.innerHTML += "<br>" + data.city + "," + data.country + "<br>" + data.description + "<br>" + data.temperature + " C";
}

function initService() {
    let input = document.getElementById('autocomplete');
    new google.maps.places.Autocomplete(input);
}


