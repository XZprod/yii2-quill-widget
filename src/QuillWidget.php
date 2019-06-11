<?php

namespace xzprod\quillwidget;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;
use xzprod\quillwidget\asset\QuillAsset;
use xzprod\quillwidget\Renderer;

class QuillWidget extends Widget
{
    public $targetInputId = '';
    public $containerId = 'quill_container';
    public $clientOptions = [];

    public $model;
    public $attribute;

    protected $DEFAULT_CLIENT_OPTIONS = [
        'theme' => 'snow'
    ];

    public function init()
    {
        $this->clientOptions = array_merge($this->DEFAULT_CLIENT_OPTIONS, $this->clientOptions);
        $view = $this->getView();
        QuillAsset::register($view);
        parent::init();
    }

    public function run()
    {
        $view = $this->getView();

        if ($this->model) {
            $this->targetInputId = Html::getInputId($this->model, $this->attribute);
        }

        $renderer = new Renderer([
            'containerId' => $this->containerId,
            'jsParams' => $this->clientOptions,
            'attribute' => $this->attribute,
            'targetInputId' => $this->targetInputId
        ]);

        $js = $this->model ? $renderer->getJsForModel($this->model) : $renderer->getJs();
        $html = $this->model ? $renderer->getHtmlForModel($this->model) : $renderer->getHtml();

        $view->registerJs($js, View::POS_END);
        return $html;

    }


}