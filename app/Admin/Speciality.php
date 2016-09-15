<?php
use App\Speciality;

use SleepingOwl\Admin\Model\ModelConfiguration;


AdminSection::registerModel(Speciality::class, function (ModelConfiguration $model) {
    $model->setTitle('Спеціальність')->setAlias('speciality');
    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i> Спеціальність успішно видалений');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
//        $display->with('specialist', 'LARAVEL2');
//        $display->setFilters([
//            AdminDisplayFilter::related('id')->setModel(Specialist::class),
//            AdminDisplayFilter::field('country.title')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
//        ]);
        $display->setColumns([
            AdminColumn::link('specialty_name')->setLabel('first_name')
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
                    AdminFormElement::text('specialty_name', 'Specialty name')->required()
                ], 3)

        ]);
//              $tabs = AdminDisplay::tabbed([
//            'Contakt' => new \SleepingOwl\Admin\Form\FormElements([
//                AdminFormElement::columns()
//                    ->addColumn([
//                        AdminFormElement::text('specialty_name', 'specialty_name')->required()
//                    ], 3)
//            ]),

//        ]);
//        $form->addElement($tabs);
//        $form->addBody(AdminFormElement::image('photo', 'Photo'));
        $form->getButtons()
            ->setSaveButtonText('Save contact')
            ->hideCancelButton();
        return $form;
    });
});