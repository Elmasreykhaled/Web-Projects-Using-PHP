<?php 
    session_start();
    $conn = mysqli_connect('localhost','root','mysqlpass','Bookstore');
    $cheak = FALSE;
    if(!$conn){
        die('error '.mysqli_connect_error());
    }else{
        $sql = "SELECT userMark FROM Accounts;";
        $results = mysqli_query($conn,$sql);
        $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
        if(!empty($result)){
            foreach($result as $res){
                if (array_search($_SESSION["ID"], $res, true)){
                    $cheak = TRUE;
                    break;
                }

        
            }
            
        }
    }
    if ($cheak){
        header('location:../home.php');
    }

    $uname = $pass = $SID = '';
    $errors = array('uname'=>'','pass'=>'');
    if(isset($_POST['login'])){
        $_SESSION["ID"] = $SID;
        $uname = $_POST['uname'];
        if (empty($uname)){
            $errors['uname'] = "wrong username or password";
            $errors['pass'] = "wrong username or password";
        }else {
            if (string_validate($uname)){
                $errors['uname'] = '';
            }else{
                $errors['uname'] = "wrong username or password";
                $errors['pass'] = "wrong username or password";
        
            }
        }
        $pass = $_POST['pass'];
        if (empty($pass)){
            $errors['uname'] = "wrong username or password";
            $errors['pass'] = "wrong username or password";
        }else {
            if (string_validate($pass)){
                $errors['pass'] = '';
            }else{
                $errors['pass'] = "wrong username or password";
                $errors['uname'] = "wrong username or password";
        
            }
        }
        if (!array_filter($errors)){
            if(!$conn){
                die('error '.mysqli_connect_error());
            }else{
                $sql = "SELECT * FROM Accounts WHERE uname='".$uname."' and pass='".$pass."';";
                $results = mysqli_query($conn,$sql);
                $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
                if(empty($result)){
                    $errors['pass'] = 'wrong username or password';
                    $errors['uname'] = 'wrong username or password';
                }else{
                    $sql = "SELECT userMark FROM Accounts WHERE uname='".$uname."' and pass='".$pass."';";
                    $results = mysqli_query($conn,$sql);
                    $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
                    $SID = $result[0]['userMark'];
                    $_SESSION["ID"] = $SID;
                    header('location:../home.php');
                }

                mysqli_free_result($results);
                mysqli_close($conn);
            }

        }
    }
    function string_validate($string){
        if(preg_match('/^[a-zA-Z0-9]+$/',$string)){
            return TRUE;
        }else{
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <div class="p-3 mb-2 bg-light text-dark center-align">
        
        <div class="row border" >
            <h4 class="border">Login</h4>
            <form  action="" method="post" class="col s12" >
                <div class="row">
                    <div class="col s12">
                    Username:
                    <div class="input-field inline">
                        <input id="user_inline" type="text" class="validate" name="uname">
                    </div>
                        <div class="red-text"><?php echo $errors['uname']; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    password:
                    <div class="input-field inline">
                        <input id="inputPassword" type="password" class="validate"name="pass">
                    </div>
                        <div class="red-text"><?php echo $errors['pass']; ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <div class="submit-field inline">
                        <input id="submit_inline" type="submit" class="validate" value ="Login" name ="login">
                    </div>
                    </div>
                </div>
            </form>
            <a href="signup.php">Sign up</a>
        </div>
    </div>  
    
</body>
</html>