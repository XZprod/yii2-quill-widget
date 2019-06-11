# yii2-quill-widget
Вывод quill для моделей.
```
<?= $form->field($forum, 'title')->textInput(['maxlength' => true])->widget(QuillWidget::class, [
        'containerId' => 'testEl', // id элемента, в котором будет инициализировано окно редактора
        'clientOptions' => [ // настройки самого quill
            'readOnly' => true
        ]
    ]
) ?>
```

```
//targetInputId - input id, в который будет помещен html контент
<textarea id="exaple_id"></textarea>
<?= QuillWidget::widget(['targetInputId' => 'exaple_id', 'containerId' => 'test']) ?>
```
