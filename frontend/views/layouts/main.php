<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="<?= Url::base() ?>/js/html5shiv.js"></script>
    <script src="<?= Url::base() ?>/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="glyphicon glyphicon-dashboard"></span> ' . Yii::$app->id,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'options' => [
            'class' => 'navbar-inverse navbar-static-top',
        ],
    ]);
    $navArr = [];
    if (Yii::$app->user->isGuest) {
        $navArr = [
            ['label' => '<span class="glyphicon glyphicon-new-window"></span> 前台', 
             'url' => Yii::$app->params['frontendBase'], 
             'linkOptions' => ['target' => '_blank']],
        ];
    } 
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $navArr
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; <a href="<?= Url::to(['site/flush']); ?>"><?=Yii::$app->id;?></a> <?= date('Y') ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>