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
    $uname = $pass =$email= '';
    $errors = array('uname'=>'','pass'=>'','email'=>'');
    if(isset($_POST['signup'])){
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
                $errors['email'] = "Only letters and numbers are allowed in email";
        
            }
        }

        if (!array_filter($errors)){
            if(!$conn){
                die('error '.mysqli_connect_error());
            }else{
                $randomString = generateRandomString();
                $sql = "SELECT * FROM Accounts;";
                $results = mysqli_query($conn,$sql);
                $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
                foreach($result as $res){
                    if ($res['uname']==$uname){
                        $errors['uname'] ='This username existed, try another';
                        break;
                    }elseif ($res['email']==$email){
                        $errors['email'] ='This email existed, try another';
                        break;
                    }elseif ($res['userMark']==$randomString){
                        while(TRUE){
                            $randomString = generateRandomString();
                            if ($res['userMark']!=$randomString){
                                break;
                            }
                        }
                        break;
                    }
                }
                if (!array_filter($errors)){

                    $sql = "insert into Accounts(uname, pass, email, userMark) values('".$uname."','".$pass."', '".$email."', '".$randomString."');";
                    $Insert = mysqli_query($conn,$sql);
                    $SID = $randomString;
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


    function email_validate($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <div class="p-3 mb-2 bg-light text-dark center-align">
        
        <div class="row border" >
            <h4 class="border">sing up</h4>
            <form  class="col s12" method="post">
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
                        <input id="submit_inline" type="submit" class="validate" value ="Sign up" name="signup">
                    </div>
                    </div>
                </div>
            </form>
            <a href="login.php">Login</a>
        </div>
    </div>  
    
</body>
</html>