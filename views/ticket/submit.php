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

<div class="ticket-view">
    <h1>Submit Ticket</h1>
</div>

<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>submited!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php else: ?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

		<?= $form->field($ticket_model, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($ticket_model, 'text')->textarea(['rows' => 6]) ?>

	 	<?= $form->field($ticket_model, 'status')->dropDownList(["Open", "Closed"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php endif; ?>
