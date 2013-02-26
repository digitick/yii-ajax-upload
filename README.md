EAjaxUpload
===========

EAjaxUpload

###Usage

```php
$this->widget('ext.ajax-upload.EAjaxUpload', array(
	'action' => 'controller/action',
	'id' => 'some_unique_id',
	'postParams' => array('index' => 'value'),
	'allowedExtensions' => array('jpg', 'jpeg', 'png', 'bmp'),
	'sizeLimit' => 1048576, // max file size in bytes
	'minSizeLimit' => 256, // min size in bytes
));
```