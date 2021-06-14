<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Current Weather</title>

</head>
<body>
<div>
    <div>
        {{$city}}, {{$country}}<br>
        {{$current["temperature"]. " °C"}} <br>
        {{$current["weather"]}}
    </div>
    <p>Weather forecast for the next seven days:</p>
    <div style="display: flex">
    @foreach($forecastDaily as $day)
        <div style="width: 100%">
          Date:  {{$day["date"]}} <br>
          Min. temp:  {{$day["min-temp"]. " °C"}} <br>
          Max. temp:  {{$day["max-temp"]. " °C"}} <br>
          {{$day["weather-description"]}}
        </div>
    @endforeach
    </div>
    <br>
    <div class="form-group">
        <label>City</label><br>
        <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose City">
        <button type="submit" onclick="getWeatherForSpecifiedCity()">Submit</button>
        <p class="validation-errors"></p>
    </div>

    <div class="most-searched-cities">
        @if(count($mostSearchedCities) > 0)
        <h4>Most searched places</h4>
        <ul>
            @foreach ($mostSearchedCities as $city)
                <li>{{$city}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="another-city">

    </div>

</div>
<script src="{{asset('js/weather.js')}}"></script>
<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXoKyczk9chHscXlIufdSDz_iSr-Tnnas&libraries=places&callback=initService">
</script>
</body>
</html>
