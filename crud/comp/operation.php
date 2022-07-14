<?php
require_once ("print.php");
require_once ("component.php");

$con = print_good();
if (isset($_POST['create'])){
    createData();
}

if (isset($_POST['update'])){
    UpdateData();
}

if (isset($_POST['remove'])){
    deleteRecord();
}


function createData(){
    $book_name = textbox_value('book_name');
    $book_publisher = textbox_value('book_publisher');
    $book_price = textbox_value('book_price');
    if ($book_name && $book_price && $book_publisher){
        $sql = "
        INSERT INTO books(book_name,book_publisher,book_price)
        VALUES ('$book_name','$book_publisher','$book_price')
        ";
        if (mysqli_query($GLOBALS['con'], $sql)){
            Text_Node("success","Added");
        }else{
            echo "Error";
        }
    }else{
        Text_Node("error","Please Complete Values");

    }
}
function textbox_value($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

function Text_Node($class, $msg){
    $ele = "<h6 class='$class'>$msg</h6>";
    echo $ele;
}


function getData(){
    $sql = "SELECT* FROM books";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }
}


function UpdateData(){
    $book_id = textbox_value("book_id");
    $book_name = textbox_value("book_name");
    $book_publisher = textbox_value("book_publisher");
    $book_price = textbox_value("book_price");
    if ($book_price && $book_publisher && $book_name){
        $sql = "
        UPDATE books SET book_name = '$book_name',
        book_publisher = '$book_publisher',
        book_price = '$book_price' WHERE id = '$book_id'
        
        ";
        if (mysqli_query($GLOBALS['con'], $sql)){
            Text_Node("success", "Updated");
        }else{
            Text_Node("error", "Can't Update");
        }

    }else{
        Text_Node("error", "Select Data With Edit Icon");
    }

}

function deleteRecord(){
    $book_id =(int)textbox_value("book_id");
    $sql = "
    DELETE FROM books WHERE id = '$book_id'
    ";
    if (mysqli_query($GLOBALS['con'], $sql)){
        Text_Node("success", "Removed");
    }else{
        Text_Node("error", "Select Data With Edit Icon");
    }
}
