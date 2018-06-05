<!------------------------------------------------
    Created on 2018/05/31 by Joel Barr
    for Travel Experts Threaded Project
    PROJ-207-B  OOSD Spring 2018, SAIT
------------------------------------------------->
<!doctype="html">
<html>
<head>
    <title>Travel Experts - Account</title>
    <?php include "php/stdhead.php"; ?>
</head>

<body>
    <!-- <header> -->
    <?php include "php/header.php" ?>

    <!-- <nav> -->
    <?php include "php/nav.php" ?>

<div class="container">
    <section>
        <h2>My Information</h2>
        <!-- TODO: This information should be read from the database -->
        <!-- <tr id='namerow' class='hover-border'> -->
        <div id='accordion'>
            <div class='row'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#nameform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <b>Name: </b>
                Joel Barr
            </div>
            <form class='collapse' data-parent='#accordion' id='nameform' name='nameform' action="">
                <div class='form-row'>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for='fname'>First Name</label>
                        <input type='text' class='form-control' id='fname' name='fname' value='Joel' />
                    </div>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for='lname'>Last Name</label>
                        <input type='text' class='form-control' id='fname' name='lname' value="Barr" />
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="namesubmit" value="Submit" />
                </div>
            </form>
            <div class='row'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#phoneform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <strong>Phone: </strong>
                403-555-5520 (Business)<br>
                403-555-4555 (Home)
            </div>
            <form class='collapse' data-parent='#accordion' id='phoneform' name='phoneform'>
                <div class='form-row'>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='bphone'>Business</label>
                        <input type='text' class='form-control' id='bphone' name='bphone' value='403-555-5520' />
                    </div>
                    <div class=' form-group col-sm-4 col-md-3'>
                        <label for='hphone'>Home</label>
                        <input type='text' class='form-control' id='bphone' name='hphone' value='403-555-4555' />
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="phonesubmit" value="Submit" />
                </div>
            </form>
            <div class='row'>
                <button class='btn btn-link' data-toggle='collapse' data-target='#addrform'>
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <strong>Address:</strong>
                4519 Vargas St NE<br>
                Calgary, AB<br>
                T3K 0M6
            </div>
            <form class='collapse' data-parent='#accordion' id='addrform' name='addrform'>
                <div class='form-row'>
                    <div class='form-group col-sm-8 col-md-6'>
                        <label for='streetaddr'>Street</label>
                        <input type='text' class='form-control' id='streetaddr' name='streetaddr' value='4519 Vargas St NE'/>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='city'>City</label>
                        <input type='text' class='form-control' id='city' name='city' value='Calgary'/>
                    </div>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='prov'>Province</label>
                        <input type='text' class='form-control' id='prov' name='prov' value='AB'/>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-group col-sm-4 col-md-3'>
                        <label for='postcode'>Postal Code</label>
                        <input type='text' class='form-control' id='postcode' name='postcode' value='T3K 0M6' />
                    </div>
                </div>
                <div class='form-group'>
                    <input type="submit" class='btn btn-default' name="addrsubmit" value="Submit" />
                </div>
            </form>
        </div> <!-- </accordion> -->
        <br />
        <!-----------------------
            My Orders
        ------------------------->
        <h2>My Orders</h2>
        <div class='row'>
            <p class='col-3 col-md-2 col-xl-2'>Booking ID</p>
            <p class='col-9 col-md-10 col-lg-7'>Information</p>
        </div>
        <div class='row bg-2'>
            <div class='col-3 col-md-2 col-lg-2'>35653B</div>
            <div class='col-9 col-md-10 col-lg-7'>
                <div class='row'>
                    <p class='col-md-4 col-lg-3'><strong>London, England</strong></p>
                    <p class='col-md-8 col-lg-9'>2016-05-09 until 2016-06-03</p>
                </div>
                <div class='row'>
                    <p class='col'>All-inclusive European tour</p>
                </div>
                <div class='row'>
                    <div class='col-4 col-lg-3'>
                        <b>Date Placed</b><br>2000-05-04
                    </div>
                    <div class='col-4 col-lg-3'>
                        <b>Travelers</b><br>1
                    </div>
                    <div class='col-4 col-lg-3'>
                        <b>Type</b><br>Leisure
                    </div>
                </div>
            </div>
        </div>

        <!-- TODO: Sign in button can be removed once php is active -->
        <button onclick="window.location.href = 'signin.html'">Sign In</button>
    </section>
</div>

    <!-- <footer> -->
    <?php include "php/footer.php" ?>
</body>
</html>
