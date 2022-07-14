<?php 
    if (isset($_GET['logout'])){
   
        session_start();
        session_unset();
        session_destroy();
        header('location:../login.php');
    }

    if (isset($_GET['delet'])){
        $id = $_GET['delet'];
        $sql = "DELETE FROM Books WHERE id='".$id."';";
        $conn = mysqli_connect('localhost','root','mysqlpass','Bookstore');
        if(!$conn){
            die('error '.mysqli_connect_error());
        }else{
            $DELET = mysqli_query($conn,$sql);
            mysqli_close($conn);
            header('location:../home.php');
    }

    }
    

?>