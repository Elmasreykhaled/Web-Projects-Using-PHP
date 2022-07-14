<?php 
    session_start();
    $SID = $_SESSION['ID'];
    if($SID!='admin'){
        header('location:../home.php');
    }else{
        $name = $price ='';
        $errors = array('name'=>'','price'=>'');
        if (isset($_POST['add'])){
            $name = $_POST['name'];
            if (empty($name)){
                $errors['name'] = 'This field is required';
            }else{
                    $name = htmlspecialchars($name);
                    $name = filter_var($name, FILTER_SANITIZE_STRING);
            }
            $price = $_POST['price'];
            if (empty($price)){
                $errors['price'] = 'This field is required';
            }elseif(!is_numeric($price)){
                $errors['price']= 'Only Numbers are allowed';
            }

        }
        if (!array_filter($errors) and isset($_POST['add'])){

            $conn = mysqli_connect('localhost','root','mysqlpass','Bookstore');
            if(!$conn){
                die('error '.mysqli_connect_error());
            }else{
                $sql = "insert into Books(name, price) values('".$name."','".$price."');";
                $Insert = mysqli_query($conn,$sql);
                header('location:../home.php');
                mysqli_close($conn);
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body class="center">

    <nav>
        <div class="nav-wrapper  grey-text">
            <p class="brand-logo center">Book-Store</p>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="home.php">Home</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="../process.php?logout">Logout</a></li>
        </ul>
        </div>
            
    </nav>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <h2>Add a new book</h2><br><br><br>
                    <form action="" method="post" class='center'>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label for="name"><h5>Please Enter the book-name</h5></label>
                                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name);?>">
                            </div>
                            <div class="red-text"><?php echo $errors['name']; ?></div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <label for="price"><h5>Please Enter the book-price</h5></label>
                                <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($price);?>">
                            </div>
                            <div class="red-text"><?php echo $errors['price']; ?></div>
                        </div>
                        <br><input type="submit" value="ADD" class="larg btn" name="add"><br><br>

                    </form>
                </div>
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





<?php }?>