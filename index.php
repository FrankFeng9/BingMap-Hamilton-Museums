<?php
require_once "./connect.php";
$sql = "select * from map";
$stmt = $dbh->query($sql);
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<head>
    <title>Bing Map</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<html>
<body>
<div class="container">
    <div class="row">
        <div class="information">
            
            <div class="headimg" id="headimg">
                <img id="img1" src="<?php echo $row[0]['IMG1'] ?>" alt="">
                <img id="img2" src="<?php echo $row[0]['IMG2'] ?>" alt="">
            </div>
            <div class="content">
                <div ><p id="Name"><?php echo $row[0]['NAME'] ?></p></div>
                <div ><p id="Address"><?php echo $row[0]['ADDRESS'] ?></p></div>
                <div ><p id="Community"><?php echo $row[0]['COMMUNITY'] ?></p></div>
                <div >
                    <a id="Url" href="<?php echo $row[0]['URL'] ?>"><?php echo $row[0]['URL'] ?></a>
                </div><br>
                <div ><span>Hours:</span><p id="Open Hours"><?php echo $row[0]['Hours'] ?></p></div>
                <div ><span>Rating:</span><p id="Rating"><?php echo $row[0]['Rating'] ?><span> / 5 </span></p></div>
                <div ><p id="Reviews"><?php echo $row[0]['review_numbers'] ?><span> reviews</span></p></div>
                <input type="hidden" id="id" value="<?php echo $row[0]['OBJECTID'] ?>"/>

            </div>
            <button type="button" class="btn" id="alternative" data-toggle="modal" data-target="#myModal">Review
            </button>
            <button type="button" class="btn" id="adult" data-toggle="modal" data-target="#Target">Ticket</button>
            <button type="button" class="btn" onclick="directions(<?php  echo $row[0]['LATITUDE'] ?>,<?php  echo $row[0]['LONGITUDE'] ?>)" id="directionBtn">Direction</button>
        </div>

        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">X</button>
                        <div class="modal-title">Rate this place</div>
                    </div>
                    <div class="modal-body">
                        <div class="starability-container">
                            <input name="starNum" id="starNum" type="hidden"/>
                            <fieldset class="starability-slot">
                                <input type="radio" id="rate_1_0_1_5" name="starLevel" value="5"/>
                                <label for="rate_1_0_1_5" title="5 star"></label>
                                <input type="radio" id="rate_1_0_1_4" name="starLevel" value="4"/>
                                <label for="rate_1_0_1_4" title="4 star"></label>
                                <input type="radio" id="rate_1_0_1_3" name="starLevel" value="3"/>
                                <label for="rate_1_0_1_3" title="3 star"></label>
                                <input type="radio" id="rate_1_0_1_2" name="starLevel" value="2"/>
                                <label for="rate_1_0_1_2" title="2 star"></label>
                                <input type="radio" id="rate_1_0_1_1" name="starLevel" value="1"/>
                                <label for="rate_1_0_1_1" title="1 star"></label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" onclick="evaluation();">submit</button>
                        <button class="btn btn-primary" data-dismiss="modal">cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="Target">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">X</button>
                        <div class="modal-title">Ticket booking</div>
                    </div>
                    <div class="modal-body">
                        <div class="up">
                            <div class="left">
                                <div class="input-group">
                                    <p style="width: 90px">adult ticket</p>&nbsp;<p
                                            id="adult_ticket"><?php echo $row[0]['Adult_Ticket_Rate'] ?></p>
                                    <button class="btn" onclick="down(this)">-</button>
                                    <input id="adultnum" type="text" value="0">
                                    <button class="btn" onclick="add(this)">+</button>
                                    <p></p>
                                </div>
                                <div class="input-group">
                                    <p style="width: 90px">senior ticket</p>&nbsp;<p
                                            id="senior_ticket"><?php echo $row[0]['Senior_Ticket_Rate'] ?></p>
                                    <button class="btn" onclick="down(this)">-</button>
                                    <input id="seniornum" type="text" value="0">
                                    <button class="btn" onclick="add(this)">+</button>
                                    <p></p>
                                </div>
                                <div class="input-group">
                                    <p style="width: 90px">children ticket</p>&nbsp;<p
                                            id="children_ticket"><?php echo $row[0]['Children_Ticket_Rate'] ?></p>
                                    <button class="btn" onclick="down(this)">-</button>
                                    <input id="childnum" type="text" value="0">
                                    <button class="btn" onclick="add(this)">+</button>
                                    <p></p>
                                </div>
                                <div class="input-group">
                                    <p style="width: 90px">student ticket</p>&nbsp;<p
                                            id="student_ticket"><?php echo $row[0]['Student_Ticket'] ?></p>
                                    <button class="btn" onclick="down(this)">-</button>
                                    <input id="studentnum" type="text" value="0">
                                    <button class="btn" onclick="add(this)">+</button>
                                    <p></p>
                                </div>
                            </div>
                            <div class="right">
                                <p>adults ages 18 to 59</p>
                                <p>senior ages 60 to above</p>
                                <p>children ages 6 to 12</p>
                                <p>students ages 13 to 17</p>
                                <p>Free for children ages 5 adn under</p>
                            </div>
                        </div>
                        <div class="middle">Total:<input id="total" type="text" style="width: 80px"></div>
                        <div class="down">
                            <p id="message"></p>
                            Card number:<br>
                            <input type="text" id="cardnum">
                            <br>
                            Name on card:<br>
                            <input type="text" id="card">
                            <br>
                            Expiration data:<br>
                            <input id="meeting" type="date" value="2021-02-22"/>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" onclick="submitotal();">submit</button>
                        <button class="btn btn-primary" data-dismiss="modal">cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="map" id='myMap'></div>

        <div id='panel' class="panel">
            
            <div id='direction'></div>
            
        </div>
    </div>
</div>
<!-- <form id='input'>
  <p id="message"></p>
  Name:<br>
  <input type="text" id="name">
  <br>
  Address:<br>
  <input type="text" id="address">
  <br><br>
  <input type="submit" value="Submit">

</form> -->

<!--<script type='text/javascript' src="locations.js"></script>-->
<script type='text/javascript'>
    var newPosition;
    var directionsManager;
    var searchManager;
    var locations = <?php echo json_encode($row);?>;
    
    $('[name="starLevel"]').bind("click", function () {
        $("#starNum").val($(this)[0].value)
    })

    /**
     * 
     * @returns {boolean}
     */
    function evaluation() {
     
        let customerEvaluationLevel = $("#starNum").val();
        let id = document.getElementById("id").value;
        if (customerEvaluationLevel == undefined || customerEvaluationLevel == null || customerEvaluationLevel == '') {
            alert('Please rate the place');
            return false;
        }
        $.post("rate.php", {rate: customerEvaluationLevel, id: id}, function (result) {
            if (result == '1') {
                window.location.reload()
                return;
            }
        });
        //clear
        $("input[type='radio']").attr("checked", false)
    }

    /**
     * ticketing
     */
    function submitotal() {
        let total = $("#total").val();
        let cardnum = $("#cardnum").val();
        let name = $("#card").val();
        let id = document.getElementById("id").value;
        if(total.length == 0) {
            alert("Please choose the admission");
            return;
        }
        if(cardnum.length == 0) {
            alert("card number not null!");
            return;
        }
        if(name.length == 0) {
            alert("card Name not null");
            return;
        }
        $.post("order.php", {total: total, cardnum:cardnum, card:card, id: id}, function (result) {
            if (result == '1') {
                alert("success");
                window.location.reload();
                return;
            } else{
                alert("fail")
            }
        });
    }
    /**
     * get total
     * */
    function getval() {
        let adultnum = $("#adultnum").val();
        let adult_ticket = $("#adult_ticket").html().slice(1);
        let seniornum = $("#seniornum").val();
        let senior_ticket = $("#senior_ticket").html().slice(1);
        let childnum = $("#childnum").val();
        let children_ticket = $("#children_ticket").html().slice(1);
        let studentnum = $("#studentnum").val();
        let student_ticket = $("#student_ticket").html().slice(1);
        let total = adultnum*adult_ticket+seniornum*senior_ticket+childnum*children_ticket+studentnum*student_ticket;
        return total
    }
    function add(e) {
        e.parentNode.children[3].value++
        let total = this.getval();
        $("#total").val('$'+total)
    }

    function down(e) {
        let num = e.parentNode.children[3].value;
        num >=1 ? e.parentNode.children[3].value--:0
        let total = this.getval();
        $("#total").val('$'+total)
    }


    function loadMapScenario() {

        document.getElementById('panel').style.visibility = "hidden";
        // create a Map, centered in Hamilton
        var map = new Microsoft.Maps.Map(
            document.getElementById('myMap'), {
                center: new Microsoft.Maps.Location(43.2557, -79.871)
            });

        //Create an infobox at the center of the map
        infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
            visible: false
        });
        //Assign infobox to map
        infobox.setMap(map);


        //load mudule driction
        Microsoft.Maps.loadModule('Microsoft.Maps.Directions',
            function () {
                directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
                // Set Route Mode to driving
                directionsManager.setRequestOptions({
                    routeMode: Microsoft.Maps.Directions.RouteMode.driving
                });
            });


        directions = function directions(latitude, longitude) {
           document.getElementById('panel').style.visibility = "visible";
            directionsManager.clearAll();
            if (newPosition != null) {
                var waypoint1 = new Microsoft.Maps.Directions.Waypoint({
                    location: newPosition
                });
            }
            var waypoint2 = new Microsoft.Maps.Directions.Waypoint({
                location: new Microsoft.Maps.Location(latitude, longitude)
            });
            if (directionsManager != null) {
                directionsManager.addWaypoint(waypoint1);
                directionsManager.addWaypoint(waypoint2);
                // Set the element in which the itinerary will be rendered
                directionsManager.setRenderOptions({
                    itineraryContainer: document.getElementById('direction')
                });
                directionsManager.calculateDirections();
            }
        }

        /* //clear drection
        document.getElementById("clear").addEventListener("click", function () {
            directionsManager.clearAll()
            infobox.setOptions({
                visible: false
            });
        }); */

       // user  geolocation
        var message = document.getElementById("message");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            message.innerHTML = "Geolocation is not supported by this browser.";
        }

        //show user position
        function showPosition(position) {

            newPosition = new Microsoft.Maps.Location(position.coords.latitude, position.coords.longitude);

            var userPushpin = new Microsoft.Maps.Pushpin(
                newPosition, {
                    text: 'I',
                    color: 'yellow'
                });

            //add to map
            map.entities.push(userPushpin);
            //create infobox for user
            var infobox = new Microsoft.Maps.Infobox(newPosition, {
                title: "you are here"
                
            });
            infobox.setMap(map)
        }



         //show error function  
      function showError(error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            message.innerHTML = "User denied the request for Geolocation."
            break;
          case error.POSITION_UNAVAILABLE:
            message.innerHTML = "Location information is unavailable."
            break;
          case error.TIMEOUT:
            message.innerHTML = "The request to get user location timed out."
            break;
          case error.UNKNOWN_ERROR:
            message.innerHTML = "An unknown error occurred."
            break;
        }
      }


        // Loop over the  data contained in locations
        for (i = 0; i < locations.length; i++) {
            // create a new location for the school
            var location = new Microsoft.Maps.Location(
                locations[i].LATITUDE,
                locations[i].LONGITUDE
            );

            // create a pushpin at this location
            var pushpin = new Microsoft.Maps.Pushpin(
                location);

            //Store some metadata with the pushpin.
            pushpin.metadata = {
                description: "<a href='" + locations[i].URL + "'>" + locations[i].NAME + "</a>" + '</br></br>' +
                "<a href='#' onclick='directions(" + locations[i].LATITUDE + "," + locations[i].LONGITUDE + ");" +
                "'><b>directions <b></a>"

            };
            pushpin.data = locations[i]
            Microsoft.Maps.Events.addHandler(pushpin, 'click', pushpinClicked);
            //add pushpin
            map.entities.push(pushpin);
        }

        //click push pin
        function pushpinClicked(e) {
            $("#total").val(null);
            $("#adultnum").val(0);
            $("#seniornum").val(0);
            $("#childnum").val(0);
            $("#studentnum").val(0);
            document.getElementById("Name").innerHTML = e.target.data.NAME;
            document.getElementById("Address").innerHTML = e.target.data.ADDRESS;
            document.getElementById("Community").innerHTML = e.target.data.COMMUNITY;
            document.getElementById("Url").innerHTML = e.target.data.URL;
            document.getElementById("Url").href = e.target.data.URL;
            document.getElementById("id").value = e.target.data.OBJECTID;
            document.getElementById("Open Hours").innerHTML = e.target.data.Hours;
            document.getElementById("Rating").innerHTML = e.target.data.Rating;
            document.getElementById("Reviews").innerHTML = e.target.data.review_numbers;
            document.getElementById("img1").src = e.target.data.IMG1;
            document.getElementById("img2").src = e.target.data.IMG2;
            document.getElementById("adult_ticket").innerHTML = e.target.data.Adult_Ticket_Rate;
            document.getElementById("senior_ticket").innerHTML = e.target.data.Senior_Ticket_Rate;
            document.getElementById("children_ticket").innerHTML = e.target.data.Children_Ticket_Rate;
            document.getElementById("student_ticket").innerHTML = e.target.data.Student_Ticket;
            document.getElementById("directionBtn").addEventListener('click', function () {
                var latitude = e.target.data.LATITUDE;
                var longitude = e.target.data.LONGITUDE;
                document.getElementById('panel').style.visibility = "visible";
                directionsManager.clearAll();
                // if (newPosition != null) {
                //     var waypoint1 = new Microsoft.Maps.Directions.Waypoint({
                //         location: newPosition
                //     });
                // }
                var waypoint2 = new Microsoft.Maps.Directions.Waypoint({
                    location: new Microsoft.Maps.Location(latitude, longitude)
                });
                if (directionsManager != null) {
                    // directionsManager.addWaypoint(waypoint1);
                    directionsManager.addWaypoint(waypoint2);
                    // Set the element in which the itinerary will be rendered
                    directionsManager.setRenderOptions({
                        itineraryContainer: document.getElementById('direction')
                    });
                    directionsManager.calculateDirections();
                }
            });

            //Make sure the infobox has metadata to display.
            if (e.target.metadata) {
                //Set the infobox options with the metadata of the pushpin.

                infobox.setOptions({
                    location: e.target.getLocation(),
                    description: e.target.metadata.description,
                    visible: true,
                });
            }
        }

       


       


       

    }
</script>
<script type='text/javascript'
        src='https://www.bing.com/api/maps/mapcontrol?key=AkqrF0Y6CXDepLJmh1hnsVTRVqhJuP-yA-xXnI0sineLPeQRybOA6_YucZBrkOHu&callback=loadMapScenario'
        async defer></script>
</body>

</html>