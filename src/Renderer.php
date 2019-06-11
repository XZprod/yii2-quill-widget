<?php

namespace xzprod\quillwidget;

use yii\base\BaseObject;
use yii\helpers\Html;

class Renderer extends BaseObject
{
    public $containerId;
    public $jsParams;
    public $attribute;
    public $targetInputId;

    public function getJsForModel($model)
    {
        $attribute = $this->attribute;
        $content = $model->$attribute ?? '';
        $js = $this->getJs();
        $js .= <<<JS
          {$this->containerId}_container.getElementsByClassName('ql-editor')[0].innerHTML = "$content";
JS;
    return $js;
    }

    public function getJs()
    {
        $cid = $this->containerId;
        $jsParams = json_encode($this->jsParams);
        $js = <<<JS
        var {$cid}_container = document.getElementById("$cid");
        var $cid = new Quill('#$this->containerId', $jsParams);
        var {$cid}_target = document.getElementById("$this->targetInputId");
        $this->containerId.on('text-change', function() {
            {$cid}_target.value = {$cid}_container.getElementsByClassName('ql-editor')[0].innerHTML;
        });
JS;
        return $js;
    }

    public function getHtmlForModel($model)
    {
        $attribute = $this->attribute;
        $content = $model->$attribute ?? '';
        $html = $this->getHtml();
        $html .= Html::hiddenInput(Html::getInputName($model, $this->attribute), $content, ['id' => $this->targetInputId]);
        return $html;
    }

    public function getHtml()
    {
        $html = "<div id=\"{$this->containerId}\"></div>";
        return $html;
    }
}