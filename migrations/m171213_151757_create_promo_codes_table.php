<?php

use yii\db\Migration;
use app\models\PromoCode;


/**
 * Class m171213_151757_create_promo_codes_table
 */
class m171213_151757_create_promo_codes_table extends Migration {

	/**
	 *
	 */
	public function safeUp() {
		$this->createTable(PromoCode::tableName(), [
			'id'           => $this->primaryKey()->unsigned(),
			'zone'         => $this->integer()->unsigned(),
			'reward_sum'   => $this->integer()->unsigned(),
			'code_status'  => $this->smallInteger()->unsigned(),
			'name'         => $this->string(),
			'date_start'   => $this->date(),
			'date_end'     => $this->date(),
			'time_created' => $this->dateTime(),
			'time_updated' => $this->dateTime(),
		]);
	}


	/**
	 *
	 */
	public function safeDown() {
		$this->dropTable(PromoCode::tableName());
	}

}