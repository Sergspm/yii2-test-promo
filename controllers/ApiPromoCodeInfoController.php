<?php

namespace app\controllers;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\rest\Controller;
use app\models\PromoCode;
use app\models\PromoCodeForm;


class ApiPromoCodeInfoController extends Controller {

	public function actionGetDiscountInfo($name) {
		$promo = PromoCode::findOne(['name' => $name]);
		if ($promo) {
			$promo->forceFields = [
				'date_start',
				'date_end',
				'reward_sum',
				'zone',
				'code_status',
			];
		}
		return $promo;
	}


	public function actionActivateDiscount() {
		$name = Yii::$app->request->post('name');
		$zone = Yii::$app->request->post('zone');

		$promo = PromoCode::findOne([
			'name' => $name,
			'zone' => $zone,
		]);

		if ($promo) {
			$promo->activate();
			$promo->forceFields = ['reward_sum'];
		}

		return $promo;
	}

}
