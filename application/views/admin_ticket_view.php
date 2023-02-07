<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pending Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <div class="container mt-3">
    <?php

            //Check in database
            echo "<table class='table'>
            <thead>
                <tr>
                <th scope='col'>Ticket_id</th>
                <th scope='col'>Customer_id</th>
                <th scope='col'>Ticket_Description</th>
                <th scope='col'>Ticket_Status</th>
                <th scope='col'>Ticket_Time</th>
                <th scope='col'>Attachment</th>
                </tr>
            </thead>
            <tbody>";
            // $sql = "SELECT * FROM `tickets` where Ticket_status=1 order by Time";
            // $result = mysqli_query($conn,$sql);
            // $num = mysqli_num_rows($result);
            $num = count($tickets);
            if ($num>=1) {
                foreach ($tickets as $row){
                    echo "<tr>";
                    echo "<th scope='row'>".$row->Ticket_id."</th>";
                    echo "<td>".$row->Customer_id."</td>";
                    echo "<td colspan='1'>".$row->Ticket_description."</td>";
                    echo "<td>"."To-do"."</td>";
                    $gmt = $row->Time;
                    $time = strtotime($gmt); //returns an integer epoch time: 1401339270
                    echo "<td>".date('m/d/Y H:i:s', $time)."</td>";
                    if ($row->Ticket_file  == '') {
                        echo "<td>" . "No Attachment" . "</td>";
                        echo "</tr>";
                    } else {
                        echo "<td>" .
                            "<form method='post' action='service/admin_attachment_view' target='_blank'>
                        <input type='hidden'  name='ticket_filename' value =" . $row->Ticket_file  . ">" .
                            "<button type='submit' style='height: 30px;font-size:15px;border-radius:5px;' name='submit' value='View'>View</button>"
                            . "</form></td>";
                            echo "</tr>";
                    }
                }
                echo "</tbody> </table>";
                
            }
            else{
                echo "There was an error";
            }


    ?>
        
    </div>

</body>
</html>
