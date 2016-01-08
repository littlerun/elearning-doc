<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \xj\ueditor\Ueditor;

/* @var $this yii\web\View */
/* @var $model common\models\Doc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'content')->widget(Ueditor::className(), [
        'style' => 'width:100%;height:400px',
        'renderTag' => true,
        'readyEvent' => 'console.log("example2 ready")',
        'jsOptions' => [
            'serverUrl' => yii\helpers\Url::to(['upload']),
            'autoHeightEnable' => true,
            'autoFloatEnable' => false
        ]
    ]);?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->hiddenInput(['value'=>time()])->label(FALSE) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['value'=>time()])->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
