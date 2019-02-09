<?php
    include ('connection.php');

    $school = $_POST["school"];

    if($school=="PRC") {
        $addressLat = "18.7962058";
        $addressLng = "99.0031853";
    }
    if($school=="DARA") {
        $addressLat = "18.799239";
        $addressLng = "99.0099283";
    }

    $sql = "SELECT * FROM car WHERE Lat <= $addressLat + 0.018 and Lat >= $addressLat - 0.018 and Lng <= $addressLng + 0.018 and Lng >= $addressLng - 0.018 
    and school = '$school'";
    
    $result = mysqli_query($connect,$sql);

        echo"<table style='border: 1px solid black'>";
            echo"<tr style='border: 1px solid black'>";
                echo"<th style='border: 1px solid black'>ID</th>";
                echo"<th style='border: 1px solid black'>DRIVER</th>";
                echo"<th style='border: 1px solid black'>SEAT</th>";
            echo"</tr>";
            if($result) {
                while ($row = mysqli_fetch_assoc($result)) {    
                    echo"<tr style='border: 1px solid black'>";
                        echo"<th style='border: 1px solid black'>".$row['id_car']."</th>";
                        echo"<th style='border: 1px solid black'>TU</th>";
                        echo"<th style='border: 1px solid black'>1</th>";
                    echo"</tr>";
                }
            } 
        echo"</table>";
                    
                        
                         
        
    
    
            
    

