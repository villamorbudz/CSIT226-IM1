<?php 
    include("includes/imports.php");
    include("includes/header-guest.php");
    include('includes/footer-omasas.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Contact Us | Eventify</title>
        <link rel="stylesheet" href="css/css.css">
    </head>

    <body>
        <div class="center-wrapper">
            <section class="PageContent center-wrapper">
                <p class="header-contactUs">Got Questions?</p>
                <h1 class="header-aboutUs padding3em">Contact Us</h1>
                <form class="bgCustom">
                    <div class="flex-wrapper">
                        <div class="flex-wrapper-column">
                            <label class="label-form" for="fname">First Name:</label>
                            <input class="box-form" type="text" name="fname" id="fname" placeholder="Your First Name">
                        </div>
                        <div class="flex-wrapper-column">
                            <label class="label-form" for="lname">Last Name:</label>
                            <input class="box-form" type="text" name="lname" id="lname" placeholder="Your Last Name">
                        </div>
                    </div>

                    <div>
                        <div class="flex-wrapper-column">
                            <label class="label-form" for="e-address">Email Address:</label>
                            <input class="box-form" type="text" name="e-address" id="e-address" placeholder="example@email.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex-wrapper-column">
                            <label class="label-form" for="user-id">User ID (if applicable): </label>
                            <input class="box-form" type="text" name="user-id" id="user-id" placeholder="XXXX-XXX-XXXX">
                        </div>
                    </div>

                    <div>
                        <div class="flex-wrapper-column">
                            <label class="label-form" for="query">Query: </label>
                            <textarea class="box-form" name="query" rows="3" placeholder="Enter your query here"></textarea>
                        </div>
                    </div>
                    
                </form>
            </section>
        </div>
    </body>
</html>