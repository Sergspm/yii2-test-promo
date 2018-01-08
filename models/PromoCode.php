<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * Class PromoCode
 * @package app\models
 * @property int    $id            Id of promo code
 * @property int    $zone          Id of zone
 * @property int    $reward_sum    Reward sum of client
 * @property int    $code_status   Code of promo code status (active or not)
 * @property string $name          Name of promo code
 * @property string $date_start    Date start of promo code
 * @property string $date_end      Date end of promo code
 * @property string $time_created  Date of promo code created
 * @property string $time_updated  Date last update of promo code
 */
class PromoCode extends ActiveRecord {

	/**
	 * Active
	 * @type string
	 */
	const CODE_STATUS_ACTIVE   = 1;

	/**
	 * Not active
	 * @type string
	 */
	const CODE_STATUS_INACTIVE = 2;

	/**
	 * Force fields list
	 * @var null|array
	 */
	public $forceFields;


	/**
	 * @return string
	 */
	public static function tableName() {
		return '{{%promo_codes}}';
	}


	/**
	 * Promo code disabled by default
	 * PromoCode constructor.
	 * @param array $config
	 */
	public function __construct(array $config = []) {
		parent::__construct(array_merge([
			'code_status' => self::CODE_STATUS_INACTIVE
		], $config));
	}


	/**
	 * @return array
	 */
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


	/**
	 * @return array
	 */
	public function attributes() {
		return [
			'id',
			'zone',
			'reward_sum',
			'code_status',
			'name',
			'date_start',
			'date_end',
			'time_created',
			'time_updated',
		];
	}


	/**
	 * @return array
	 */
	public static function getStatusesList() {
		return [
			self::CODE_STATUS_ACTIVE   => 'Активен',
			self::CODE_STATUS_INACTIVE => 'Неактивен'
		];
	}


	/**
	 * @return mixed
	 */
	public function getStatusLabel() {
		return self::getStatusesList()[$this->code_status];
	}


	/**
	 * @return bool
	 */
	public function isActive() {
		return $this->code_status === self::CODE_STATUS_ACTIVE;
	}


	/**
	 * @return bool
	 */
	public function isInActive() {
		return $this->code_status === self::CODE_STATUS_INACTIVE;
	}


	/**
	 * @return array|mixed|null
	 */
	public function fields() {
		return $this->forceFields ? $this->forceFields : $this->fields();
	}


	/**
	 * @param bool $save
	 * @return bool
	 */
	public function activate($save = true) {
		$this->code_status = self::CODE_STATUS_ACTIVE;
		return $save ? $this->save() : true;
	}

}
