<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tags */

Yii::debug($model->task_id);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tareas', 'url' => ['tasks/index']];
$this->params['breadcrumbs'][] = ['label' => $model->tasks->title, 'url' => ['/tasks/view', 'id' => $model->task_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tags-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'tasks.title'
        ],
    ]) ?>

</div>