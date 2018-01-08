<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * Class PromoCodeForm
 * @package app\models
 */
class PromoCodeForm extends Model {

	/**
	 * Promo code create scenario
	 * @type string
	 */
	const SCENARIO_CREATE = 'create';

	/**
	 * Promo code edit scenario
	 * @type string
	 */
	const SCENARIO_EDIT = 'edit';

	/**
	 * Id of zone
	 * @var int
	 */
	public $zone;

	/**
	 * Reward sum for client
	 * @var int
	 */
	public $reward_sum;

	/**
	 * Name of promo code
	 * @var int
	 */
	public $name;

	/**
	 * Code status of promo code
	 * @var int
	 */
	public $code_status;

	/**
	 * Date start of promo code
	 * @var string
	 */
	public $date_start;

	/**
	 * Date end of promo code
	 * @var string
	 */
	public $date_end;

	/**
	 * Promo code instance
	 * @var null|PromoCode
	 */
	protected $code;


	/**
	 * PromoCodeForm constructor.
	 * @param array    $conf
	 * @param null|int $id
	 */
	public function __construct($conf, $id = null) {
		parent::__construct($conf);

		$this->scenario = $id ? self::SCENARIO_EDIT : self::SCENARIO_CREATE;

		if ($this->scenario === self::SCENARIO_EDIT) {
			$this->code = PromoCode::findOne($id);
			if ($this->code) {
				$this->zone        = $this->code->zone;
				$this->reward_sum  = $this->code->reward_sum;
				$this->name        = $this->code->name;
				$this->code_status = $this->code->code_status;
				$this->date_start  = $this->code->date_start;
				$this->date_end    = $this->code->date_end;
			}
		}
	}


	/**
	 * Is promo code founded for edit
	 * True only if edit scenario and promo code founded
	 * @return bool
	 */
	public function isCodeFounded() {
		return $this->code && $this->scenario === self::SCENARIO_EDIT;
	}


	/**
	 * Check promo code existed and active
	 * @return bool
	 */
	public function isActive() {
		return $this->code && $this->code->isActive();
	}


	/**
	 * @return array
	 */
	public function rules() {
		return [
			['zone', 'filter', 'filter' => 'intval', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],

			['reward_sum', 'required', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['reward_sum', 'filter', 'filter' => 'intval', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['reward_sum', 'integer', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],

			[['date_start', 'date_end'], 'required', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],

			['code_status', 'filter', 'filter' => 'intval', 'on' => [self::SCENARIO_EDIT]],

			['name', 'required', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['name', 'filter', 'filter' => 'trim', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['name', 'match', 'pattern' => '/^[a-z]+$/i', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['name', 'unique', 'targetClass' => PromoCode::class, 'on' => [self::SCENARIO_CREATE]],
		];
	}


	/**
	 * @return array
	 */
	public function attributeLabels() {
		return [
			'reward_sum'  => Yii::t('app/promo', 'Sum of client reward'),
			'zone'        => Yii::t('app/promo', 'Promo code tarifzone'),
			'date_start'  => Yii::t('app/promo', 'Promo code date start'),
			'date_end'    => Yii::t('app/promo', 'Promo code date end'),
			'code_status' => Yii::t('app/promo', 'Promo code status'),
			'name'        => Yii::t('app/promo', 'Promo code name'),
		];
	}


	/**
	 * List of zones
	 * @return array
	 */
	public static function getZonesList() {
		return [
			1 => Yii::t('app/promo', 'Moscow'),
			2 => Yii::t('app/promo', 'St. Petersburg'),
			3 => Yii::t('app/promo', 'Tyumen'),
			4 => Yii::t('app/promo', 'Nowosibirsk'),
			5 => Yii::t('app/promo', 'Nizhny Novgorod'),
		];
	}


	/**
	 * Save the data
	 * @return bool
	 */
	public function process() {
		$code = $this->scenario === self::SCENARIO_EDIT ? $this->code : new PromoCode();

		if (!$code) {
			return false;
		}

		// Check if someone send data directly and disabled fields not helped
		if ($this->scenario === self::SCENARIO_CREATE || $this->isActive()) {
			$code->zone       = $this->zone;
			$code->name       = $this->name;
			$code->reward_sum = $this->reward_sum;
			$code->date_start = $this->date_start;
			$code->date_end   = $this->date_end;
		}

		if ($this->code_status) {
			$code->code_status = $this->code_status;
		}

		return $code->save();
	}

}