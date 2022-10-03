<?php

namespace App\Admin\Controllers;

use App\Models\ExerciseVideos;
use App\Models\Exercises;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExerciseVideosController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ExerciseVideos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExerciseVideos());

        $grid->column('id', __('Id'));
        $grid->column('exercise_id', __('Exercise id'));
        $grid->column('video', __('Video'));
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
        $show = new Show(ExerciseVideos::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('exercise_id', __('Exercise id'));
        $show->field('video', __('Video'));
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

        $exercises = Exercises::all();
        $option = [];

        if ($exercises) {
            foreach ($exercises as $exercise) {
               $option[$exercise->id] = $exercise->name;
            }
        }
        $form = new Form(new ExerciseVideos());

        //$form->number('exercise_id', __('Exercise id'));
        $form->select('exercise_id')->options($option);

        $form->text('video', __('Video'));

        return $form;
    }
}
