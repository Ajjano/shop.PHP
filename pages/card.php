<h2>Cart</h2>

<?php
$total=0;
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_COOKIE as $key=>$value):?>
            <?php $pos=strpos($key, '_');?>
            <?php if(substr($key, 0, $pos)=='cart'):?>
                <?php
                $item_id=substr($key, $pos+1);
                $item=Item::fromDb($item_id);
                $total+=$item->Price;
                ?>
                <tr>
                    <td style="width: 200px;"><img src="<?= $item->Image?>" alt="" class="img-responsive"></td>
                    <td><?= $item->Name?></td>
                    <td><?= $item->Price?></td>
                    <td><span data-target="<?= $item->Id?>" class="glyphicon glyphicon-remove" style="cursor: pointer"></span></td>
                </tr>
            <?php endif;?>
        <?php endforeach;?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">Total:</td>
        <td><?= $total?></td>
    </tr>
    </tfoot>
</table>
<button class="btn btn-primary pull-right btn_buy">Buy</button>

