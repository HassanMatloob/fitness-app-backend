<?php

namespace App\Admin\Controllers;

use App\Models\Exercises;
use App\Models\Categories;
use App\Models\ExcersieSubcategories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExerciseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Exercises';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Exercises());
        $grid1 = new Grid(new ExcersieSubcategories());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'));
        $grid->column('short_description', __('Short description'));
        $grid->column('instructions', __('Instructions'));
        $grid1->column('category_id', __('Category Id'));
        //$grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Exercises::findOrFail($id));
        $show1 = new Show(ExcersieSubcategories::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('short_description', __('Short description'));
        $show->field('instructions', __('Instructions'));
        $show1->field('category_id', __('Category Id'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $categories = Categories::all();
        $option = [];

        $option[0] = 'Please Select';

        if ($categories) {
            foreach ($categories as $category) {
               $option[$category->id] = $category->name;
            }
        }

        $form = new Form(new Exercises());
        

        $form->text('name', __('Name'));
        $form->image('image', __('Image'));
        $form->text('short_description', __('Short description'));
        $form->textarea('instructions', __('Instructions'));
        $form->select('category_id')->options($option);
        //$form->text('status', __('Status'));

        $form->saving(function(Form $form){
            $form->image = $form->image;
        });

        return $form;
    }
}
