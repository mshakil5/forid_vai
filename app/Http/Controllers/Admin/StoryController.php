<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class StoryController extends Controller
{
    public function getStory()
    {
        
        $categories = Category::select('id', 'name')->orderby('id', 'DESC')->get();
        $data = Story::select('id', 'name', 'description', 'category_id', 'is_featured', 'is_recent', 'is_popular', 'is_trending', 'feature_image', 'slug',  'status')->orderby('id','DESC')->get();

        return view('admin.story.index', compact('data','categories'));
    }

    public function storyStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:books,name',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'is_featured' => 'nullable',
            'is_recent' => 'nullable',
            'is_new_arrival' => 'nullable',
            'is_top_rated' => 'nullable',
            'is_popular' => 'nullable',
            'is_trending' => 'nullable',
            'feature_image' => 'nullable|image|max:10240',
        ]);

         if ($validator->fails()) {
            $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" . implode(", ", $validator->errors()->all()) . "</b></div>";
            return response()->json(['status' => 400, 'message' => $errorMessage]);
        }


        $pslug = Str::slug($request->input('name'));

        $chkSlug = Story::where('slug', $pslug)->exists();
        if ($chkSlug) {
            $pslug = $pslug . '-' . mt_rand(10000000, 99999999);
        }

        $product = new Story;
        $product->name = $request->input('name');
        $product->slug = $pslug;
        $product->short_description = $request->input('short_description', null);
        $product->description = $request->input('description');
        $product->category_id = $request->category_id;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->is_featured = $request->input('is_featured', false);
        $product->is_recent = $request->input('is_recent', false);
        $product->is_new_arrival = $request->input('is_new_arrival', false);
        $product->is_top_rated = $request->input('is_top_rated', false);
        $product->is_popular = $request->input('is_popular', false);
        $product->is_trending = $request->input('is_trending', false);
        $product->created_by = auth()->user()->id;

        if ($request->hasFile('feature_image')) {
            $uploadedFile = $request->file('feature_image');
            $randomName = mt_rand(10000000, 99999999). '.'. $uploadedFile->getClientOriginalExtension();
            $destinationPath = public_path('images/products/');
            $path = $uploadedFile->move($destinationPath, $randomName); 
            $product->feature_image = $randomName;
        }

        $product->save();

        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Story Created Successfully.</b></div>";

        return response()->json(['status'=> 300,'message'=>$message]);
    }

    public function storyEdit($id)
    {
        $info = Story::where('id', $id)->first();
        return response()->json($info);
    }

    public function storyUpdate(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:stories,name,' . $request->codeid,
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'is_featured' => 'nullable',
            'is_recent' => 'nullable',
            'is_new_arrival' => 'nullable',
            'is_top_rated' => 'nullable',
            'is_popular' => 'nullable',
            'is_trending' => 'nullable',
            'feature_image' => 'nullable|image|max:10240',
        ]);

         if ($validator->fails()) {
            $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" . implode(", ", $validator->errors()->all()) . "</b></div>";
            return response()->json(['status' => 400, 'message' => $errorMessage]);
        }



        $pslug = Str::slug($request->input('name'));

        
        $product = Story::find($request->codeid);

        if ($request->hasFile('feature_image')) {
            $uploadedFile = $request->file('feature_image');
            $randomName = mt_rand(10000000, 99999999). '.'. $uploadedFile->getClientOriginalExtension();
            $destinationPath = public_path('images/products/');
            $path = $uploadedFile->move($destinationPath, $randomName); 
            $product->feature_image = $randomName;
        }

        $product->name = $request->input('name');
        $product->slug = $pslug;
        $product->short_description = $request->input('short_description', null);
        $product->description = $request->input('description');
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->is_featured = $request->input('is_featured', false);
        $product->is_recent = $request->input('is_recent', false);
        $product->is_new_arrival = $request->input('is_new_arrival', false);
        $product->is_top_rated = $request->input('is_top_rated', false);
        $product->is_popular = $request->input('is_popular', false);
        $product->is_trending = $request->input('is_trending', false);
        $product->updated_by = auth()->user()->id;
        $product->save();

        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product Updated Successfully.</b></div>";

        return response()->json(['status' => 300, 'message' => $message, 'short_description' => $request->short_description]);
    }

    public function storyDelete($id)
    {
        $product = Story::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        if ($product->feature_image && file_exists(public_path('images/products/' . $product->feature_image))) {
            unlink(public_path('images/products/' . $product->feature_image));
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product and images deleted successfully.']);
    }

    public function toggleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_On' => 'required|boolean'
        ]);

        $product = Story::find($request->id);
        $product->status = $request->is_On;
        $product->save();

        return response()->json(['message' => 'Status updated successfully!']);
    }
}
