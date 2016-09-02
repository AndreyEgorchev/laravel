<?php
use App\Role;

use SleepingOwl\Admin\Model\ModelConfiguration;


AdminSection::registerModel(Role::class, function (ModelConfiguration $model) {
    $model->setTitle('Роли пользователей')->setAlias('role');
    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i>Роль успішно видалений');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();

        $display->setColumns([
            AdminColumn::link('name')->setLabel('Название роли')
                ->setWidth('100px'),
            AdminColumn::text('slug')->setLabel('Роль')
                ->setWidth('50px'),
        ]);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::panel();
        if ( in_array($id, [1,2,3])) {
            $form->addHeader([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('name', 'Название роли')->required()
                    ], 3)
                    ->addColumn([
                        AdminFormElement::text('slug', 'Роль')->required()->readonly()
                    ], 3)
                    ->addColumn([
                        AdminFormElement::select('permits', 'Права доступа')->setModelForOptions(new \App\Permit())->setDisplay('name')
                    ])

            ]);
        } else{
            $form->addHeader([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('name', 'Название роли')->required()
                    ], 3)
                    ->addColumn([
                        AdminFormElement::text('slug', 'Роль')->required()
                    ], 3)
                    ->addColumn([
                        AdminFormElement::select('permits', 'Права доступа')->setModelForOptions(new \App\Permit())->setDisplay('name')
                    ])

            ]);
        }

        $form->getButtons()
            ->setSaveButtonText('Save contact')
            ->hideCancelButton();
        return $form;
    });
    $model->deleted(function ($id)
    { if ( in_array($id, [1,2,3]))
        return null;
    else
        return 1;
    });
});

