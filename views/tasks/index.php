<?php

use kartik\date\DatePicker;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tareas de ' . $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear tareas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'title',
                'headerOptions' => ['style' => 'width:20%'],
            ],
            [
                'attribute' => 'deadline',
                'format' => 'date',
                'headerOptions' => ['style' => 'width:20%'],
                'filter' => DatePicker::widget([
                    'readonly' => true,
                    'model' => $searchModel,
                    'value' => date('d-M-y'),
                    'attribute' => 'deadline',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'format' => 'yyyy/m/dd',
                        'autoclose' => true,
                    ]
                ])
            ],

            'completed:boolean',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{complete} {view} {update} {delete}',
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->id === $searchModel->user_id,
                'buttons' => [
                    'complete' => function ($url, $model, $key) {
                        return  Html::a(FAS::icon('check'), ['tasks/complete', 'id' => $model->id], ['title' => 'Completar Tarea']);
                    },
                ],
                'visibleButtons' => [
                    'delete' => function ($model) {
                        return !$model->completed;
                    },
                    'complete' => function ($model) {
                        return !$model->completed;
                    },
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>