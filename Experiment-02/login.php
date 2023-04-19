<?php
session_start();
include("class/connect.php");
include("class/login.php");
include("class/user.php");
include("class/post.php");
$email = "";
$password = "";
$post = new Post();
$posts = $post->get_post();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $login = new Login();
    $result = $login->evaluate($_POST);
    if ($result != "") {
        echo "<div style='text-align:center;font: size 12px;color:white;background-color:grey;'>";
        echo "the following errors occured<br>";
        echo $result;
        echo "</div>";
    } else {
        $id = $_SESSION['fb_userid'];
        $login = new Login();
        $result = $login->check_login($id);
        $user = new User();
        $user_data = $user->get_data($id);
        $email = $user_data['email'];
        $fn = $user_data['first_name'];
        $ln = $user_data['last_name'];
        $g = $user_data['gender'];
        $c = mysqli_connect("localhost", "root", "", "mouli_86");
        $q1 = "insert into actusers(userid,email,first_name,last_name,gender) values('$id','$email','$fn','$ln','$g')";
        $rr = mysqli_query($c, $q1);
        header("Location:profile.php");
        die;
    }

    //$password=$_POST['password'];
    // $email=$_POST['email'];
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        #bar {
            height: 80px;
            background-color: lightblue;
            color: #d9dfeb;
            font-size: 60px;
        }

        #signup_button {
            background-color: #42b72a;
            width: 110px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
        }

        #bar2 {
            background-color: aliceblue;
            width: 500px;
            margin: auto;
            margin-top: 100px;
            text-align: center;
            padding-top: 50px;
            font-weight: bold;
            float: left;
            padding: 20px;
            border: 2px solid black;
        }

        #text {
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border: solid 1px black;
            padding: 4px;
            font-size: 14px;
        }

        #button {
            width: 300px;
            height: 40px;
            border-radius: 4px;
            border: none;
            background-color: green;
            color: white;
        }



        .lki {
            height: 1600px;
            width: 800px;
        }
    </style>
</head>

<body>
    <div id="bar">

        <marquee behavior="scroll" direction="right">Welcome to Facebook</marquee>


    </div>
    <div id="lk">
        <div id="bar2" class="lki">
            <?php
            if ($posts) {
                foreach ($posts as $ROW) {
                    $user = new User();
                    // $ROW_USER=$user->get_user($ROW['userid']);
                    include("posts.php");
                }
            }

            ?>

        </div>
        <div id="bar2" style="float:right;">
            <form action="" method="post">
                <h3>Log in to facebook
                    <h3><br><br>
                        <input value="<?php echo $email ?>" type="text" name="email" id="text" placeholder="Email or phone number"><br><br>
                        <input value="<?php echo $password ?>" type="password" name="password" id="text" placeholder="Password"><br><br>
                        <input type="submit" name="" id="button" value="Login"><br><br><br>
                        <h3> Dont have a Account..</h3>
                        <a href="signup.php">Sign up</a>
            </form>
        </div>
    </div>
</body>

</html>