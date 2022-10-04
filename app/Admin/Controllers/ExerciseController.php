<?php

namespace App\Admin\Controllers;

use App\Models\Exercises;
use App\Models\Categories;
use App\Models\ExcersieSubcategories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

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
        DB::raw('SET foreign_key_checks = 0');

        $grid = new Grid(new Exercises());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('image')->image();
        $grid->column('short_description', __('Short description'))->limit(50 );
        $grid->column('instructions', __('Instructions'))->limit(50 );
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

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->image()->image();
        $show->field('short_description', __('Short description'));
        $show->field('instructions', __('Instructions'));
        // $show1->field('category_id', __('Category Id'));
        $show->videos('Video', function ($videos) {

            $videos->resource('/admin/exercise-videos');
            $videos->video();
            
        });

        $show->videos('Video', function ($videos) {

            $videos->resource('/admin/exercise-videos');
            $videos->video();
            $videos->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableList();
                $tools->disableDelete();
            });;
            
        });

        $show->categorie('Categorie', function ($videos) {
            $videos->resource('/admin/categories');
            $videos->name();
            $videos->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableList();
                $tools->disableDelete();
            });;
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

        if ($categories) {
            foreach ($categories as $category) {
                $option[$category->id] = $category->name;
            }
        }

        $form = new Form(new Exercises());

        $form->text('name', __('Name'));
        $form->image('image', __('Image'));
        $form->text('short_description', __('Short description'));
        $form->quill('instructions', __('Instructions'));
        $form->hasMany('videos','Enter Video Link', function (Form\NestedForm $form) {
            $form->text('video');
        });
        // $form->multipleSelect('category_id', __('Selct Categorie'))->options($option);

        $form->multipleSelect('categorie','Categorie')->options(Categories::all()->pluck('name','id'));

        $form->hidden('image');
        $form->ignore('category_id');

        // $form->saved(function (Form $form) {

        //     $id = $form->model()->id;
            
        //     foreach ($_POST['category_id'] as $categorie_ids) {
        //         if ($categorie_ids != null || $categorie_ids != '') {

                    

        //             $exercise_form = new ExcersieSubcategories();
        //             $exercise_form->category_id = (int)$categorie_ids;
        //             $exercise_form->exercise_id = $id;
        //             $exercise_form->save();
        //         }
        //     }
        // });


        return $form;
    }
}
