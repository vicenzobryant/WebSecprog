<?php
    //mulai session
    session_start();
    //dia bakal ngambil data login cocokin dr database
    require "./conn.php";

    $login = false;

    //var penghitungan failed login dan diset 0 countnya
    $failedlogin = isset($_SESSION['failedlogin']); //? $_SESSION['failedlogin'] : 0;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $username = $_POST['username'];
        $length = strlen($username);
        if($length < 6){ 
            header("Location: ../login.php");
        } else if($length > 16) {
            header("Location: ../login.php");
        }

        //$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'); anti xss (example)
        $pass = $_POST['password'];

        // Countermeasure SQL Injection -> prepared statement
        $query = "SELECT * FROM users WHERE Username=? AND Passwd=?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $pass);
        $stmt ->execute();
        $result = $stmt->get_result();
        $conn->close();

        //Countermeasure illegal access privillege
        if($result->num_rows == 1){
            echo "Login Success";
            $row = $result->fetch_assoc();

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['Username'];
            $_SESSION['pass'] = $row['Passwd'];

            // header("Location: "); //ini nanti lempar ke home main page

            $_SESSION['failedLogin'] = 0;
        }
        else{
            //karena gagal, start count failed login
            $_SESSION['failedLogin']++;
            $maxFailedAtt = 2;

            if($_SESSION['failedLogin'] >= $maxFailedAtt){
                //lock account
                $_SESSION['lockAccess'] = time() + 60 * 1;
                //further action for new login attempt
                if(time() < $_SESSION['lockAccess']){
                    echo "Your account has been locked. Try again later.";
                }
                else{
                    $_SESSION['failedLogin'] = 0;
                    unset($_SESSION['lockAccess']);
                }
            }

            // echo "Login Failed. Try Again.";
            // header("Location: ../login.php");
            echo "<script>window.location.href='../login.php?error=1';</script>";
        }
    }
?>