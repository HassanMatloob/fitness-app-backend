<?php

namespace App\Admin\Controllers;

use App\Models\Categories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Categories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Categories());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'))->image();
        $grid->column('parent_id', __('Parent Categorie'))->display(function ($id ,$column) {
            if($id != 0){
                $cat = Categories::find($id);
                return $cat->name;
            }else{
                return "No Parent";

            }
            
            
        });
        
        $grid->column('status', __('Status'));
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
        $show = new Show(Categories::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('parent_id', __('Parent Categorie'));
        $show->parent_id()->as(function ($id) {
            if($id != 0){
                $cat = Categories::find($id);
                return $cat->name;
            }else{
                return "No Parent";

            }
            
        });
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

        //dd($option);
        $form = new Form(new Categories());

        $form->text('name', __('Name'));
        $form->image('image', __('Image'));
        $form->select('parent_id' ,__('Parent Categorie'))->options($option);
        //$form->text('status', __('Status'));

        return $form;
    }
}
