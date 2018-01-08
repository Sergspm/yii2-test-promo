<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\PromoCodeForm;

/** @var $this yii\web\View */
/** @var PromoCodeForm $model */

$this->title = Yii::t('app/promo', 'Add promo code');

$datePickerConf = [
	'template'      => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
	'clientOptions' => [
		'autoclose'   => true,
		'format'      => 'yyyy-mm-dd'
	]
];

?>
<div class="site-index">

	<?php $form = ActiveForm::begin([
		'id' => 'create-form',
		'options' => ['class' => 'form-horizontal'],
	]) ?>

		<h2><?= Yii::t('app/promo', 'Create new promo code') ?></h2>

		<div class="col-md-7">

			<?= $form->field($model, 'name') ?>

			<?= $form->field($model, 'reward_sum') ?>

			<?= $form->field($model, 'zone')->dropdownList(PromoCodeForm::getZonesList()); ?>

			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'date_start')->widget(DatePicker::class, $datePickerConf) ?>
				</div>
				<div class="col-md-6">
					<?= $form->field($model, 'date_end')->widget(DatePicker::class, $datePickerConf) ?>
				</div>
			</div>

			<div class="form-group">
				<?= Html::submitButton(Yii::t('app/promo', 'Create'), ['class' => 'btn btn-primary']) ?>
			</div>

		</div>

	<?php ActiveForm::end() ?>

</div>