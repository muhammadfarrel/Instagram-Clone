<?=
    $error = '';
    $u;
    
    if(isset($_GET['submit'])){
        if(empty($_GET['username']) || empty($_GET['password'])){
            header("Location: index.php");
        } else{
            session_start();
            $user = $_GET['username'];
            $pass = $_GET['password'];
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass; 
            $conn = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($conn, "instagram");

            $query = mysqli_query($conn, "select * from user where username = '$user' and password = '$pass'");

            $row = mysqli_num_rows($query);
            if($row == 1){
                header("Location: feed.php");
            }
            else{
                //header("Location: index.php");
            }
            mysqli_close($conn);
        }

    }

?>