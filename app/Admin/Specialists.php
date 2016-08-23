<?php
use App\Specialist;
use App\City;
use App\Speciality;
use SleepingOwl\Admin\Model\ModelConfiguration;


AdminSection::registerModel(Specialist::class, function (ModelConfiguration $model) {
    $model->setTitle('Спеціалісти')->setAlias('specialist');
    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i> Користувач успішно видалений');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
//        $display->with('specialist', 'LARAVEL2');
        $display->setFilters([
            AdminDisplayFilter::related('id')->setModel(Specialist::class),
            AdminDisplayFilter::field('phone_number')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        ]);
        $display->setColumns([
            AdminColumn::link('first_name')->setLabel('first_name')
                ->setWidth('50px'),
            AdminColumn::text('last_name')->setLabel('last_name')
                ->setWidth('50px'),

//            AdminColumn::datetime('birthday')->setLabel('Birthday')->setFormat('d.m.Y')
//                ->setWidth('150px')
//                ->setHtmlAttribute('class', 'text-center'),
//            AdminColumn::text('country.title')->setLabel('Country')->append(AdminColumn::filter('country_id')),
//            AdminColumn::lists('companies.title')->setLabel('Companies'),
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
                       AdminFormElement::text('phone_number', 'phone_number')->required()
                ], 3)->addColumn([
                    AdminFormElement::text('email', ' email')->required()
                    ], 3)
                    ->addColumn([
                        AdminFormElement::select('specialty_name', 'specialty_name')->setModelForOptions(new Speciality())->setDisplay('specialty_name')
                    ])
            ]),
            'Description' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::wysiwyg('description', 'Description')->disableFilter()
            ]),
            'Link_social' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::text('link_vk', 'link_vk')->required()
                ], 3)->addColumn([
                    AdminFormElement::text('link_instagram', ' link_instagram')->required()
                ], 3)->addColumn([
                    AdminFormElement::text('link_fb', 'link_fb')->required()
                    ])
            ]),
            'Work city' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::columns()
                    ->addColumn([
                    AdminFormElement::select('city_first', 'city_first ')->setModelForOptions(new City())->setDisplay('city_ua')
                ], 4)->addColumn([
                    AdminFormElement::select('city_second', 'city_second')->setModelForOptions(new City())->setDisplay('city_ua')
                ], 4)->addColumn([
                    AdminFormElement::select('city_third', 'city_third')->setModelForOptions(new City())->setDisplay('city_ua')
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