<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\PromoCodeForm;
use app\models\PromoCode;
use yii\helpers\Url;

/** @var $this yii\web\View */
/** @var PromoCodeForm $model */

$this->title = Yii::t('app/promo', 'Edit promo code');

$datePickerConf = [
	'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
	'clientOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd'
	],
	'options' => [
		'disabled' => !$model->isActive()
	]
];

?>
<div class="site-index">

	<?php $form = ActiveForm::begin([
		'id' => 'create-form',
		'options' => ['class' => 'form-horizontal'],
	]) ?>

		<h2><?= Yii::t('app/promo', 'Edit promo code') ?></h2>

		<div class="col-md-6">

			<?= $form->field($model, 'name')->textInput(['disabled' => !$model->isActive()]) ?>

			<?= $form->field($model, 'reward_sum')->textInput(['disabled' => !$model->isActive()]) ?>

			<?= $form->field($model, 'zone')->dropdownList(PromoCodeForm::getZonesList(), ['disabled' => !$model->isActive()]); ?>

			<?= $form->field($model, 'code_status')->dropdownList(PromoCode::getStatusesList()); ?>

			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'date_start')->widget(DatePicker::class, $datePickerConf) ?>
				</div>
				<div class="col-md-6">
					<?= $form->field($model, 'date_end')->widget(DatePicker::class, $datePickerConf) ?>
				</div>
			</div>

			<div class="form-group">
				<?= Html::submitButton(Yii::t('app/promo', 'Save'), ['class' => 'btn btn-primary']) ?>
				<?= Html::a(Yii::t('app/promo', 'Cancel'), Url::to(['site/index']), ['class' => 'btn btn-danger']) ?>
			</div>

		</div>

	<?php ActiveForm::end() ?>
</div>