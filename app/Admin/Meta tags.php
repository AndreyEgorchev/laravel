<?php
use SleepingOwl\Admin\Model\ModelConfiguration;


AdminSection::registerModel(\App\Meta_tags::class, function (ModelConfiguration $model) {
    $model->setTitle('Мета теги')->setAlias('meta_tegs');
    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i>Тег успішно видалений');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();

        $display->setColumns([
            AdminColumn::link('name_meta')->setLabel('Тег')
                ->setWidth('100px'),

        ]);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::panel();

        $form->addHeader([
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('name_meta', 'Тег')->required()
                ], 8)
        ]);

        $form->getButtons()
            ->setSaveButtonText('Save contact')
            ->hideCancelButton();
        return $form;
    });
});

