<?php

namespace app\controllers;

use Yii;
use app\models\PromoCode;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\PromoCodeForm;
use yii\web\NotFoundHttpException;


class SiteController extends Controller {


	public function actionIndex() {
		$dataProvider = new ActiveDataProvider([
			'query' => PromoCode::find()->orderBy(['time_updated' => SORT_DESC])
		]);
		return $this->render('index', [
			'dataProvider' => $dataProvider
		]);
	}


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


	public function actionEditPromoCode($id) {
		$model = new PromoCodeForm([], $id);
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
