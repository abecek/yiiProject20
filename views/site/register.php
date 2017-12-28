<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create new account:</p>
        <?php
            if(Yii::$app->session->hasFlash('succcess')){
                echo Yii::$app->session->getFlash('success');
            }

            //TEST
            $data = Yii::$app->db->createCommand('Select count(id_user) liczba from users ')->queryOne();
            echo  "Liczba userow: " . $data['liczba'];
            //TEST2
            use app\models\User;
            $usersAll = User::find()->indexBy('id_user')->all();
            echo "<br>Liczba2 userow: " . count($usersAll) . "<br>";
            var_dump($usersAll[1]);
    ?>

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->input('email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'gender')->radioList([
            'M' => 'Man',
            'K' => 'Woman',
        ])->label('Gender');
        ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
