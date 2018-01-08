<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\PromoCodeForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/promo', 'List of promo codes');
?>
<div class="site-index">
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'id',
				'label'     => '№'
			],

			[
				'attribute' => 'name',
				'label'     => Yii::t('app/promo', 'Promo code name')
			],

			[
				'attribute' => 'zone',
				'label'     => Yii::t('app/promo', 'Promo code tarifzone'),
				'value'     => function($model) {
					/** @var app\models\PromoCode $model */
					$list = PromoCodeForm::getZonesList();
					return $list[$model->zone];
				}
			],

			[
				'attribute' => 'reward_sum',
				'label'     => Yii::t('app/promo', 'Sum of client reward')
			],

			[
				'attribute' => 'code_status',
				'label'     => Yii::t('app/promo', 'Promo code status'),
				'value'     => function($model) {
					/** @var app\models\PromoCode $model */
					return $model->getStatusLabel();
				}
			],

			[
				'attribute' => 'date_start',
				'label'     => Yii::t('app/promo', 'Promo code date start')
			],

			[
				'attribute' => 'date_end',
				'label' => Yii::t('app/promo', 'Promo code date end')
			],

			[
				'format' => 'html',
				'value'  => function($model) {
					return Html::a(
						Yii::t('app/promo', 'Edit'),
						Url::to(['site/edit-promo-code', 'id' => $model->id]),
						['class' => 'btn btn-primary']
					);
				}
			],
		],
	]); ?>
</div>