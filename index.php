<!DOCTYPE html>
<html>
<head>
    <title>Apple Push Notification Service || VU Mobile</title>
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAABfX18AaGhoAPv7+wBxcXEApaWlAOvr6wBhYWEAycnJAGpqagD9/f0Ac3NzAGNjYwBsbGwA////ANTU1AB1dXUAqampAGVlZQDNzc0Abm5uAHd3dwBVVVUAXl5eAGdnZwCbm5sAcHBwAK2trQC2trYAYGBgAGlpaQD8/PwAcnJyAEdHRwCEhIQAYmJiAGtrawD+/v4AdHR0ALGxsQCGhoYAurq6AO7u7gBkZGQAw8PDAG1tbQBUVFQAXV1dAMXFxQBmZmYAmpqaANfX1wCsrKwAioqKAOnp6QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADQ0NDQ0NDQ0NDQ0NDQ0NJA0NDQ0NDQkNDQ0NDQ0NDQ0NDQ0NDRInLzIxIQIkDQ0NDQ0NDQ4AHCIuBgYAHg0NDQ0NDQIVKiIqIiIiHDQkDQ0kDQ0rIgsRMDAXETAWJA0NDQ0NDxcBAR0IHQgdDQ0NCQ0JDRQwLCMjLBMsMw0NDQ0NCQ0KHQMKLBkfLBANDQ0NDQ0NBAAKJQoPJR8fDQ0NDQ0NDQkgLjAwFzAMCBoNDQ0NDQ0NJAcoDRsYGjUNJA0NDQ0NDQ0NDQ0tCg0kDQ0NDQ0NDQ0NDQ0NKREmDQ0NDQ0NDQ0NDQ0NDQ0NBQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA="
          rel="icon" type="image/x-icon"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript">

        var startFrom1 = 10;
        var endTo1 = 20;

        $(document).ready(function () {

            $.ajax({
                type: 'POST',
                url: 'sticker_list.php',
                data: ({startFrom: 0, endTo: 10}),
                success: function (data) {
                    // alert(data);
                    $("#myStickerData").html(data);

                }
            });

// Disable previous button by default
            $('#btnPrev').prop('disabled', true);

            $("#btnPrev").click(function () {
                if (startFrom1 != 0) {
                    startFrom1 -= 10;
                    endTo1 -= 10;
                }

                if (startFrom1 >= 0) {
                    $.ajax({
                        type: 'POST',
                        url: 'sticker_list.php',
                        data: ({startFrom: startFrom1, endTo: endTo1}),
                        success: function (data) {
                            // alert(data);
                            $("#myStickerData").html(data);

                            startFrom1 -= 10;
                            endTo1 -= 10;

                        }
                    });
                } else {
                    $('#btnPrev').prop('disabled', true);
                }

            });


            $("#btnNext").click(function () {
                if (startFrom1 <= 0) {
                    startFrom1 = 0;
                    endTo1 = 10;
                }

                $.ajax({
                    type: 'POST',
                    url: 'sticker_list.php',
                    data: ({startFrom: startFrom1, endTo: endTo1}),
                    success: function (data) {
                        // alert(data);
                        $("#myStickerData").html(data);

                        startFrom1 += 10;
                        endTo1 += 10;

                    }
                });

                enableDisable();

            });


            function enableDisable() {
                if (startFrom1 == 0) {
                    $('#btnPrev').prop('disabled', true);
                } else {
                    $('#btnPrev').prop('disabled', false);
                }

            }


            $("#btnSearch").click(function () {
                var a = document.getElementById("searchInput").value;
                $.ajax({
                    type: 'POST',
                    url: 'sticker_search.php',
                    data: ({mySearchValue: a}),
                    success: function (data) {
                        // alert(data);
                        $("#myStickerData").html(data);

                    }
                });

            });


        });


    </script>

</head>
<body>


<div class="container">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height: 120px; overflow: hidden; margin-bottom: 20px; background: gray; text-align: center;">
        <img src="apple_logo.png" alt="LOGO" style="width:50px; padding: 6px;"/>
        <br>
        <h3 style="color: #fff; margin-top: 0; font-size: 18px">Apple Push Notification Service</h3>
        <h4 style="color: #fff; font-size: 13px">VU Mobile Ltd.</h4>
    </div>

    <div class="row">
        <div class="col-md-12" style="text-align: center;">

            <?php
            include 'apnsSend.php';
            ?>


            <input placeholder="Search sticker..." class="width:300px" id="searchInput" type="text" name="search"
                   class="form-control"/>
            <button type="button" id="btnSearch" class="btn btn-primary">Search</button>
            <br/>


            <br>

            <form action="index.php" method="POST">


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">

                    <label for="message" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Notification Message: </label>
                    <textarea style="width:350px;" placeholder="Message..." type="text" name="message" id="message"
                              maxlength="100" required></textarea> <br/><br/>

                    <br/>

                    <button type="button" id="btnPrev" class="btn btn-primary">PREV</button>
                    <button type="button" id="btnNext" class="btn btn-primary">NEXT</button>

                    <div id="myStickerData">
                        <!-- ajax data here -->
                    </div>

                    <input class="btn btn-danger" type="submit" name="Send Notification" value="Send Notification"/>
                </div>

            </form>

            <br/>


        </div>
    </div>
</div>
<p>Powered by VU Mobile</p>

</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<style type="text/css">
    .table {
        border-radius: 5px;
        width: 50%;
        margin: 0px auto;
        float: none;
    }


</style>

</html>

