<?php

use yii\db\Migration;
use app\models\PromoCode;


class m171213_151757_create_promo_codes_table extends Migration {

	public function safeUp() {
		$this->createTable(PromoCode::tableName(), [
			'id' => $this->primaryKey()->unsigned(),
			'id_city' => $this->integer()->unsigned(),
			'reward_sum' => $this->integer()->unsigned(),
			'code_status' => $this->smallInteger()->unsigned(),
			'date_start' => $this->date(),
			'date_end' => $this->date(),
			'time_created' => $this->dateTime(),
			'time_updated' => $this->dateTime(),
		]);
	}


	public function safeDown() {
		$this->dropTable(PromoCode::tableName());
	}

}