<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Doc */

$this->title = '创建文档';
?>
<div class="doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
