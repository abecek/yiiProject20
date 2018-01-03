<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Threads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Thread', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_thread',
            'title',
            'count_displays',
            'state',
            'date_begin',
            //'date_end',
            //'id_author',
            //'id_section',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
