<?php
/**
 * Created by PhpStorm.
 * User: rohit
 * Date: 3/25/2017
 * Time: 8:40 AM
 */
if($_REQUEST['username'] == "admin" and $_REQUEST['password']== "admin")
{}
else{
    header('Location: login_page.html');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);


        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }
        .form button:hover,.form button:active,.form button:focus {
            background: #43A047;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }
        .form .register-form {
            display: none;
        }


        body {
            background: #76b852; /* fallback for old browsers */
            background: -webkit-linear-gradient(right, #76b852, #8DC26F);
            background: -moz-linear-gradient(right, #76b852, #8DC26F);
            background: -o-linear-gradient(right, #76b852, #8DC26F);
            background: linear-gradient(to left, #76b852, #8DC26F);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
          rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <!-- Javascript -->

</head>
<body><div  class="form" style="width: 20%; float:left">
    <span >WELCOME ADMIN</span>
    <br>
    <!--<form class="login-form"> -->
          FROM DATE : <input type="text" id="fdatepicker"/>
    TO DATE : <input type="text" id="tdatepicker"/>
    <!-- </form> -->
    <button id="do">Get Visitors</button>

</div>


<div id="map"></div>
<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var urlcall;
    $(function() {
        $( "#fdatepicker" ).datepicker();
        $( "#tdatepicker" ).datepicker();


    });
    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 40.730610, lng: -73.935242},
            zoom: 3
        });
        var markers = [];
        urlcall="ajaxCall.php?admin=yes&start=yes";

        $("#do").on("click",function(){
            var fd = $("#fdatepicker" ).val();
            var td = $("#tdatepicker" ).val();
            //alert(fd+td);
            urlcall="ajaxCall.php?admin=yes&fd=" + fd +"&td=" + td;
             for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }

            $.getJSON( urlcall , function(data) {
                $.each(data, function(k, v) {

                    for (var i = 0; i < v.length; i++) {
                        //alert(v);
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(v[1]), lng: parseFloat(v[2])},
                            map: map,
                            title: v[0]

                        });
                        markers.push(marker);
                    }

                });
            });

        });
        //---------------------------
        $.getJSON( urlcall , function(data) {
            $.each(data, function(k, v) {

                for (var i = 0; i < v.length; i++) {
                    //alert(v);
                    var marker = new google.maps.Marker({
                        position: {lat: parseFloat(v[1]), lng: parseFloat(v[2])},
                        map: map,
                        title: v[0]

                    });
                    markers.push(marker);
                }

            });
        });
        //--------------------------------

 }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-2Se6S4wJ-d-oNQvwKYO_xzm1uekjbVI&callback=initMap">

</script>

