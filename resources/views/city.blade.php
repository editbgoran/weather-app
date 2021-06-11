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
    {{$forecast["city"] ."," .$forecast["country"]}} <br>
    {{$forecast["description"]}} <br>
    {{$forecast["temperature"]." C"}} <br><br>

    <div class="form-group">
        <label>City</label><br>
        <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
        <button type="submit" onclick="getWeatherForSpecifiedCity()">Submit</button>
    </div>

</div>
<script src="{{asset('js/weather.js')}}"></script>
</body>
</html>
