<?php

namespace app\models;


use yii\base\Model;

class PromoCodeForm extends Model {

	const SCENARIO_CREATE = 'create';
	const SCENARIO_EDIT   = 'create';

	public $id_city;
	public $reward_sum;
	public $code_status;
	public $date_start;
	public $date_end;

	/** @var null|PromoCode */
	protected $code;


	public function __construct($conf, $id = null) {
		parent::__construct();
		$this->scenario = $id ? self::SCENARIO_CREATE : self::SCENARIO_EDIT;
		if ($id) {
			$this->code = PromoCode::findOne($id);
			if ($this->code) {
				$this->id_city = $this->code->id_city;
				$this->reward_sum = $this->code->reward_sum;
				$this->code_status = $this->code->code_status;
				$this->date_start = $this->code->date_start;
				$this->date_end = $this->code->date_end;
			}
		}
	}


	public function isCodeFounded() {
		return (bool) $this->code;
	}


	public function rules() {
		return [
			['id_city', 'filter', 'filter' => 'intval', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],

			['reward_sum', 'required', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['reward_sum', 'filter', 'filter' => 'intval', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],
			['reward_sum', 'integer', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],

			[['date_start', 'date_end'], 'required', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_EDIT]],

			['code_status', 'filter', 'filter' => 'intval', 'on' => [self::SCENARIO_EDIT]],
		];
	}


	public function attributeLabels() {
		return [
			'reward_sum' => 'вознаграждение клиента',
			'id_city' => 'Тарифная зона',
			'date_start' => 'дата начала',
			'date_end' => 'дата окончания',
			'code_status' => 'Статус',
		];
	}


	public static function getCitiesList() {
		return [
			1 => 'Москва',
			2 => 'Санкт-Петербург',
			3 => 'Тюмень',
			4 => 'Новосибирск',
			5 => 'Нижний Новгород',
		];
	}


	public function process() {
		$code = $this->code ? $this->code : new PromoCode();

		$code->id_city    = $this->id_city;
		$code->reward_sum = $this->reward_sum;
		$code->date_start = $this->date_start;
		$code->date_end   = $this->date_end;

		if ($this->code_status) {
			$code->code_status = $this->code_status;
		}

		return $code->save();
	}


	public function isActive() {
		return $this->code && $this->code->isActive();
	}

}