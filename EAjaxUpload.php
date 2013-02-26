<?php

/**
 * EAjaxUpload class file.
 * This extension is a wrapper of http://valums.com/ajax-upload/
 *
 * @author Vladimir Papaev <kosenka@gmail.com>
 * @version 0.1
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * EAjaxUpload file upload widget.
 */
class EAjaxUpload extends CWidget
{
	const VERSION = '3.3.0';

	public $id = 'fileUploader';
	public $params = array();
	public $config = array();
	public $action;
	public $allowedExtensions = array();
	public $sizeLimit;
	public $minSizeLimit = 0;
	public $css = null;

	public function run()
	{
		if (!$this->action) {
			throw new CException('EAjaxUpload: "action" cannot be empty.');
		}

		if (empty($this->allowedExtensions)) {
			throw new CException('EAjaxUpload: "allowedExtensions" cannot be empty.');
		}

		if (!$this->sizeLimit) {
			throw new CException('EAjaxUpload: "sizeLimit" cannot be empty.');
		}

		echo '<div id="' . $this->id . '"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div>';

		$assets = dirname(__FILE__) . '/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);

		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl . '/jquery.fineuploader-' . self::VERSION . '.js', CClientScript::POS_HEAD);

		$this->css = (!empty($this->css)) ? $this->css : $baseUrl . '/fineuploader-' . self::VERSION . '.css';
		$cs->registerCssFile($this->css);

		$params = array(
			'PHPSESSID' => Yii::app()->session->sessionID,
			'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken
		);
		if (!empty($this->params)) {
			$params = array_merge($params, $this->params);
		}

		$configArray = array(
			'request' => array(
				'endpoint' => $this->action,
				'paramsInBody' => false,
				'params' => $params,
			),
			'debug' => YII_DEBUG,
			'multiple' => false,
			'validation' => array(
				'allowedExtensions' => $this->allowedExtensions,
				'sizeLimit' => $this->sizeLimit,
				'minSizeLimit' => $this->minSizeLimit,
			),
		);
		$config = CJavaScript::encode(array_merge($configArray, $this->config));

		$script = " $('#{$this->id}').fineUploader($config);";
		$cs->registerScript('FileUploader_' . $this->id, $script, CClientScript::POS_READY);
	}

}