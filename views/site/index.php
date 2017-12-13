<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\PromoCodeForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список промо-кодов';
?>
<div class="site-index">
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'id',
				'label' => '№'
			], [
				'attribute' => 'id_city',
				'label' => 'Тарифная зона',
				'value' => function($model) {
					/** @var app\models\PromoCode $model */
					$list = PromoCodeForm::getCitiesList();
					return $list[$model->id_city];
				}
			], [
				'attribute' => 'reward_sum',
				'label' => 'вознаграждение клиента'
			], [
				'attribute' => 'code_status',
				'label' => 'Статус',
				'value' => function($model) {
					/** @var app\models\PromoCode $model */
					return $model->getStatusLabel();
				}
			], [
				'attribute' => 'date_start',
				'label' => 'дата начала'
			], [
				'attribute' => 'date_end',
				'label' => 'дата окончания'
			], [
				'format' => 'html',
				'value' => function($model) {
					return Html::a('Редактировать', Url::to(['site/edit-promo-code', 'id' => $model->id]), ['class' => 'btn btn-primary']);
				}
			],
		],
	]); ?>
</div>
