<?php

use yii\helpers\Html;

?>
<?php foreach ($data as $key => $value): ?>
    <tr>
        <?php foreach (explode(',', $value) as $item): ?>
           <td><?=$item?></td> 
        <?php endforeach ?>
        <td><input type="text" name="propsPrice[<?=$key;?>]" class="form-control"></td>
        <td><input type="text" name="propsCost[<?=$key;?>]" class="form-control"></td>
        <td><input type="text" name="propsStock[<?=$key;?>]" class="form-control"></td>
    </tr>
<?php endforeach ?>
