<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrarForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Registrar usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Introduzca los siguientes datos para registrarse:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => ['wrapper' => 'col-sm-5'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

    <div class="form-group">
        <div class="offset-sm-2">
            <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>