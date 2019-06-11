<?php

namespace xzprod\quillwidget\asset;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class QuillAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/src/';

    public $css = [
        'css/quill.snow.css',
    ];

    public $baseUrl = '@web';

    public $js = [
        'js/quill.min.js'
    ];

}
