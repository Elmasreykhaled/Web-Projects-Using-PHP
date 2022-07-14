<?php 

    session_start();
    if(empty($_SESSION['ID'])){
        header('location:../login.php');
    }
        $conn = mysqli_connect('localhost','root','mysqlpass','Bookstore');
        if(!$conn){
            die('error '.mysqli_connect_error());
        }else{
            $sql = "SELECT * FROM Accounts WHERE userMark ='".$_SESSION['ID']."';";
            $results = mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
            $res = $result[0];
            $uname = $res['uname'];
            $pass = $res['pass'];
            $email = $res['email'];
        }
        $errors = array('uname'=>'','pass'=>'','email'=>'');
        if(isset($_POST['edit'])){
            $uname = $_POST['uname'];
            if (empty($uname)){
                $errors['uname'] = 'This field is required';
            }else {
                if (string_validate($uname)){
                    $errors['uname'] ='';
                }else{
                    $errors['uname'] = "Only letters and numbers are allowed in username<br />";
            
                }
            }
            $pass = $_POST['pass'];
            if (empty($pass)){
                $errors['pass'] = 'This field is required';
            }else {
                if (string_validate($pass)){
                    $errors['pass'] ='';
                }else{
                    $errors['pass'] = "Only letters and numbers are allowed in password";
            
                }
            }
            $email = $_POST['email'];
            if (empty($email)){
                $errors['email'] = 'This field is required';
            }else {
                if (email_validate($email)){
                    $errors['email'] ='';
                }else{
                    $errors['email'] = "Only letters and numbers are allowed in password";
            
                }
            }
        }

        if (!array_filter($errors) and isset($_POST['edit'])){
            $userMark = $_SESSION['ID'];
            $sql = "SELECT uname,pass,email FROM Accounts WHERE userMark='".$userMark."';";
            $results = mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
            foreach($result as $res){
                    if ($res['uname']==$uname){
                        $errors['uname'] ='This username existed, try another';
                        break;
                    }elseif ($res['email']==$email){
                        $errors['email'] ='This email existed, try another';
                        break;
                    }
                }
            if (!array_filter($errors)){
                $sql = "update Accounts set uname = '".$uname."',pass = '".$pass."',email = '".$email."' where userMark = '".$userMark."';";
                $update = mysqli_query($conn,$sql);
                header('location:../settings.php');
            }
            


        }

        function string_validate($string){
            if(preg_match('/^[a-zA-Z0-9]+$/',$string)){
                return TRUE;
            }else{
                return FALSE;
            }
        }


        function email_validate($email){
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    

</head>
<body class="center-align">
    
    <nav>
            <div class="nav-wrapper  grey-text">
                <p class="brand-logo center">Book-Store</p>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="home.php">Home</a></li>
                <li class="active"><a href="settings.php">Settings</a></li>
                <li><a href="../process.php?logout">Logout</a></li>
            </ul>
            </div>
        
    </nav>
    <div class="p-3 mb-2 bg-light text-dark center-align">
        <div class="row border" >
            <h4 class="border">Edit Your info</h4>
            <form  class="col s12" action="" method="post">
                <div class="row">
                    <div class="col s12">
                    Username:
                    <div class="input-field inline">
                        <input id="user_inline" type="text" class="validate" name="uname" value="<?php echo htmlspecialchars($uname);?>">
                    </div>
                        <div class="red-text"><?php echo $errors['uname']; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    password:
                    <div class="input-field inline">
                        <input id="inputPassword" type="password" class="validate"name="pass" value="<?php echo htmlspecialchars($pass);?>">
                    </div>
                        <div class="red-text"><?php echo $errors['pass']; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    Email:
                    <div class="input-field inline">
                        <input id="email_inline" type="email" class="validate"name="email" value="<?php echo htmlspecialchars($email);?>">
                    </div>
                        <div class="red-text"> <?php echo $errors['email']; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <div class="submit-field inline">
                        <input id="submit_inline" type="submit" class="validate" value ="Edit" name ="edit">
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
        © Copyright For THE SCORP1ON
        </div>
    </div>
    </footer>
</body>
</html>