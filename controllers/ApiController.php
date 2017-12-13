<?php

namespace app\controllers;

use app\models\PromoCodeForm;
use Yii;
use app\models\PromoCode;
use yii\web\Controller;
use yii\web\Response;


class ApiController extends Controller {

	public function beforeAction($action) {
		Yii::$app->response->format = Response::FORMAT_JSON;
		Yii::$app->request->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}


	public function actionGetDiscountInfo($id) {
		/** @var PromoCode $promo */
		$promo = PromoCode::findOne($id);
		if (!$promo) {
			Yii::$app->response->setStatusCode(404);
			return [
				'status' => 404,
				'error' => 'Promo code not found'
			];
		}
		$zones = PromoCodeForm::getCitiesList();
		return [
			'status' => 200,
			'payload' => [
				'date_start'  => $promo->date_start,
				'date_end'    => $promo->date_end,
				'reward_sum'  => $promo->reward_sum,
				'id_city'     => $promo->id_city,
				'zone'        => $zones[$promo->id_city],
				'code_status' => $promo->code_status,
				'status'      => $promo->isActive() ? 'active' : 'inactive'
			]
		];
	}


	public function actionActivateDiscount($id) {
		/** @var PromoCode $promo */
		$promo = PromoCode::findOne($id);
		if (!$promo) {
			Yii::$app->response->setStatusCode(404);
			return [
				'status' => 404,
				'error' => 'Promo code not found'
			];
		}
		$zone = Yii::$app->request->post('zone', 0);
		// Do smth with zone
		return [
			'status' => 200,
			'payload' => [
				'reward_sum' => $promo->reward_sum,
			]
		];
	}

}
