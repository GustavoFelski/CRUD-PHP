<?php
    include'dbConnection.php';

    if(isset($_POST['btnSave'])){
        $PName  = $_POST['txtName'];
        $PPrice = $_POST['txtPrice'];
    

        if(!empty($PName && $PPrice)){
            $insert = $pdo->prepare("insert into tbl_product(productName,productPrice) values (:name,:price)");
            $insert->bindParam(':name', $PName);
            $insert->bindParam(':price', $PPrice);

            $insert->execute();
            if ($insert->rowCount()){
                echo'insert successful';
            }else
                echo'insert fail';

        }else{
            echo'TextBox Empty';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>
<body>
<h2>Insert</h2>
<form action="" method="post">
    <p><input type="text" name="txtName" placeholder="Product Name"></p>
    <p><input type="text" name="txtPrice" placeholder="Product price"></p>
    <p><input type="submit" value="save" name="btnSave"></p>
    
</form>
<hr>
<h2>Reading</h2>
<?php 
    $select = $pdo->prepare('select * from tbl_product');
    $select->execute();
    echo"<pre>";
    
    //we can use fetchall() to select all data and withot a loop and also using a diferent scopes
    //$row = $select->fetch(PDO::FETCH_OBJ);
    //print_r($row);

    while($row = $select->fetch(PDO::FETCH_OBJ)){
        //echo $row[1]."<br>"; fetch(PDO::FETCH_NUM
        //echo $row['productName']."<br>"; fetch(PDO::FETCH_ASSOC
        //echo $row->productName."<br>"; fetch(PDO::FETCH_OBJ
        echo 'Product Id:'.$row->id_product.' Product Name:'.$row->productName.' product Price:'.$row->productPrice."<hr>";
        
        //print_r($row);
    }

  

?>

</body>
</html>