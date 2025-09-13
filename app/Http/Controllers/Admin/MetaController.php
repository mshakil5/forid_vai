<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MetaController extends Controller
{
    public function index()
    {
        
        $data = Master::select('id', 'name', 'description', 'category','feature_image', 'slug', 'meta_title', 'meta_description', 'meta_keywords')->orderby('id','DESC')->get();

        return view('admin.meta.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255|unique:masters,category',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'required|string',
            'feature_image' => 'nullable|image|max:10240',
        ]);

         if ($validator->fails()) {
            $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" . implode(", ", $validator->errors()->all()) . "</b></div>";
            return response()->json(['status' => 400, 'message' => $errorMessage]);
        }


        $pslug = Str::slug($request->input('meta_title'));

        $chkSlug = Master::where('slug', $pslug)->exists();
        if ($chkSlug) {
            $pslug = $pslug . '-' . mt_rand(10000000, 99999999);
        }

        $product = new Master;
        $product->slug = $pslug;
        $product->category = $request->category;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->created_by = auth()->user()->id;

        if ($request->hasFile('feature_image')) {
            $uploadedFile = $request->file('feature_image');
            $randomName = mt_rand(10000000, 99999999). '.'. $uploadedFile->getClientOriginalExtension();
            $destinationPath = public_path('images/products/');
            $path = $uploadedFile->move($destinationPath, $randomName); 
            $product->feature_image = $randomName;
        }

        $product->save();

        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";

        return response()->json(['status'=> 300,'message'=>$message]);
    }

    public function edit($id)
    {
        $info = Master::where('id', $id)->first();
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255|unique:masters,category,' . $request->codeid,
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'required|string',
            'feature_image' => 'nullable|image|max:10240',
        ]);

        if ($validator->fails()) {
            $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" . implode(", ", $validator->errors()->all()) . "</b></div>";
            return response()->json(['status' => 400, 'message' => $errorMessage]);
        }

        $pslug = Str::slug($request->input('meta_title'));
        $product = Master::find($request->codeid);

        if ($request->hasFile('feature_image')) {
            $uploadedFile = $request->file('feature_image');
            $randomName = mt_rand(10000000, 99999999). '.'. $uploadedFile->getClientOriginalExtension();
            $destinationPath = public_path('images/products/');
            $path = $uploadedFile->move($destinationPath, $randomName); 
            $product->feature_image = $randomName;
        }

        $product->slug = $pslug;
        $product->category = $request->category;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->updated_by = auth()->user()->id;
        $product->save();

        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";

        return response()->json(['status' => 300, 'message' => $message, 'short_description' => $request->short_description]);
    }

    public function delete($id)
    {
        $product = Master::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data not found.']);
        }


        if ($product->feature_image && file_exists(public_path('images/products/' . $product->feature_image))) {
            unlink(public_path('images/products/' . $product->feature_image));
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Data  deleted successfully.']);
    }
}
