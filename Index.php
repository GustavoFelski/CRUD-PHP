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
    if(isset($_POST['btnUpdate'])){
        $PName  = $_POST['txtName'];
        $PPrice = $_POST['txtPrice'];
        $PId = $_POST['IdProduct'];

        if(!empty($PName && $PPrice)){
            /*
            $update = $pdo->prepare("update tbl_product set productName=:name , productPrice=:price) where id_product =".$Pid;
            $updade->bindParam(':name', $PName);
            $updade->bindParam(':price', $PPrice);

            $updade->execute();
            if ($updade->rowCount()){
                echo'update successful';
            }else
                echo'update fail';
            */
        }else{
            echo'TextBox Empty';
        }
    }
    if(isset($_POST['btnCancel'])){
        $PName  = $_POST['txtName'];
        $PPrice = $_POST['txtPrice'];
    

        if(!empty($PName && $PPrice)){
            
            /*$insert = $pdo->prepare("insert into tbl_product(productName,productPrice) values (:name,:price)");
            $insert->bindParam(':name', $PName);
            $insert->bindParam(':price', $PPrice);

            $insert->execute();
            if ($insert->rowCount()){
                echo'insert successful';
            }else
                echo'insert fail';
            */
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

    <!--UPDATE -->
    <?php
        flush();
        if(isset($_POST['btnEdit'])){
            $select = $pdo->prepare("select * from tbl_product where id_product=".$_POST['btnEdit']);
            $select->execute();
            if($select){
                $row = $select->fetch(PDO::FETCH_OBJ);
                echo'
                    <p><input type="hidden" name="IdProduct" value="'.$row->id_product.'"></p>
                    <p><input type="text" name="txtName" value="'.$row->productName.'"></p>
                    <p><input type="text" name="txtPrice" value="'.$row->productPrice.'"></p>
                    <button type="submit" name="btnUpdate" >Update</button>
                    <button type="submit" name="btnCancel" >Cancel</button>
                    
                ';

            }

        }else{
            echo '
                <p><input type="text" name="txtName" placeholder="Product Name"></p>
                <p><input type="text" name="txtPrice" placeholder="Product price"></p>
                <p><input type="submit" value="save" name="btnSave"></p>
            ';
        }

    ?>
    <!--
    <p><input type="text" name="txtName" placeholder="Product Name"></p>
    <p><input type="text" name="txtPrice" placeholder="Product price"></p>
    -->
</form>
<form action="" method="post">
<hr>
<h2>Reading</h2>
<table id="productTable">
    <thead>
        <th>ID </th>
        <th>Product Name </th>
        <th>Product Price </th>
        <th>EDIT</th>
        <th>DELETE</th>
    </thead>
    <tbody>    
    <?php 
    $select = $pdo->prepare('select * from tbl_product');
    $select->execute();
    
    //we can use fetchall() to select all data and withot a loop and also using a diferent scopes
    //$row = $select->fetch(PDO::FETCH_OBJ);
    //print_r($row);


    while($row = $select->fetch(PDO::FETCH_OBJ)){
        //echo $row[1]."<br>"; fetch(PDO::FETCH_NUM
        //echo $row['productName']."<br>"; fetch(PDO::FETCH_ASSOC
        //echo $row->productName."<br>"; fetch(PDO::FETCH_OBJ
        echo '
        <tr>
            <td>'.$row->id_product.'</td>
            <td>'.$row->productName.'</td>
            <td>'.$row->productPrice.'</td>
            
            
            <td><button type="submit" name="btnEdit" value="'.$row->id_product.'">EDIT</button></td>
            <td><button type="submit" name="btnDelete" value="'.$row->id_product.'">DELETE</button></td>
        </tr>    
        ';
    }
    ?>
    </tbody>
</table>
</form>
</body>
</html>