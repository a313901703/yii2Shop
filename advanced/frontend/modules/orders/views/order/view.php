<?php
$this->title = '订单-'.$model['id'];
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['/orders']];
$this->params['breadcrumbs'][] = $model['id'];
?>
<div class="table-content">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan=5>
                    <div class="pull-left">
                        <span>
                            订单状态:
                            <span class="text text-<?= $model->getOrderStatus()['status']; ?>">
                                <?= $model->getOrderStatus()['value']; ?>
                            </span> 
                        </span>
                    </div>
                    <div class="pull-right"><?= date('Y-m-d H:i:s',$model['created_at']) ?></div>
                </th>
            </tr>
            <tr>
                <th>商品ID</th>
                <th>商品名称</th>
                <th>商品属性</th>
                <th>价格</th>
                <th>数量</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model['products'] as $product): ?>
            <tr>
                <td><?=$product['product']['id'] ?></td>
                <td><?=$product['product']['name'] ?></td>
                <td><?=$product['props'] ?></td>
                <td>￥<?=$product['price'] / 100 ?></td>
                <td><?=$product['nums'] ?></td>
            </tr>  
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <span>订单金额: ￥<?=$model['total'] / 100 ?> </span>
                </td>
            </tr>
        </tfoot>
    </table>
    <?php  echo $this->render('_operate', ['model' => $model]); ?>
</div>