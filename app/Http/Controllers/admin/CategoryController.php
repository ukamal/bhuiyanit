<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Toastr;

class CategoryController extends Controller
{
    //addCategory
    public function addCategory(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }
    //categoryStore
    public function categoryStore(Request $request){
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        if($category){
            Toastr::success('Successfully Added', 'Title', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }
    //categoryUpdate
    public function categoryUpdate(Request $request,$id){
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();
        if($category){
            Toastr::success('Successfully Updated', 'Title', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }
    //categoryDestroy
    public function categoryDestroy(Request $request,$id){
        $category = Category::find($id);
        $category->delete();
        return back();

    }
}