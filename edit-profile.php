<?php 
    //include("profile.php");
    session_start();
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];

    $conn = mysqli_connect("localhost", "root", "", "instagram");
    $query = mysqli_query($conn, "select * from user INNER JOIN `profile` on `user`.`username`=`profile`.`uname` where `user`.`username` = '".$user."' and `user`.`password` = '".$pass."'");
    while($row = mysqli_fetch_assoc($query)){
        $name = $row['name'];
        $uname = $row['username'];
        $bio = $row['bio'];
        $web = $row['web'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gender = $row['gender'];
    }

    if(isset($_GET['submit'])){
        $name = $_GET['name'];
        $uname = $_GET['usernm'];
        $bio = $_GET['bio'];
        $web = $_GET['website'];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $gender = $_GET['gender'];
        $query = "update `profile` set `name` = '$name', `web` = '$web', `bio` = '$bio', `email` = '$email', `phone` = '$phone', `gender` = '$gender' where `uname` = '$user'";
        if($uname == $user){

            if(mysqli_query($conn, $query)){
                header("Location: profile.php");
                mysqli_close($conn);
            }
            else{
                echo "gabisa goblog";
            }
        }
        else{
            $query = mysqli_query($conn, "update `user` INNER JOIN `profile` ON `user`.`username`=`profile`.`uname` set `username` = '$uname', `uname` = '$uname' WHERE `user`.`username` = '$user'");
            $query = "update `photo` set `usernm` = '$uname' where `usernm` = '$user'";
            if(mysqli_query($conn, $query)){ // query update username
                $query = "update `profile` set `name` = '$name', `web` = '$web', `bio` = '$bio', `email` = '$email', `phone` = '$phone', `gender` = '$gender' where `uname` = '$user'";
                if(mysqli_query($conn, $query)){
                    $_SESSION['user'] = $uname;
                    header("Location: profile.php");
                    mysqli_close($conn);
                }
                else{
                    echo "tidak bisa update profile ";
                }
            }
            else{
                echo "tidak bisa update username ";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile | Vietgram</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navigation">
        <div class="navigation__column">
            <a href="feed.php">
                <img src="images/logo.png" />
            </a>
        </div>
        <div class="navigation__column">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
        <div class="navigation__column">
            <ul class="navigations__links">
                <li class="navigation__list-item">
                    <a href="explore.html" class="navigation__link">
                        <i class="fa fa-compass fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="#" class="navigation__link">
                        <i class="fa fa-heart-o fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="profile.php" class="navigation__link">
                        <i class="fa fa-user-o fa-lg"></i>
                    </a>
                </li>
                <li class = "navigation__list-item">
                    <a href="uploud.php" class = "navigation__link">
                    <i class="fas fa-upload fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="edit-profile">
        <div class="edit-profile__container">
            <header class="edit-profile__header">
                <div class="edit-profile__avatar-container">
                    <img src="images/avatar.jpg" class="edit-profile__avatar" />
                </div>
                <h4 class="edit-profile__username"><?php echo $name ?></h4>
            </header>
            <form action="" class="edit-profile__form" method = "get">
                <div class="form__row">
                    <label for="full-name" class="form__label">Name:</label>
                    <input id="full-name"  name = "name" type="text" class="form__input" value="<?php echo $name ?>" />
                </div>
                <div class="form__row">
                    <label for="user-name" class="form__label">Username:</label>
                    <input id="user-name" type="text" name = "usernm" class="form__input" value = "<?php echo $uname ?>" />
                </div>
                <div class="form__row">
                    <label for="website" class="form__label">Website:</label>
                    <input id="website" type="text" name = "website" class="form__input" value="<?php echo $web ?>" />
                </div>
                <div class="form__row">
                    <label for="bio" class="form__label">Bio:</label>
                    <textarea id="bio" name="bio"><?php echo $bio ?></textarea>
                </div>
                <div class="form__row">
                    <label for="email" class="form__label">Email:</label>
                    <input id="email" type="email" name = "email" class="form__input" value="<?php echo $email ?>" />
                </div>
                <div class="form__row">
                    <label for="phone" class="form__label">Phone Number:</label>
                    <input id="phone" type="tel" name = "phone" class="form__input" value="<?php echo $phone ?>"/>
                </div>
                <div class="form__row">
                    <label for="gender" class="form__label">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="cant">Can't remember</option>
                    </select>
                </div>
                <input type="submit" value="Submit" name = "submit">
            </form>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__column">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">About Us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Language</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer__column">
            <span class="footer__copyright">© 2017 Vietgram</span>
        </div>
    </footer>
</body>

</html>