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

    <p>
        <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
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
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
