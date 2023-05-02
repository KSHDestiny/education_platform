<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category page
    public function categoryPage(){
        $categories = Category::select('categories.*','users.name as professor_name')
                                    ->join('users','categories.professor_id','users.id')
                                    ->paginate(3);
        return view('admin.category.category',compact('categories'));
    }

    // category create
    public function categoryCreate(Request $request){
        $this->categoryValidation($request);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'professor_id' => $request->professorId
        ];
        Category::create($data);
        return redirect()->route('category#page')->with('createSuccess',"Category {$request->title} is successfully created.");
    }

    // direct category edit page
    public function categoryEditPage($id){
        $user = Auth::user();
        $createProfessor = Category::select('professor_id')->where('category_id',$id)->first();

        if($user->id != $createProfessor->professor_id){
            abort(403);
        }

        $category = Category::where('category_id',$id)->first();
        return view('admin.category.editCategory',compact('category'));
    }

    // category edit
    public function categoryEdit($id, Request $request){
        $this->categoryValidation($request);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'updated_at' => Carbon::now()
        ];
        Category::where('category_id',$id)->update($data);
        return redirect()->route('teaching#page')->with('editSuccess',"Category {$request->title} is successfully edited.");
    }

    // direct category delete page
    public function categoryDeletePage($id){
        $user = Auth::user();
        $createProfessor = Category::select('professor_id')->where('category_id',$id)->first();

        if($user->role != "founder" && $user->id != $createProfessor->professor_id){
            abort(403);
        }

        $category = Category::where('category_id',$id)->first();
        return view('admin.category.deleteCategory',compact('category'));
    }

    // category delete
    public function categoryDelete($id){
        $categoryTitle = Category::select('title')->where('category_id',$id)->first();
        Category::where('category_id',$id)->delete();
        return redirect()->route('teaching#page')->with('deleteSuccess',"Category {$categoryTitle->title} is successfully deleted.");
    }

    // category validation
    private function categoryValidation($request){
        $validationRules = [
            'title' => 'required',
            'content' => 'required',
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }
}
