<?php
    //mulai session
    session_start();
    //dia bakal ngambil data login cocokin dr database
    require "./conn.php";

    $login = false;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $pass = $_POST['password'];
        
        //Countermeasure SQL Injection -> prepared statement
        $query = "SELECT * FROM users WHERE Username = ? AND Pass = ?;";
        $stmt = $conf->prepare($query);
        $stmt = bind_param("ss", $username, $pass);
        $stmt ->execute();
        $result = $stmt->get_result();
        $result = $conf->query($query);

        //Countermeasure illegal access privillege
        if($result->num_rows == 1){
            echo "Login Success";
            $row = $result->fetch_assoc();

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['Username'];
            $_SESSION['pass'] = $row['Pass'];
            header("Location: "); //ini nanti lempar ke home main page
        }
        else{
            echo "Login Failed. Try Again.";
            header("Location: ../login.php");
        }
    }
?>