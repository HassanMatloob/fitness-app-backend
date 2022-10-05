<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Exercises;
use App\Models\ExcersieSubcategories;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_all_categorie(Request $request)
    {

        if ($request->has('parent_id')) {
            $category = Categories::find($request->input('parent_id'));
            if($category){
                $category_ids = $category->getDescendants($category);
                $response = Categories::whereIn('id',$category_ids)->get();
            }else{
                $response = '';
            }

        } else {
               $response = Categories::all();
        }

        return response()->json(
            [
                'status' => true,
                'message' => 'Success',
                'data' => $response,

            ],
            200
        );
    }

    public function get_all_exercise(Request $request)
    {
        if ($request->has('category_id')) {
            $category = Categories::find($request->input('category_id'));
            if($category){
                $category_ids = $category->getDescendants($category);
                $exercise_ids = [];
                
                foreach (ExcersieSubcategories::whereIn('categories_id',$category_ids)->get() as $key => $value) {
                    array_push($exercise_ids , $value->exercises_id);
                }
                // dd($exercise_ids);
                $response =Exercises::whereIn('id',$exercise_ids)->get();
            }else
                $response = '';
            

        } else {
               $response = Exercises::all();
        }
        return response()->json(
            [
                'status' => true,
                'message' => 'Success',
                'data' => $response,

            ],
            200
        );

    }

    public function get_categorie_by_id($id){
       
        try{
               $response = Categories::find($id);

               return response()->json(
                [
                    'status' => true,
                    'message' => 'Success',
                    'data' => $response,
    
                ],
                200
            );

        }catch(Exception $e){
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Please check again on postman',
                    'data' => null,
    
                ],
                500
            );
        }

        
    }

    public function get_exercise_by_id($id){
       
        try{
               $response = Exercises::find($id);

               return response()->json(
                [
                    'status' => true,
                    'message' => $response != null ? 'Success' : 'No data found',
                    'data' => $response,
    
                ],
                200
            );

        }catch(Exception $e){
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Please check again on postman',
                    'data' => null,
    
                ],
                500
            );
        }

        
    }
}
