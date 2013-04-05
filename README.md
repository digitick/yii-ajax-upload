EAjaxUpload
===========

EAjaxUpload

##Usage

```php
$this->widget('ext.ajax-upload.EAjaxUpload', array(
	'id' => 'some_unique_id',
	'config' => array(
		'request' => array(
			'endpoint' => 'controller/action',
			'params' => array('index' => 'value'),
		),
		'validation' => array(
			'allowedExtensions' => array('jpg', 'jpeg', 'png', 'bmp'),
			'sizeLimit' => 1048576, // max file size in bytes
			'minSizeLimit' => 256, // min file size in bytes
		),
		'callbacks' => array(
			'onComplete' => 'js:function(id, fileName, responseJSON){console.log(responseJSON);}',
		),
	)
));
```
