<?php

namespace app\controllers;

use Yii;
use app\models\PromoCode;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\PromoCodeForm;
use yii\web\NotFoundHttpException;


/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller {


	/**
	 * @return array
	 */
	public function actions() {
		return [
			'error' => ['class' => 'yii\web\ErrorAction'],
		];
	}


	/**
	 * @return string
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider([
			'query' => PromoCode::find()->orderBy(['time_updated' => SORT_DESC])
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider
		]);
	}


	/**
	 * @return string|\yii\web\Response
	 */
	public function actionCreatePromoCode() {
		$model = new PromoCodeForm([]);

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->process();
			return $this->redirect(['index']);
		}

		return $this->render('create-promo-code', [
			'model' => $model
		]);
	}


	/**
	 * @param string $id
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException
	 */
	public function actionEditPromoCode($id) {
		$model = new PromoCodeForm([], (int) $id);

		if (!$model->isCodeFounded()) {
			throw new NotFoundHttpException();
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->process();
			return $this->redirect(['index']);
		}

		return $this->render('edit-promo-code', [
			'model' => $model
		]);
	}

}