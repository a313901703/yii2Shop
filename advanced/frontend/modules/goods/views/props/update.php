<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;

?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
