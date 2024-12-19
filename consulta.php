<?php
    include "conn.php";

    if($conn->connect_error){
        echo "server morreu".$conn->connect_errno;
    }else{
        $sql = "SELECT `escola` FROM `escola`;";
        $query = $conn->query($sql);
        $escola = [];
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $escola[] = $row["escola"];
            }
        }
        echo json_encode($escola);
        $conn->close();
    }
?>