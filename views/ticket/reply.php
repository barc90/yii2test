<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */

$this->title = $ticket_model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Created!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>

<div class="ticket-view">
    <h1>Ticket #<?= $ticket_model->id ?></h1>
		
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
	  	</div>
	  	<div class="panel-body">
			<?= Html::encode($ticket_model->text) ?>
	  	</div>
		<ul class="list-group">
			<li class="list-group-item">
				Username: <?= Html::a($ticket_model->user->username, ['user/view', 'id' => $ticket_model->user->id]) ?>			
			</li>
		</ul>
	</div>

</div>

<p>Messages:</p>
<?php $messages = $ticket_model->getMessages()->orderBy('created_date')->all(); ?>
<?php foreach($messages as $message) : ?>
<div class="panel panel-default">
	<div class="panel-body">
		<?= Html::encode($message->text) ?>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
			User: <?= $message->user->username ?>			
		</li>
		<li class="list-group-item">
			Date: <?= Yii::$app->formatter->asDateTime($message->created_date) ?>			
		</li>
	</ul>
</div>

<?php endforeach ?>


<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

		<?= $form->field($message_model, 'text')->textarea(['rows' => 6]) ?>

	 	<?= $form->field($ticket_model, 'status')->dropDownList(["Open", "Closed"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Reply', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
