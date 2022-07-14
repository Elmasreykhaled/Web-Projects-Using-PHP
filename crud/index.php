<?php
    require_once("../crud/comp/component.php");
    require_once ("../crud/comp/operation.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <script src="https://kit.fontawesome.com/28c59dcc3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">

</head>
<body>
<main>
    <div class="container text-center">
        <h1 class="py-4 text-light bg-dark"><i class="fas fa-book"></i> B00K ST0RE</h1>

        <div class="d-flex justify-content-center">
            <form action="" method="post" class="w-50" >
                <div class="pt-2">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-success"><i class="fas fa-swatchbook"></i></div>
                        </div>
                        <input type="text" name="book_id" value="" autocomplete="off" class="form-control" id="inlineFormInputGroup" placeholder="id">
                    </div>
                </div>
                <div class="pt-2">
                    <?php comp('<i class="fas fa-id-badge"></i>', 'Book Name', 'book_name', ''); ?>
                </div>
                <div class="row pt-2">
                    <div class="col">
                        <?php comp('<i class="fas fa-pen-square"></i>', 'Publisher', 'book_publisher', ''); ?>
                    </div>
                    <div class="col">
                        <?php comp('<i class="fas fa-dollar-sign"></i>', 'Price', 'book_price', ''); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <!--buttons-->
                    <?php But('create', "dat-toggle='tooltip' data-placement='bottom' title='Create'", '<i class="fas fa-plus-square"></i>', 'btn-create', 'btn btn-warning'); ?>
                    <?php But('read', "dat-toggle='tooltip' data-placement='bottom' title='Read'", '<i class="fas fa-sync"></i>', 'btn-read', 'btn btn-primary'); ?>
                    <?php But('update', "dat-toggle='tooltip' data-placement='bottom' title='Update'", '<i class="fas fa-pencil-alt"></i>', 'btn-update', 'btn btn-light border'); ?>
                    <?php But('remove', "dat-toggle='tooltip' data-placement='bottom' title='Remove'", '<i class="fas fa-trash"></i>', 'btn-remove', 'btn btn-danger'); ?>
                </div>
            </form>
        </div>
        <div class="d-flex table-data" id="sel">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Publisher</th>
                    <th>Book price</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_POST['read'])) {
                        $result =getData();
                        if ($result){
                            while ($row = mysqli_fetch_assoc($result)){?>

                    <tr>
                        <td data-id="<?php echo $row['id'];?>"><?php echo $row['id'];?></td>
                        <td data-id="<?php echo $row['id'];?>"><?php echo $row['book_name'];?></td>
                        <td data-id="<?php echo $row['id'];?>"><?php echo $row['book_publisher'];?></td>
                        <td data-id="<?php echo $row['id'];?>"><?php echo '$'.$row['book_price'];?></td>
                        <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['id'];?>"></i></td>
                    </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                    <!-- -->
                </tbody>
            </table>
        </div>
    </div>
</main>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src = "../crud/comp/main.js"></script>
</body>
</html>