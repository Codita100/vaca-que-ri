<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Campaign;
use App\Models\Backend\Product;
use App\Models\Backend\ProductsCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $imageName = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('images/products'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->points = $request->points;
        $product->photo = $imageName;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produs adăugat cu succes!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'quantity' => 'required|string',
            'points' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];


        $messages = [
            'name.required' => 'Numele produsului este obligatoriu.',
            'quantity.required' => 'Câmpul Cantitate este obligatoriu.',
            'points.required' => 'Câmpul Puncte este obligatoriu.',
            'photo.image' => 'Fișierul trebuie să fie o imagine.',
            'photo.mimes' => 'Imaginea trebuie să fie de tipul: jpeg, png, jpg, gif.',
            'photo.max' => 'Imaginea nu poate depăși 2 MB.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->points = $request->input('points');

        if ($request->hasFile('photo')) {
            $imageName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('images/products'), $imageName);
            $product->photo = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produsul a fost actualizat cu succes!');
    }


    public
    function delete($id)
    {
        $product = Product::find($id);
        //TODO::delete only if it's not used
        $product->delete();
        return redirect()->back()->with('success', 'Produsul a fost sters');
    }


    protected
    function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'points' => 'required|integer|min:1',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ];
    }

}
