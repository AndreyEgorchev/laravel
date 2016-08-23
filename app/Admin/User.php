<?php
use App\User;
use App\Role;
use SleepingOwl\Admin\Model\ModelConfiguration;


AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Юзеры')->setAlias('users');
    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i> Користувач успішно видалений');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
//        $display->with('specialist', 'LARAVEL2');
        $display->setFilters([
            AdminDisplayFilter::related('id')->setModel(User::class),
            AdminDisplayFilter::field('created_at')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        ]);
        $display->setColumns([
            AdminColumn::link('email')->setLabel('email')
                ->setWidth('50px'),
        ]);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::panel();
        $form->addHeader([
            AdminFormElement::columns()
                ->addColumn([
                    AdminFormElement::text('first_name', 'First Name')->required()
                ], 3)->addColumn([
                    AdminFormElement::text('last_name', 'Last Name')->required()->addValidationMessage('required', 'You need to set last name')
                ])
        ]);
        $tabs = AdminDisplay::tabbed([
            'Contakt' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('email', 'email')->required()
                    ], 3)
                    ->addColumn([
//                        AdminFormElement::('password', ' password')->required()
                        AdminFormElement::password('password', 'Пароль')->required()->addValidationRule('min:6')
                    ], 3)
                    ->addColumn([
                        AdminFormElement::multiselect('theroles', 'Роли')->setModelForOptions(new Role())->setDisplay('name')
                    ])
                    ->addColumn([
                        AdminFormElement::date('last_login', 'Last Login')->required()->setFormat('d.m.Y'),
                    ])
            ]),
//            'Companies' => new \SleepingOwl\Admin\Form\FormElements([
//                AdminFormElement::multiselect('companies', 'Companies')->setModelForOptions(new Company)->setDisplay('title'),
////                $companies
//            ]),
        ]);

        $form->addElement($tabs);

//        $form->addBody(AdminFormElement::image('photo', 'Photo'));
        $form->getButtons()
            ->setSaveButtonText('Save contact')
            ->hideCancelButton();

        return $form;

    });


});