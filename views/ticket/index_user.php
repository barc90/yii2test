<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'text:ntext',
            'status',
            [                                                  
                'label' => 'Status info',
                'value' => function ($model) {
                    return $model->status ? "Closed" : "Open";
                
                },           
            ],
            'created_date:datetime',
            [                                                  
                'label' => 'Reply',
                'format' => 'raw',
                'value' => function ($model) {
                    return  Html::a('Reply', ['reply', 'ticket_id' => $model->id]); 
                },           
            ]
        ],
    ]); ?>
</div>
