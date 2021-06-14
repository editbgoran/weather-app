function getWeatherForSpecifiedCity() {
    let city = document.getElementById("autocomplete").value;
    if(!city.length) {
        let valError = document.querySelector(".validation-errors");
        valError.innerHTML = '';
        valError.style.color = 'red';
        valError.innerHTML = "Please fill out this field."
    }
    else {
        document.querySelector(".validation-errors").innerHTML = '';

        fetch('/' + city, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(data => {
                addWeatherInformationAboutCityToHtml(data);
            });
    }
}

function addWeatherInformationAboutCityToHtml(data) {
    let arbitraryCityDiv = document.querySelector(".another-city");
    arbitraryCityDiv.innerHTML = '';
    arbitraryCityDiv.innerHTML += "<br>" + data.city + "," + data.country + "<br>" + data.description + "<br>" + data.temperature + " C";
}

function initService() {
    let input = document.getElementById('autocomplete');
    let options = {
        types: ['(cities)'],
    };

    new google.maps.places.Autocomplete(input,options);
}


