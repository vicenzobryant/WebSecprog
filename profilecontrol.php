<?php
    require "./conn.php";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $username = $_SESSION['username'];
        $Id = $_SESSION['Id'];
        $length = strlen($username);
        if($length < 10){ 
            header("Location: ./profile.php");
            LOG_ALERT("Character must be between 10-50")
        } else if($length > 50) {
            header("Location: ./profile.php");
            LOG_ALERT("Character must be between 10-50")
        } else {
            $user_bio = $_POST['$user_bio']
            $query = "UPDATE profile SET bio = ?  WHERE Id=? AND Username=?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $user_bio,$Id, $username);
            if($stmt ->execute()){
                echo "Profile Updated"
            }else{
                echo "Unexpected Error Occured"
            }
            $conn->close();
        }
?>