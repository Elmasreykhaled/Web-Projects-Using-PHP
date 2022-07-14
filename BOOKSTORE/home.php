<?php 

    session_start();
    $SID = $_SESSION['ID'];
    if(empty($SID)){
        header('location:../login.php');
    }else{
?>
<?php
    $conn = mysqli_connect('localhost','root','mysqlpass','Bookstore');
    if(!$conn){
        die('error '.mysqli_connect_error());
    }else{
        $sql = 'SELECT * FROM Books';
        $results = mysqli_query($conn,$sql);
        $result = mysqli_fetch_all($results,MYSQLI_ASSOC);
        mysqli_free_result($results);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book-Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    

</head>
<body>
    
    <nav>
            <div class="nav-wrapper  grey-text">
                <p class="brand-logo center">Book-Store</p>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li class="active"><a href="home.php">Home</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="../process.php?logout">Logout</a></li>
            </ul>
            </div>
        
    </nav>


    <div class="p-3 mb-2 bg-light text-dark center-align">
        <?php if($SID=='admin'){ ?>
            <a href="add.php" class="waves-effect waves-light btn"><i class="material-icons left">add</i>ADD</a><br />
        <table class="table table-striped table-hover">

            
            <thead >
                <tr>
                <th scope="col">#</th>
                <th scope="col ">Name</th>
                <th scope="col "class="left-align">Price</th>
                <th scope="col" colspan="2">Actions</th>

                </tr>
            </thead>

            <tbody>
                
                <?php 
                    $i = 0;
                    foreach($result as $res){
                        $i++
                ?>
            
                    <tr>
                    <th scope="row "><?php echo htmlspecialchars($i) ?></th>
                    <td class ="center"><?php echo htmlspecialchars($res['name']); ?></td>
                    <td><?php echo htmlspecialchars($res['price']); ?>$</td>
                    <td class="right-align">
                        <a href="edit.php?edit=<?php echo htmlspecialchars($res['id']);?>"><button type="button" class="btn btn-outline-dark btn-sm">EDIT</button></a>
                    </td>
                    <td class="left-align">
                        <a href="process.php?delet=<?php echo htmlspecialchars($res['id']);?>"><button type="button" class="btn btn-outline-danger btn-sm">DELET</button></a>
                    </td>
                    </tr>
                <?php }?>
                
            </tbody>
        </table>
        <?php }else{ ?>


        <table class="table table-striped table-hover">

            
            <thead >
                <tr>
                <th scope="col">#</th>
                <th scope="col ">Name</th>
                <th scope="col "class="left-align">Price</th>
                </tr>
            </thead>

            <tbody>
                
                <?php 
                    $i = 0;
                    foreach($result as $res){
                        $i++
                ?>
            
                    <tr>
                    <th scope="row "><?php echo htmlspecialchars($i) ?></th>
                    <td class ="center"><?php echo htmlspecialchars($res['name']) ?></td>
                    <td><?php echo htmlspecialchars($res['price']) ?>$</td>
                    </tr>
                <?php }?>
                
            </tbody>
        </table>
        <?php }?>
    </div>







    <footer class="page-footer center">
        <div class="footer-copyright">
            <div class="container">
            © Copyright For THE SCORP1ON
            </div>
        </div>
    </footer>
</body>

</html>
<?php }?>