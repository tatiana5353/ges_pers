<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <div id="login-page">
        <div class="container">

            <div class="login-wrap">
                <!-- <div class="panel" style="background-color: blue; color: white;"> -->
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-2"></div>
                                <div class="col-lg-5 col-md-8 login-box" style="background: #0000FF;
    font-family: 'Roboto', sans-serif">
                                    <div class="col-lg-12 login-key" style="margin-top: 75px;
                                        height: auto;
                                    
                                        text-align: center;
                                       
                                        height: 100px;
                                        font-size: 80px;
                                        line-height: 100px;
                                        background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-lg-12 login-title mt-3" style=" margin-top: 15px;
                                            text-align: center;
                                            font-size: 30px;
                                            letter-spacing: 2px;
                                            margin-top: 20px;
                                            margin-bottom: 30px;
                                            font-weight: bold;
                                            color: #ECF0F5;">
                                       SE CONNECTER
                                    </div>
                                    <?= $content ?>
                                </div>
                            </div>
                        </div>
                    </div>
               


            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    <script type="template/text/javascript" src="template/lib/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("template/img/logo.jpg", {
            speed: 500
        });
    </script>
</body>

</html>
<?php $this->endPage();
