<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at','DESC')->get();
        $slides = Slide::where('status',1)->get()->take(3);
        $sale_products = Product::whereNotNull('sale_price')->where('sale_price','<>','')->inRandomOrder()->get()->take(8);
        $f_products = Product::where('featured',1)->get()->take(8); 
        return view('index',compact('slides','categories','sale_products','f_products'));
    }

    public function contact(){
        return view('contact');
    }

    public function contact_store(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required|numeric',
            'email'=>'required|email',
            'comment'=>'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->comment = $request->comment;

        $contact->save();

        return back()->with('success','Message sent successfully');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name','LIKE',"%{$query}%")->get()->take(8);
        return response()->json($results);
    }
    
}