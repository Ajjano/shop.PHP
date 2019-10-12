<h2>Admin</h2>
<?php if($_SESSION['login']):?>
<?php if(!isset($_POST['add_btn'])):?>
    <form action="index.php?page=4" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="category_id">Select category</label>
            <select name="category_id">
                <?php
                $pdo=Tools::connect();
                $list=$pdo->query('select * from categories');
                ?>
                <?php
                while($row=$list->fetch()):?>
                     <option value="<?=$row['id']?>"><?=$row['category']?></option>
                <?php endwhile;?>
            </select>
        </div>
        <div class="form-group">
            <label for="item_name">Name:</label>
            <input type="text" name="item_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Price In & Price Sale
                <input type="number" name="price_in" class="form-control">
                <input type="number" name="price_sale" class="form-control">
            </label>
        </div>
        <div class="form-group">
            <label for="info">Info:</label>
            <textarea  name="info" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="image_path">Select main image</label>
            <input type="file" name="image_path" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="image_path">Select other image</label>
            <input type="file" name="image_path_other[]" multiple="multiple" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="add_btn">Add new item</button>
    </form>
<? else:?>
    //main pic
    <?php
        if(is_uploaded_file($_FILES['image_path']['tmp_name'])) {
            $path = 'images/' . $_FILES['image_path']['name'];
            move_uploaded_file($_FILES['image_path']['tmp_name'], $path);
        }
        $item_id=$_POST['item_id'];
        $category_id = $_POST['category_id'];
        $price_in = $_POST['price_in'];
        $price_sale = $_POST['price_sale'];
        $item_name = $_POST['item_name'];
        $info = trim(htmlspecialchars($_POST['info']));
        $item = new Item($item_name, $category_id, $price_in, $price_sale, $info, $path);
        $err = $item->intoDb();
        if($err){
            echo  "<script>alert($err)</script>";
        }
        $pdo=Tools::connect();
        $ps=$pdo->prepare("select * from items order by id desc limit 1");
        $ps->execute();
        $id_item=$ps->fetch();
        echo "<script>console.log(".$id_item['id'].")</script>";

//        if(is_uploaded_file($_FILES['image_path_other']['tmp_name'])){
            foreach ($_FILES['image_path_other']['tmp_name'] as $_file=>$_temp){
                $_path = 'images/'.$_FILES['image_path_other']['name'][$_file];
                move_uploaded_file($_FILES['image_path_other']['tmp_name'][$_file], $_path);
                $pdo=Tools::connect();
                $ps=$pdo->prepare("insert into images(item_id, image_path) values (:item_id, :image_path )");
                $ps->execute(['item_id'=>$id_item['id'], 'image_path'=>$_path]);
                echo "<script>console.log(".$_file.")</script>";
            }
//        }
    ?>


<?php endif;?>
<?php else:?>
<?php  echo '<script>window.location="index.php?page=1";</script>';?>
<?php endif;?>
