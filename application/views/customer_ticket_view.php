<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <div style="text-align: center;margin-top:3vh;">
            <h3>Submit a New Ticket</h3>
        </div>
        <div>
            <form id="Ticket_Form" name="Ticket_Form" method="POST"><!--   method="post"  action="customer_ticket_submit.php" enctype="multipart/form-data" -->
                <div class="submit_ticket">
                    <div><textarea name="ticket_title" rows="1" cols="50" id="title" style="resize:none;" placeholder="Add a Title to your Ticket"></textarea></div>
                    <div style="flex-grow: 3;"><textarea name="ticket_description" rows="4" cols="50" id="description">Add a Description to your Ticket</textarea></div>
                    <div><input type="file" id="myFile" name="file">
                    <input type="hidden" name="ticket_status" id="ticket_status" value=1>
                    <input type="submit" onclick="submit_Ticket(event);"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="flex-content">
        <div>
            <h5>Previously Submitted Tickets</h5>
        </div>
        <div class="display-table">
            <?php
                if (false) {
                    header("Location: http://localhost/practice/index.php", TRUE, 302);
                } else {
                    // $c_id = $_SESSION['c_id'];
                    // $servername = 'localhost';
                    // $username = 'root';
                    // $password = '';
                    // $db = 'service_desk';
                    // $conn = mysqli_connect($servername, $username, $password);
                    // mysqli_select_db($conn, $db);
                        //Check in database
                        echo "<table id='display_table'>
                    <thead>
                        <tr>
                        <th scope='col'>Ticket_id</th>
                        <th scope='col'>Ticket_Description</th>
                        <th scope='col'>Ticket_Status</th>
                        <th scope='col'>Ticket_Time</th>
                        <th scope='col'>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>";
                        // $sql = "SELECT * FROM `tickets` where Customer_id='$c_id' order by Time DESC";
                        // $result = mysqli_query($conn, $sql);
                        // $num = mysqli_num_rows($result);
                        $num = count($tickets);
                        if ($num >= 1) {
                        
                            foreach ($tickets as $row)
                            {
                                echo "<tr>";
                                echo "<td scope='row'>" . $row->Ticket_id . "</td>";
                                echo "<td colspan='1'>" . $row->Ticket_description  . "</td>";
                                if ($row->Ticket_status  == 1) {
                                    echo "<td>" . "Submitted" . "</td>";
                                } else if ($row->Ticket_status  == 3) {
                                    echo "<td>" . "In - Progress" . "</td>";
                                } else if ($row->Ticket_status  == 5) {
                                    echo "<td>" . "Resolved" . "</td>";
                                } else if ($row->Ticket_status  == 2) {
                                    echo "<td>" . "Under Review" . "</td>";
                                } else if ($row->Ticket_status  == 4) {
                                    echo "<td>" . "Soon to be Resolved" . "</td>";
                                }
                                $gmt = $row->Time ;
                                $time = strtotime($gmt); //returns an integer epoch time: 1401339270
                                echo "<td>" . date('d/m/Y, H:i:s A', $time) . "</td>";
                                if ($row->Ticket_file  == '') {
                                    echo "<td>" . "No Attachment" . "</td>";
                                    echo "</tr>";
                                } else {
                                    // echo "<td>" .
                                    //     "<form method='post' action='service/customer_attachment_view' target='_blank'>
                                    // <input type='hidden'  name='ticket_filename' value =" . $row->Ticket_file . ">" .
                                    //     "<button type='submit' style='height: 30px;font-size:15px;border-radius:5px;' name='submit' value='View'>View</button>"
                                    //     . "</form></td>";
                                    echo "<td>";
                                    echo " <a href= './Customer_uploads/".$row->Ticket_file."' target='_blank'>View</a>" ;
                                    echo "</td>";
                                        echo "</tr>";
                                }
                            }
                        
                                echo "</tbody> </table>";
                        } else {
                            echo "<h3>No previous tickets Submitted</h3>";
                        }
                    }
            ?>
        </div>
    </div>
    <script>
        function submit_Ticket(e) {
            e.preventDefault();
            let t_form = document.getElementById("Ticket_Form");
            // document.getElementById("testing").innerHTML = t_form.elements[1];
            // alert(t_form.elements[2].value);
            var data = new FormData(Ticket_Form);

            if (true) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && xmlhttp.status == 200) {
                        console.log(this.responseText);
                        json = this.responseText;
                        response = JSON.parse(this.responseText);
                        let t_id = response[0]['Ticket_id'];
                        let t_des = response[0]['Ticket_description'];
                        let t_status = response[0]['Ticket_status'];
                        switch (t_status) {
                            case '1':
                                t_status = 'Submitted';
                                break;
                            case '2':
                                t_status = 'In - Progress';
                                break;
                            case '3':
                                t_status = 'Resolved';
                                break;
                            case '4':
                                t_status = 'Under Review';
                                break;
                            case '5':
                                t_status = 'Soon to be Resolved';
                                break;


                        }
                        let time = response[0]['Time'];
                        var s = new Date(time).toLocaleString(undefined, {
                            timeZone: 'Asia/Kolkata'
                        });
                        // s.format("DD-MM-YYYY HH:mm:ss");
                        let file = response[0]['Ticket_file'];

                        let link = `<form method='post' action='service/customer_attachment_view' target='_blank'> 
                                      <input type='hidden'  name='ticket_id' value ="` + t_id + ` "> <button type='submit' style='height: 30px;font-size:15px;border-radius:5px;' name='submit' value='View'>View</button></form>`;

                        var d_table = document.getElementById("display_table");
                        var row = d_table.insertRow(1);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);

                        cell1.innerHTML = t_id;
                        cell2.innerHTML = t_des;
                        cell3.innerHTML = t_status;
                        cell4.innerHTML = s;
                        if(file!=''){
                            cell5.innerHTML = link;
                        }
                        else{
                            cell5.innerHTML = 'No Attachment';

                        }
                        // console.log(response);
                        // alert("Success");
                    }
                };
                // xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.open('POST', "service/customer_ticket_submit", true);
                xmlhttp.send(data);

            }
            // console.log(document.getElementsByClassName('table'));

            // function myFunction() {
            //     var table = document.getElementById("myTable");
            //     var row = table.insertRow(0);
            //     var cell1 = row.insertCell(0);
            //     var cell2 = row.insertCell(1);
            //     cell1.innerHTML = "NEW CELL1";
            //     cell2.innerHTML = "NEW CELL2";
            // }

        }
    </script>
    <p id="testing">
</body>
</html>