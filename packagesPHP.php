<?php
    function getPackageDetails($packageId)
    {
      $date = date('Y-m-d');
      $dbc = mysqli_connect("127.0.0.1","admin","pass","travelexperts");
      $redirect = 'order.php';
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
            echo "<b><span style='$style'>Start Date:</b> $row[2]</span><br>";
            echo "<b>End Date:</b> $row[3]<br>";
            echo "<b>Package Cost:</b> $row[5]<br>";
            echo "<form action='$redirect?orderpackageid=$row[0]' method='post'>
            <input id='orderButton' type='submit' class='btn btn-info btn-md' value='Order Now!'>
            </form>";
          }
        }
      }
    mysqli_close($dbc);
  }
?>
