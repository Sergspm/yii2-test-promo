<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\PromoCodeForm;

/** @var $this yii\web\View */
/** @var PromoCodeForm $model */

$this->title = 'Добавить промо-код';
?>
<div class="site-index">
	<?php $form = ActiveForm::begin([
		'id' => 'create-form',
		'options' => ['class' => 'form-horizontal'],
	]) ?>
		<h2>Создание нового промо-кода</h2>
		<div class="col-md-6">
			<?= $form->field($model, 'reward_sum') ?>
			<?= $form->field($model, 'id_city')->dropdownList(PromoCodeForm::getCitiesList()); ?>
			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'date_start')->widget(
						DatePicker::class, [
						'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'yyyy-mm-dd'
						]
					]) ?>
				</div>
				<div class="col-md-6">
					<?= $form->field($model, 'date_end')->widget(
						DatePicker::class, [
						'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'yyyy-mm-dd'
						]
					]) ?>
				</div>
			</div>
			<div class="form-group">
				<?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
			</div>
		</div>
	<?php ActiveForm::end() ?>
</div>
