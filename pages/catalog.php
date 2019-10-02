
<?php
$pdo=Tools::connect();
$ps=$pdo->prepare("select * from items");
$ps->execute();
$rows=ceil($ps->rowCount()/4);
$ps1=$pdo->prepare('select * from categories');
$ps1->execute();
?>
<div class="row">
    <div class="cool-md-6">
        <h2>Catalog</h2>
    </div>
    <div class="col-md-6 clearfix form-inline">
        <select name="category_id" id="sel_category" class="pull-right form-control">
            <?php while ($row=$ps1->fetch()):?>
                <option value="<?=$row['id']?>"><?=$row['category']?></option>
            <?endwhile;?>
        </select>

    </div>
</div>
<div class="catalog">
    <?php for($i=0;$i<$rows;$i++):?>
        <div class="row">
            <?php for($j=0;$j<4;$j++):?>
                <?php if($row=$ps->fetch()):?>
                    <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading"><?=$row['item_name']?></div>
                            <div class="panel-body" style="height: 200px">
                                <img src="<?=$row['image_path']?>" alt="pict" class="center-block" style="max-width:100%;margin: 0 auto;max-height: 100%;">

                            </div>
                            <div class="panel-footer clearfix">
                                <div class="pull-left"><?=$row['price_sale']?></div>
                                <div class="pull-right">
                                    <button data-cart="<?="cart_".$row['id']?>" class="btn btn-primary btn_to_cart">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            <?php endfor;?>
        </div>
    <?php endfor;?>
</div>
