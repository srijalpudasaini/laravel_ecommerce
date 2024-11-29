<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class AdminController extends Controller
{
    //
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
        $dashboardDatas = [
            'TotalAmount' => Order::sum('total'),
            'TotalOrderedAmount' => Order::where('status', 'ordered')->sum('total'),
            'TotalDeliveredAmount' => Order::where('status', 'delivered')->sum('total'),
            'TotalCancelledAmount' => Order::where('status', 'cancelled')->sum('total'),
            'Total' => Order::count(),
            'TotalOrdered' => Order::where('status', 'ordered')->count(),
            'TotalDelivered' => Order::where('status', 'delivered')->count(),
            'TotalCancelled' => Order::where('status', 'cancelled')->count(),
        ];
        return view("admin.index", compact('orders','dashboardDatas'));
    }
    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }
    public function add_brand()
    {
        return view('admin.brand-add');
    }

    public function brand_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->slug);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();

        $file_name = Carbon::now()->timestamp . '.' . $file_extension;

        $this->generateThumbnail($image, $file_name, 'brands');

        $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('status', 'Brand added successfully');
    }

    public function generateThumbnail($image, $imageName, $dirName, $height = 124, $width = 124)
    {
        $destination = public_path('uploads/' . $dirName);
        $img = Image::read($image->path());
        $img->cover($width, $height, "top");
        $img->resize($width, $height)->save($destination . '/' . $imageName);
    }

    public function brand_edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand-edit', compact('brand'));
    }

    public function brand_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->slug);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/brands' . '/' . $brand->image))) {
                File::delete(public_path('uploads/brands' . '/' . $brand->image));
            }
            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extension;

            $this->generateThumbnail($image, $file_name, 'brands');

            $brand->image = $file_name;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('status', 'Brand updated successfully');
    }
    public function delete_brand($id)
    {
        $brand = Brand::findOrFail($id);
        if (File::exists(public_path('uploads/brands' . '/' . $brand->image))) {
            File::delete(public_path('uploads/brands' . '/' . $brand->image));
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status', 'Brand deleted successfully');
    }

    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function category_add()
    {
        return view('admin.category-add');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->name = $request->name;

        $img = $request->file('image');
        $img_extension = $request->file('image')->extension();

        $image_name = Carbon::now()->timestamp . '.' . $img_extension;

        $this->generateThumbnail($img, $image_name, 'categories');

        $category->image = $image_name;

        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Categgory added successfully');
    }

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category-edit', compact('category'));
    }

    public function category_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $category = Category::findOrFail($request->id);

        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/categories/' . $category->image))) {
                File::delete(public_path('uploads/categories/' . $category->image));
            }

            $img = $request->file('image');
            $imageExtension = $request->file('image')->extension();

            $file_name = Carbon::now()->timestamp . '.' . $imageExtension;

            $this->generateThumbnail($img, $file_name, 'categories');

            $category->image = $file_name;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Category updated successfully');
    }

    public function category_delete($id)
    {
        $category = Category::findOrFail($id);

        if (File::exists(public_path('uploads/categories/' . $category->image))) {
            File::delete(public_path('uploads/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('status', 'Category deleted successfully');
    }

    public function products()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function product_add()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();

        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function product_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'sdescription' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'sprice' => 'nullable|numeric',
            'sku' => 'required',
            'quantity' => 'required|numeric',
            'stock' => 'required',
            'featured' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'brand_id' => 'required',
            'category_id' => 'required'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->short_description = $request->sdescription;
        $product->description = $request->description;
        $product->regular_price = $request->price;
        $product->sale_price = $request->sprice;
        $product->SKU = $request->sku;
        $product->quantity = $request->quantity;
        $product->stock_status = $request->stock;
        $product->featured = $request->featured;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Carbon::now()->timestamp . '.' . $image->extension();
            $product->image = $image_name;
            $this->generateThumbnail($image, $image_name, 'products', 689, 540);
            $this->generateThumbnail($image, $image_name, 'products/thumbnails', 104, 104);
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if ($request->hasFile('gallery')) {
            $allowedExtension = ['jpg', 'png', 'jpeg'];
            $files = $request->file('gallery');
            foreach ($files as $file) {
                $gextension = $file->extension();
                if (in_array($gextension, $allowedExtension)) {
                    $gfileName = Carbon::now()->timestamp . '-' . $counter . '.' . $gextension;
                    $this->generateThumbnail($file, $gfileName, 'products/thumbnails', 104, 104);
                    array_push($gallery_arr, $gfileName);
                    $this->generateThumbnail($file, $gfileName, 'products', 689, 540);
                    $counter++;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
        }
        $product->images = $gallery_images;
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product added successfully');
    }

    public function product_edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'brands', 'categories'));
    }

    public function product_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->id,
            'sdescription' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'sprice' => 'nullable|numeric',
            'sku' => 'required',
            'quantity' => 'required|numeric',
            'stock' => 'required',
            'featured' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'brand_id' => 'required',
            'category_id' => 'required'
        ]);
        $product = Product::findOrFail($request->id);

        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->short_description = $request->sdescription;
        $product->description = $request->description;
        $product->regular_price = $request->price;
        $product->sale_price = $request->sprice;
        $product->SKU = $request->sku;
        $product->quantity = $request->quantity;
        $product->stock_status = $request->stock;
        $product->featured = $request->featured;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Carbon::now()->timestamp . '.' . $image->extension();
            $product->image = $image_name;
            if (File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete('uploads/products/' . $product->image);
            }
            if (File::exists(public_path('uploads/products/thumbnails/' . $product->image))) {
                File::delete('uploads/products/thumbnails/' . $product->image);
            }
            $this->generateThumbnail($image, $image_name, 'products', 689, 540);
            $this->generateThumbnail($image, $image_name, 'products/thumbnails', 104, 104);
        }

        if ($request->hasFile('gallery')) {

            foreach (explode(',', $product->images) as $ofile) {
                if (File::exists(public_path('uploads/products/thumbnails/' . $ofile))) {
                    File::delete(public_path('uploads/products/thumbnails/' . $ofile));
                }
            }
            $gallery_arr = array();
            $gallery_images = "";
            $counter = 1;



            $allowedExtension = ['jpg', 'png', 'jpeg'];
            $files = $request->file('gallery');
            foreach ($files as $file) {
                $gextension = $file->extension();
                if (in_array($gextension, $allowedExtension)) {
                    $gfileName = Carbon::now()->timestamp . '-' . $counter . '.' . $gextension;
                    $this->generateThumbnail($file, $gfileName, 'products/thumbnails', 104, 104);
                    $this->generateThumbnail($file, $gfileName, 'products', 689, 540);
                    array_push($gallery_arr, $gfileName);
                    $counter++;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
            $product->images = $gallery_images;
        }
        $product->save();

        return redirect()->route('admin.products')->with('status', 'Product updated successfully');
    }

    public function product_delete($id)
    {
        $product = Product::findOrFail($id);
        if (File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete('uploads/products/' . $product->image);
        }
        if (File::exists(public_path('uploads/products/thumbnails/' . $product->image))) {
            File::delete('uploads/products/thumbnails/' . $product->image);
        }
        foreach (explode(',', $product->images) as $ofile) {
            if (File::exists(public_path('uploads/products/thumbnails/' . $ofile))) {
                File::delete(public_path('uploads/products/thumbnails/' . $ofile));
            }
            if (File::exists(public_path('uploads/products/' . $ofile))) {
                File::delete(public_path('uploads/products/' . $ofile));
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Product deleted successfully');
    }

    public function coupons()
    {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }
    public function coupon_add()
    {
        return view('admin.coupon-add');
    }

    public function coupon_store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
            'value' => 'required|numeric',
            'cvalue' => 'required|numeric',
            'expdate' => 'required|date',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cvalue;
        $coupon->expiry_date = $request->expdate;

        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Coupon added successfully');
    }

    public function coupon_edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function coupon_update(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $request->code,
            'type' => 'required',
            'value' => 'required|numeric',
            'cvalue' => 'required|numeric',
            'expdate' => 'required|date',
        ]);

        $coupon = Coupon::findOrFail($request->id);

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cvalue;
        $coupon->expiry_date = $request->expdate;

        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Coupon updated successfully');
    }

    public function coupon_delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons')->with('status', 'Product deleted successfully');
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.orders', compact('orders'));
    }

    public function order_details($order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order_id)->first();

        return view('admin.order-details', compact('order', 'orderItems', 'transaction'));
    }

    public function update_order_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->status = $request->status;
        if ($request->status == 'delivered') {
            $order->delivered_date = Carbon::now();
            $transaction = Transaction::where('order_id', $request->order_id)->first();
            $transaction->status = 'approved';
            $transaction->save();
        } else if ($request->status == 'cancelled') {
            $order->cancelled_date = Carbon::now();
        }
        $order->save();

        return back()->with('status', 'Status updated succesfully');
    }

    public function slides()
    {
        $slides = Slide::orderBy('created_at', 'DESC')->paginate(12);
        return view('admin.slides', compact('slides'));
    }

    public function slide_add()
    {
        return view('admin.slide-add');
    }

    public function slide_store(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required',
        ]);

        $slide = new Slide();
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        $img = $request->file('image');
        $img_extension = $request->file('image')->extension();

        $image_name = Carbon::now()->timestamp . '.' . $img_extension;

        $this->generateThumbnail($img, $image_name, 'slides', 690, 400);

        $slide->image = $image_name;

        $slide->save();

        return redirect()->route('admin.slides')->with('status', 'Slide added successfully');
    }

    public function slide_edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slide-edit', compact('slide'));
    }

    public function slide_update(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'status' => 'required'
        ]);
        $slide = Slide::findOrFail($request->id);

        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image')) {

            if (File::exists(public_path('uploads/slides/' . $slide->image))) {
                File::delete(public_path('uploads/slides/' . $slide->image));
            }
            $img = $request->file('image');
            $img_extension = $request->file('image')->extension();
            $image_name = Carbon::now()->timestamp . '.' . $img_extension;
            $this->generateThumbnail($img, $image_name, 'slides', 690, 400);
            $slide->image = $image_name;
        }

        $slide->save();

        return redirect()->route('admin.slides')->with('status', 'Slide updated successfully');
    }

    public function slide_delete($id)
    {
        $slide = Slide::findOrFail($id);
        if (File::exists(public_path('uploads/slides/' . $slide->image))) {
            File::delete(public_path('uploads/slides/' . $slide->image));
        }
        $slide->delete();
        return redirect()->route('admin.slides')->with('status', 'Slide deleted successfully');
    }

    public function contacts(){
        $contacts = Contact::orderBy('created_at','DESC')->paginate(12);
        return view('admin.contacts',compact('contacts'));
    }

    public function contact_delete($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return back()->with('status','Message deleted successfully');
    }
    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name','LIKE',"%{$query}%")->get()->take(8);
        return response()->json($results);
    }
}
