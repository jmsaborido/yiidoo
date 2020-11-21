<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= !$model->completed ? Html::a('Completar Tarea', ['complete', 'id' => $model->id], ['class' => 'btn btn-warning']) : " " ?>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Añadir Etiquetas', ['/tags/create', 'task_id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= count($tags) ? '<p>Etiquetas: ' . implode(', ', $tags) . '</p>' : " " ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'deadline',
            'description:ntext',
            'completed:boolean',
        ],
    ]) ?>


    <?= !$model->completed ? Html::a('Borrar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estas seguro que quieres eliminar esta tarea?',
            'method' => 'post',
        ],
    ]) : ' ' ?>

</div>