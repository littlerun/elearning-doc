<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\search\Doc */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文档中心';
?>
<div class="doc-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'layout' => "{items}\n{pager}",
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showHeader' => false,
        'emptyText' => '还没有任何文档',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
        ],
    ]); ?>
</div>
