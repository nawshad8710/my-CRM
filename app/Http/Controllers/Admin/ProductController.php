<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\ProductFeature;
use App\Models\Admin\ProductKeyFeature;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!has_access('products')) {
            abort(404);
        }

        $categories = Category::where('status', 1)->latest()->get();

        return view('admin.product.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|max:100',
            'short_description' => 'nullable|max:255',
            'long_description' => 'nullable',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        if (!$request->status || $request->status == NULL) {
            $request->status = 0;
        } else {
            $request->status = 1;
        }

        if (!$request->is_renewable || $request->is_renewable == NULL) {
            $request->is_renewable = 0;
        } else {
            $request->is_renewable = 1;
        }

        if (!$request->is_menu || $request->is_menu == NULL) {
            $request->is_menu = 0;
        } else {
            $request->is_menu = 1;
        }

        if (!$request->is_page || $request->is_page == NULL) {
            $request->is_page = 0;
        } else {
            $request->is_page = 1;
        }

        $upperThumbnail = '';
        $lowerThumbnail = '';
        $productIcon = '';

        $upperVideoThumbnail = $request->file('upper_video_thumbnail');
        $lowerVideoThumbnail = $request->file('lower_video_thumbnail');
        $productIconRequest = $request->file('product_icon');

        if ($upperVideoThumbnail) {
            $currentDate = Carbon::now()->toDateString();

            $upperVideoThumbnailName = $currentDate . '-' . uniqid() . '.' . $upperVideoThumbnail->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/product/upper-video-thumbnail')) {
                mkdir('assets/images/uploads/product/upper-video-thumbnail', 0777, true);
            }

            $upperVideoThumbnail->move(public_path('assets/images/uploads/product/upper-video-thumbnail'), $upperVideoThumbnailName);

            $upperThumbnail = $upperVideoThumbnailName;
        }
        if ($lowerVideoThumbnail) {
            $currentDate = Carbon::now()->toDateString();

            $lowerVideoThumbnailName = $currentDate . '-' . uniqid() . '.' . $lowerVideoThumbnail->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/product/lower-video-thumbnail')) {
                mkdir('assets/images/uploads/product/lower-video-thumbnail', 0777, true);
            }

            $lowerVideoThumbnail->move(public_path('assets/images/uploads/product/lower-video-thumbnail'), $lowerVideoThumbnailName);

            $lowerThumbnail = $lowerVideoThumbnailName;
        }
        if ($productIconRequest) {
            $currentDate = Carbon::now()->toDateString();

            $productIconName = $currentDate . '-' . uniqid() . '.' . $productIconRequest->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/product/icon')) {
                mkdir('assets/images/uploads/product/icon', 0777, true);
            }

            $productIconRequest->move(public_path('assets/images/uploads/product/icon'), $productIconName);

            $productIcon = $productIconName;
        }


        $product = Product::create([
            'title'                     => $request->title,
            'is_menu'                   => $request->is_menu,
            'is_page'                   => $request->is_page,
            'slug'                      => Str::slug($request->title),
            'short_description'         => $request->short_description,
            'long_description'          => $request->long_description,
            'status'                    => $request->status,
            'category_id'               => $request->category_id,
            'price'                     => $request->price,
            'is_renewable'              => $request->is_renewable,
            'upper_video_thumbnail'     => $upperThumbnail,
            'lower_video_thumbnail'     => $lowerThumbnail,
            'icon'                      => $productIcon,
            'upper_video_link'          => $request->upper_video_link,
            'lower_video_link'          => $request->lower_video_link
        ]);


        foreach ($request->key_features_title ?? [] as $index => $title) {
            $product_key_feature = $product->keyFeature()->create([
                "title" => $title,

            ]);
        }

        $iconNames = [];

        $icons = $request->file('images');

        if ($icons) {
            $currentDate = Carbon::now()->toDateString();

            foreach ($icons as $icon) {
                $iconName = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();

                if (!file_exists('assets/images/uploads/product/feature')) {
                    mkdir('assets/images/uploads/product/feature', 0777, true);
                }

                $icon->move(public_path('assets/images/uploads/product/feature'), $iconName);

                $iconNames[] = $iconName;
            }
        }

        foreach ($request->feature_title ?? [] as $index => $featureTitle) {
            $product_feature = $product->feature()->create([
                "title" => $featureTitle,
                "icon" => $iconNames[$index],

            ]);
        }



        Toastr::success('Product Added Successfully', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('admin.sales.product.list');
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
        if (!has_access('products')) {
            abort(404);
        }

        $product = Product::findOrFail($id);
// dd($product);
        if ($product) {
            $categories = Category::where('status', 1)->latest()->get();
            return view('admin.product.form', compact('product', 'categories'));
        }
        Toastr::error('Product not found', 'error', ["positionClass" => "toast-top-right"]);
        return back();
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
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|max:100',
            'short_description' => 'nullable|max:255',
            'long_description' => 'nullable',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        if (!$request->status || $request->status == NULL) {
            $request->status = 0;
        } else {
            $request->status = 1;
        }

        if (!$request->is_renewable || $request->is_renewable == NULL) {
            $request->is_renewable = 0;
        } else {
            $request->is_renewable = 1;
        }

        if (!$request->is_menu || $request->is_menu == NULL) {
            $request->is_menu = 0;
        } else {
            $request->is_menu = 1;
        }

        if (!$request->is_page || $request->is_page == NULL) {
            $request->is_page = 0;
        } else {
            $request->is_page = 1;
        }

        $product = Product::findOrFail($id);

        $upperVideoThumbnailName = $product->upper_video_thumbnail; // Get the current icon name
        $lowerVideoThumbnailName = $product->lower_video_thumbnail; // Get the current icon name
        $productIconName = $product->icon; // Get the current icon name

        $upperVideoThumbnail = $request->file('upper_video_thumbnail');
        $lowerVideoThumbnail = $request->file('lower_video_thumbnail');
        $productIconRequest = $request->file('product_icon');
        if ($upperVideoThumbnail) {
            $currentDate = Carbon::now()->toDateString();
            $newUpperVideoThumbnailName = $currentDate . '-' . uniqid() . '.' . $upperVideoThumbnail->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/product/upper-video-thumbnail')) {
                mkdir('assets/images/uploads/product/upper-video-thumbnail', 0777, true);
            }

            $upperVideoThumbnail->move(public_path('assets/images/uploads/product/upper-video-thumbnail'), $newUpperVideoThumbnailName);

            // Delete the previous icon file
            if ($upperVideoThumbnailName && file_exists(public_path('assets/images/uploads/product/upper-video-thumbnail/' . $upperVideoThumbnailName))) {
                unlink(public_path('assets/images/uploads/product/upper-video-thumbnail/' . $upperVideoThumbnailName));
            }

            $upperVideoThumbnailName = $newUpperVideoThumbnailName;
        }
        if ($lowerVideoThumbnail) {
            $currentDate = Carbon::now()->toDateString();
            $newLowerVideoThumbnailName = $currentDate . '-' . uniqid() . '.' . $lowerVideoThumbnail->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/product/lower-video-thumbnail')) {
                mkdir('assets/images/uploads/product/lower-video-thumbnail', 0777, true);
            }

            $lowerVideoThumbnail->move(public_path('assets/images/uploads/product/lower-video-thumbnail'), $newLowerVideoThumbnailName);

            // Delete the previous icon file
            if ($lowerVideoThumbnailName && file_exists(public_path('assets/images/uploads/product/lower-video-thumbnail/' . $lowerVideoThumbnailName))) {
                unlink(public_path('assets/images/uploads/product/lower-video-thumbnail/' . $lowerVideoThumbnailName));
            }

            $lowerVideoThumbnailName = $newLowerVideoThumbnailName;
        }
        if ($productIconRequest) {
            $currentDate = Carbon::now()->toDateString();
            $newProductIconName = $currentDate . '-' . uniqid() . '.' . $productIconRequest->getClientOriginalExtension();

            if (!file_exists('assets/images/uploads/product/icon')) {
                mkdir('assets/images/uploads/product/icon', 0777, true);
            }

            $productIconRequest->move(public_path('assets/images/uploads/product/icon'), $newProductIconName);

            // Delete the previous icon file
            if ($productIconName && file_exists(public_path('assets/images/uploads/product/icon/' . $productIconName))) {
                unlink(public_path('assets/images/uploads/product/icon/' . $productIconName));
            }

            $productIconName = $newProductIconName;
        }

        if ($product) {
            $product->update([
                'title'                     => $request->title,
                'is_menu'                   => $request->is_menu,
                'is_page'                   => $request->is_page,
                'slug'                      => Str::slug($request->title),
                'short_description'         => $request->short_description,
                'long_description'          => $request->long_description,
                'status'                    => $request->status,
                'category_id'               => $request->category_id,
                'price'                     => $request->price,
                'is_renewable'              => $request->is_renewable,
                'upper_video_thumbnail'     => $upperVideoThumbnailName,
                'lower_video_thumbnail'     => $lowerVideoThumbnailName,
                'icon'                      => $productIconName,
                'upper_video_link'          => $request->upper_video_link,
                'lower_video_link'          => $request->lower_video_link

            ]);

            foreach ($request->key_features_title ?? [] as $index => $title) {
                $key_feature_id = isset($request->key_feature_id[$index]) ? $request->key_feature_id[$index] : null;
                $product_key_feature = $product->keyFeature()->updateOrCreate(
                    [
                        'id' => $key_feature_id
                    ],
                    [
                        "title" => $title,

                    ]
                );
            }

            $iconNames = [];

            $icons = $request->file('images');

            if ($icons) {
                $currentDate = Carbon::now()->toDateString();

                $existingIcons = $product->feature()->pluck('icon')->toArray();

                foreach ($icons as $index => $icon) {
                    $iconName = $currentDate . '-' . uniqid() . '.' . $icon->getClientOriginalExtension();

                    if (!file_exists('assets/images/uploads/product/feature')) {
                        mkdir('assets/images/uploads/product/feature', 0777, true);
                    }

                    $icon->move(public_path('assets/images/uploads/product/feature'), $iconName);

                    if (isset($existingIcons[$index]) && $existingIcons[$index]) {
                        $existingIconPath = public_path('assets/images/uploads/product/feature') . '/' . $existingIcons[$index];
                        if (file_exists($existingIconPath)) {
                            unlink($existingIconPath);
                        }
                    }

                    $iconNames[$index] = $iconName;
                }
            }

            foreach ($request->feature_title ?? [] as $index => $featureTitle) {
                $feature_id = isset($request->feature_id[$index]) ? $request->feature_id[$index] : null;
                $product_feature = $product->feature()->updateOrCreate(
                    [
                        'id' => $feature_id
                    ],
                    [
                        "title" => $featureTitle,
                        "icon" => $iconNames[$index] ?? $product->feature[$index]->icon ?? 0,

                    ]
                );
            }



            Toastr::success('Product Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->route('admin.sales.product.list');
        }

        Toastr::error('Product not found', 'error', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!has_access('products')) {
            abort(404);
        }

        $product = Product::findOrFail($id);
        if ($product) {
            $product->delete();
            Toastr::success('Product Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return 1;
        }
        return 0;
    }



    public function deleteFeature($id)
    {
        $productFeature = ProductFeature::find($id);
        if($productFeature->icon){
            $existingIconPath = public_path('assets/images/uploads/product/feature') . '/' . $productFeature->icon;
            if (file_exists($existingIconPath)) {
                unlink($existingIconPath);
            }
            $productFeature->delete();
        }else{
            $productFeature->delete();
        };
        return json_decode($productFeature);
    }


    public function deleteKeyFeature($id)
    {
        $productKeyFeature = ProductKeyFeature::find($id);

            $productKeyFeature->delete();

        return json_decode($productKeyFeature);
    }
}
