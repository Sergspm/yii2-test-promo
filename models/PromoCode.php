<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * Class PromoCode
 * @package app\models
 * @property int $id
 * @property int $id_city
 * @property int $reward_sum
 * @property int $code_status
 * @property string $date_start
 * @property string $date_end
 * @property string $time_created
 * @property string $time_updated
 */
class PromoCode extends ActiveRecord {

	const CODE_STATUS_ACTIVE   = 1;
	const CODE_STATUS_INACTIVE = 2;


	public static function tableName() {
		return '{{%promo_codes}}';
	}


	public function __construct(array $config = []) {
		parent::__construct(array_merge([
			'code_status' => self::CODE_STATUS_ACTIVE
		], $config));
	}


	public function behaviors() {
		return [
			'timestamp' => [
				'class' => TimestampBehavior::class,
				'value' => new Expression('NOW()'),
				'createdAtAttribute' => 'time_created',
				'updatedAtAttribute' => 'time_updated',
			],
		];
	}


	public function attributes() {
		return [
			'id',
			'id_city',
			'reward_sum',
			'code_status',
			'date_start',
			'date_end',
			'time_created',
			'time_updated',
		];
	}


	public static function getStatusesList() {
		return [
			self::CODE_STATUS_ACTIVE => 'Активен',
			self::CODE_STATUS_INACTIVE => 'Неактивен'
		];
	}


	public function getStatusLabel() {
		return self::getStatusesList()[$this->code_status];
	}


	public function isActive() {
		return $this->code_status === self::CODE_STATUS_ACTIVE;
	}


	public function isInActive() {
		return $this->code_status === self::CODE_STATUS_INACTIVE;
	}

}
