<?php
use App\Specialist;
use App\City;
use App\Speciality;
use App\Images;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Meta_tags;

AdminSection::registerModel(Specialist::class, function (ModelConfiguration $model) {
    $model->setTitle('Спеціалісти')->setAlias('specialist');
    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i> Користувач успішно видалений');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-primary');
        $display->setFilters([
            AdminDisplayFilter::related('meta.name_meta')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        ]);
        $display->setColumns([
            AdminColumn::link('fullName')->setLabel('Name')
                ->setWidth('100px'),
            AdminColumn::text('FullCity')->setLabel('Citys')
                ->setWidth('100px'),
            AdminColumn::lists('meta.name_meta')->setLabel('Meta tags')
                ->setWidth('100px')
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
                ], 3)
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
                    ],3)
            ]),
            'Meta tags' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::multiselect('meta', 'Тег')->setModelForOptions(new Meta_tags())->setDisplay('name_meta')
            ]),
            'Work city' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::select('city_first', 'city_first ')->setModelForOptions(new City())->setDisplay('city_ua')
                    ], 4)->addColumn([
                        AdminFormElement::select('city_second', 'city_second')->setModelForOptions(new City())->setDisplay('city_ua')
                    ], 4)->addColumn([
                        AdminFormElement::select('city_third', 'city_third')->setModelForOptions(new City())->setDisplay('city_ua')
                    ], 4)
            ]),
            'Images' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::columns()
                    ->addColumn([AdminFormElement::images('image', 'Photo')], 4),
            ]),

        ]);
        $form->addElement($tabs);
        $form->getButtons()
            ->setSaveButtonText('Save contact')
            ->hideCancelButton();
        return $form;
    });
});