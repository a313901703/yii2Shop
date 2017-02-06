<?php
namespace frontend\components;

use yii\helpers\Json;

class ReturnInfo
{
	public $ret_code;
	public $ret_msg;
	public $error_code;

	public function __construct($ret_code, $ret_msg = '', $error_code = 0)
	{
		$this->ret_code = $ret_code;
		$this->ret_msg = $ret_msg;
		$this->error_code = $error_code;
	}

	public function __toString()
	{
		return Json::encode($this);
	}
}