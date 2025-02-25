<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\SubCategory;
use App\Models\CompanyDetails;
use App\Models\CategoryProduct;


class BookController extends Controller
{
    public function getProduct()
    {
        
        $categories = Category::select('id', 'name')->orderby('id', 'DESC')->get();
        $subCategories = SubCategory::select('id', 'name', 'category_id')->orderby('id', 'DESC')->get();
        
        $data = Book::select('id', 'name', 'price', 'category_id', 'is_featured', 'is_recent', 'is_popular', 'is_trending', 'feature_image', 'slug',  'status')
        ->with(['categoryProducts' =>function($query){
            $query->select('id', 'book_id', 'category_id');
        }])->orderby('id','DESC')->get();


        return view('admin.book.index', compact('data','categories', 'subCategories'));
    }

    public function productStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:books,name',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'is_featured' => 'nullable',
            'is_recent' => 'nullable',
            'is_new_arrival' => 'nullable',
            'is_top_rated' => 'nullable',
            'is_popular' => 'nullable',
            'is_trending' => 'nullable',
            'feature_image' => 'nullable|image|max:10240',
            'images.*' => 'nullable|image|max:10240'
        ]);

         if ($validator->fails()) {
            $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" . implode(", ", $validator->errors()->all()) . "</b></div>";
            return response()->json(['status' => 400, 'message' => $errorMessage]);
        }

        $categories = json_decode($request->input('categories'), true);

        if ($categories) {
            $firstCategory = $categories[0];
            if (empty($firstCategory['category_id'])) {
                $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>All category fields are required.</b></div>";
                return response()->json(['status' => 400, 'message' => $errorMessage]);
            }
        }

        $pslug = Str::slug($request->input('name'));

        $chkSlug = Book::where('slug', $pslug)->exists();
        if ($chkSlug) {
            $pslug = $pslug . '-' . mt_rand(10000000, 99999999);
        }

        $product = new Book;
        $product->name = $request->input('name');
        $product->slug = $pslug;
        $product->short_description = $request->input('short_description', null);
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->product_code = $request->input('product_code');
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

        if ($product->save()) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = mt_rand(10000000, 99999999).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('images/products/');
                    $imagePath = $destinationPath.$imageName;
                    $image->move($destinationPath, $imageName);
                    $productImage = new ProductImage;
                    $productImage->book_id = $product->id;
                    $productImage->image = $imageName;
                    $productImage->created_by = auth()->user()->id;
                    $productImage->save();
                }
            }

        }

        if (!empty($categories)) {
            $firstCategory = $categories[0];
            $product->category_id = $firstCategory['category_id'];

        $product->save();

            foreach ($categories as $categoryData) {
                $categoryProduct = new CategoryProduct();
                $categoryProduct->book_id = $product->id;
                $categoryProduct->category_id = $categoryData['category_id'];
                $categoryProduct->save();
            }
        }        
        

        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Book Added Successfully.</b></div>";

        return response()->json(['status'=> 300,'message'=>$message]);
    }

    public function productEdit($id)
    {
        $info = Book::where('id', $id)->with('category', 'images', 'subCategory', 'categoryProducts')->first();
        return response()->json($info);
    }

    public function productUpdate(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name,' . $request->codeid,
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'product_code' => 'required|unique:products,product_code,' . $request->codeid,
            'is_featured' => 'nullable',
            'is_recent' => 'nullable',
            'is_new_arrival' => 'nullable',
            'is_top_rated' => 'nullable',
            'is_popular' => 'nullable',
            'is_trending' => 'nullable',
            'feature_image' => 'nullable|image|max:10240',
            // 'images.*' => 'nullable|image|max:10240'
        ]);

         if ($validator->fails()) {
            $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>" . implode(", ", $validator->errors()->all()) . "</b></div>";
            return response()->json(['status' => 400, 'message' => $errorMessage]);
        }

        $categories = json_decode($request->input('categories'), true);
        
        if ($categories) {
            $firstCategory = $categories[0];
            if (empty($firstCategory['category_id'])) {
                $errorMessage = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>All category fields are required.</b></div>";
                return response()->json(['status' => 400, 'message' => $errorMessage]);
            }
        }

        $pslug = Str::slug($request->input('name'));

        
        $product = Book::find($request->codeid);

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
        $product->price = $request->input('price');
        $product->product_code = $request->input('product_code');
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

        $existingCategoryProducts = CategoryProduct::where('book_id', $product->id)->get();
        foreach ($existingCategoryProducts as $existingCategoryProduct) {
            $existsInNewData = false;
            foreach ($categories as $categoryData) {
                if ($existingCategoryProduct->id == $categoryData['categoryProductId']) {
                    $existsInNewData = true;
                    break;
                }
            }
    
            if (!$existsInNewData) {
                $existingCategoryProduct->delete();
            }
        }

        if (!empty($categories)) {
            foreach ($categories as $categoryData) {
                if ($categoryData['categoryProductId']) {
                    $categoryProduct = CategoryProduct::where('id', $categoryData['categoryProductId'])->first();
                    $categoryProduct->category_id = $categoryData['category_id'] ?? null;
                    if ($categoryData['sub_category_id']) {
                        $categoryProduct->sub_category_id = $categoryData['sub_category_id'] ?? null;
                    }
                    $categoryProduct->save();
                } else {
                    if (!empty($categoryData['category_id'])) {
                        $categoryProduct = new CategoryProduct();
                        $categoryProduct->book_id = $product->id;
                        $categoryProduct->category_id = $categoryData['category_id'];
                        if ($categoryData['sub_category_id']) {
                            $categoryProduct->sub_category_id = $categoryData['sub_category_id'] ?? null;
                        }
                        $categoryProduct->save();
                    }
                }                
            }
        
            $firstCategory = $categories[0];
            $product->category_id = $firstCategory['category_id'] ?? null;
            if ($firstCategory['sub_category_id']) {
                $product->sub_category_id = $firstCategory['sub_category_id'] ?? null;
            }
            $product->save();
        }        



        $currentProductImages = ProductImage::where('book_id', $product->id)->get();
        $existingImagesArray = [];

        foreach ($currentProductImages as $existingImage) {
            $existingImagesArray[] = $existingImage->image;
        }

        $imagesToDelete = [];

        if ($request->hasFile('images')) {
            $newImages = $request->file('images');

            foreach ($newImages as $newImage) {
                $uniqueImageName = mt_rand(10000000, 99999999). '.'. $newImage->getClientOriginalExtension();
                $destinationPath = public_path('images/products/');
                $newImagePath = $destinationPath. $uniqueImageName;
                $newImage->move($destinationPath, $uniqueImageName);

                $productImage = new ProductImage;
                $productImage->book_id = $product->id;
                $productImage->image = $uniqueImageName;
                $productImage->created_by = auth()->user()->id;
                $productImage->save();
            }
        }

        foreach ($existingImagesArray as $existingImageName) {
            if (!in_array($existingImageName, $request->input('images', []))) {
                $imagesToDelete[] = $existingImageName;
            }
        }

        if (!empty($imagesToDelete)) {
            ProductImage::whereIn('image', $imagesToDelete)->delete();
            foreach ($imagesToDelete as $fileName) {
                $filePath = public_path('images/products/'. $fileName);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Product Updated Successfully.</b></div>";

        return response()->json(['status' => 300, 'message' => $message, 'short_description' => $request->short_description]);
    }

    public function productDelete($id)
    {
        $product = Book::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        $imagesToDelete = ProductImage::where('book_id', $id)->pluck('image');
        foreach ($imagesToDelete as $imageFilename) {
            $filePath = public_path('images/products/'.$imageFilename); 
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        if ($product->feature_image && file_exists(public_path('images/products/' . $product->feature_image))) {
            unlink(public_path('images/products/' . $product->feature_image));
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product and images deleted successfully.']);
    }

    public function productReviews($productId)
    {
        $product = Book::with('reviews')->findOrFail($productId);
        $product->reviews()->where('admin_notified', 0)->update(['admin_notified' => 1]);
        return view('admin.product.reviews', compact('product'));
    }

    

    public function showStockRequest($id)
    {   
        $product = Book::with('stockRequests')->findOrFail($id);
        $product->stockRequests()->where('admin_notified', 0)->update(['admin_notified' => 1]);
        return view('admin.product.stock_request', compact('product'));
    }

    
    public function toggleFeatured(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_featured' => 'required|boolean'
        ]);

        $product = Book::find($request->id);
        $product->is_featured = $request->is_featured;
        $product->save();
        return response()->json(['message' => 'Featured status updated successfully!']);
    }

    public function toggleRecent(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_recent' => 'required|boolean'
        ]);

        $product = Book::find($request->id);
        $product->is_recent = $request->is_recent;
        $product->save();
        return response()->json(['message' => 'Recent status updated successfully!']);
    }

    public function togglePopular(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_popular' => 'required|boolean'
        ]);

        $product = Book::find($request->id);
        $product->is_popular = $request->is_popular;
        $product->save();

        return response()->json(['message' => 'Popular status updated successfully!']);
    }

    public function toggleTrending(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_trending' => 'required|boolean'
        ]);

        $product = Book::find($request->id);
        $product->is_trending = $request->is_trending;
        $product->save();

        return response()->json(['message' => 'Trending status updated successfully!']);
    }

    public function toggleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_On' => 'required|boolean'
        ]);

        $product = Book::find($request->id);
        $product->status = $request->is_On;
        $product->save();

        return response()->json(['message' => 'Status updated successfully!']);
    }





}
