<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::latest()->paginate(15);

        return view('article.index',[
            'articles' => $article
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();

        return view('article.create', [
            'users' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],[
            'title.required' => 'Bạn cần nhập tiêu đề',
            'summary.required' => 'Bạn cần nhập sơ lược bài viết',
            'description.required' => 'Bạn cần nhập nội dung bài viết',
            'image.image' => 'File ảnh phải có định dạng jpeg,png,jpg,gif,svg',
        ]);

        // Kiểm tra hàm có trống hay k
        $is_active = 0; //default
        if ($request->has('is_active')){
            $is_active = $request->input('is_active');
        }

        // Kiểm tra có ảnh hay k
        $image = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path_upload = 'upload/article/';
            $request->file('image')->move($path_upload, $filename);
            $image = $path_upload.$filename;
        }

        $article = new Article();
        $article->title = $request->input('title');
        $article->summary = $request->input('summary');
        $article->description = $request->input('description');
        $article->user_id = $request->input('user_id');
        $article->image = $image;
        $article->is_active = $is_active;
        $article->save();

       return redirect()->route('admin.article.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::all();
        $article = Article::findOrFail($id);

        return view('article.edit',[
            'users' => $user,
            'articles' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],[
            'title.required' => 'Bạn cần nhập tiêu đề',
            'summary.required' => 'Bạn cần nhập sơ lược bài viết',
            'description.required' => 'Bạn cần nhập nội dung bài viết',
            'image.image' => 'File ảnh phải có định dạng jpeg,png,jpg,gif,svg',
        ]);

        // Kiểm tra hàm có trống hay k
        $is_active = 0; //default
        if ($request->has('is_active')){
            $is_active = $request->input('is_active');
        }


        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->summary = $request->input('summary');
        $article->description = $request->input('description');
        $article->user_id = $request->input('user_id');
        $article->is_active = $is_active;

        // Kiểm tra có ảnh hay k
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path_upload = 'upload/article/';
            $request->file('image')->move($path_upload, $filename);
            $image = $path_upload.$filename;
            $article->image = $image;
        }

        $article->save();

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $is_Delete = Article::destroy($id); // true or fail

        if($is_Delete){
            return response()->json(['success' => 1, 'message' => 'Thành công']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Thất bại']);
        }
    }
}
