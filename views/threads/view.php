<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Thread */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_thread], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_thread], [
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
            'id_thread',
            'title',
            'count_displays',
            'state',
            'date_begin',
            'date_end',
            'id_author',
            'id_section',
        ],
    ]) ?>

</div>
