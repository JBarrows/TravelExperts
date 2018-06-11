<!--Programmer: Jonah Aubin  /Joel Barr (helped with the date formatting)
This php is a simple database connector for the packages page to allow our website to obtain data and display it to the page
from the database. We pass through a session variable packageId to obtain which package was selected from the user side-->
<?php
    function getPackageDetails($packageId)
    {
      $date = date('Y-m-d');
      $dbc = mysqli_connect("localhost","root","","travelexperts");
      $redirect = 'order.php';
      //Connection to database
      if(!$dbc)
      {
        echo "Error Number:".mysqli_connect_errno().PHP_EOL;
        echo "Error Message:".mysqli_connect_error().PHP_EOL;
        exit;
      }
      else
      {
        $query = "SELECT * FROM packages WHERE PackageID = '$packageId'";
        $result = mysqli_query($dbc,$query);
        if ($result)
        {
          while ($row=mysqli_fetch_row($result))
          {
            if(strtotime($row[2]) <= strtotime($date))
            {
              $style = 'color:red;';
            }
            else
            {
              $style = '';
            }
            echo "<b>Package Name:</b> $row[1]<br>";
            echo "<b>Package Description:</b> $row[4]<br>";
            echo "<b><span style='$style'>Start Date:</b> ".date('d-m-Y', strtotime($row[2]))."</span><br>";
            echo "<b>End Date:</b> ".date('d-m-Y', strtotime($row[3]))."<br>";
            echo "<b>Package Cost:</b> \$".number_format($row[5])."<br>";
		  echo "<form action='$redirect?orderpackageid=$row[0]&packagename=$row[1]' method='post'>
            <input id='orderButton' type='submit' class='btn btn-info btn-md' value='Order Now!'>
            </form>";
            // echo "</div>";
          }
        }
      }
    mysqli_close($dbc);
  }
?>
