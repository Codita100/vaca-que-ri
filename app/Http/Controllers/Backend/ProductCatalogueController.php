<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Campaign;
use App\Models\Backend\ProductCatalog;
use App\Models\Frontend\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCatalogueController extends Controller
{
    public function index()
    {
        $products = ProductCatalog::all();

        return view('backend.products_catalogue.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products_catalogue.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $product = new ProductCatalog();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->points = $request->points;
        $product->save();

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images/products_catalogue'), $imageName);

                $multiImage = new MultiImage();
                $multiImage->product_catalogs_id = $product->id;
                $multiImage->photo = $imageName;
                $multiImage->save();
            }
        }

        return redirect()->route('products.catalogue.index')->with('success', 'Produs adăugat cu succes!');
    }

    public function edit($id)
    {
        $product = ProductCatalog::find($id);
        return view('backend.products_catalogue.edit', compact('product',));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric',
            'points' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ];


        $messages = [

        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $product = ProductCatalog::findOrFail($id);
        $product->name = $request->input('name');
        $product->stock = $request->input('stock');
        $product->points = $request->input('points');


        if ($request->hasFile('photos')) {

            //delete
            foreach ($product->multiImages as $image) {
                $imagePath = public_path('images/products_catalogue/' . $image->photo);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            //add new
            foreach ($request->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images/products_catalogue'), $imageName);

                $multiImage = new MultiImage();
                $multiImage->photo = $imageName;
                $multiImage->product_catalogs_id = $product->id;
                $multiImage->save();
            }
        }

        $product->save();

        return redirect()->route('products.catalogue.index')->with('success', 'Produsul a fost actualizat cu succes!');
    }


    public
    function delete($id)
    {
        $product = ProductCatalog::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produsul nu a fost găsit.');
        }

        if ($product->orders()->exists()) {
            return redirect()->back()->with('error', 'Nu poți șterge acest produs deoarece există comenzi asociate cu el.');
        }

        $images = MultiImage::where('product_catalogs_id', $id)->get();

        foreach ($images as $image) {
            $imagePath = public_path('images/products_catalogue/' . $image->photo);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        $product->delete();
        return redirect()->back()->with('success', 'Produsul a fost sters');
    }


    protected
    function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'points' => 'required|integer|min:1',
            'photos' => 'required|array|max:3', // maximum 3 images
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', //2MB per image
        ];
    }

    public function getAllCatalogueProducts(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'points',
            3 => 'stock',
            4 => 'photo',
            5 => 'action',
        );

        $products = ProductCatalog::count();


        $limit = $request->input('length');
        $start = $request->input('start');
        $dir = $request->input('order.0.dir');
        $orderColumnIndex = $request->input('order.0.column');
        $order = $columns[$orderColumnIndex] ?? 'created_at';

        // Query
        $query = ProductCatalog::leftJoin('multi_images', function($join) {
            $join->on('product_catalogs.id', '=', 'multi_images.product_catalogs_id')
                ->where('multi_images.id', '=', function($query) {
                    $query->select('id')
                        ->from('multi_images')
                        ->whereColumn('product_catalogs_id', 'product_catalogs.id')
                        ->orderBy('id')
                        ->limit(1);
                });
        })
            ->select('product_catalogs.*', 'multi_images.photo');


        $search = $request->input('search.value');
        if (!empty($search)) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('product_catalogs.name', 'LIKE', "%{$search}%")
                    ->orWhere('product_catalogs.stock', 'LIKE', "%{$search}%");
            });
        }

        $totalData = $query->count();
        $totalFiltered = $query->count();

        $query->orderBy($order, $dir);

        $products_catalogue = $query->offset($start)->limit($limit)->get();


        $data = [];
        foreach ($products_catalogue as $key => $prod_cat) {
            $nestedData['id'] = $prod_cat->id;
            $nestedData['name'] = $prod_cat->name;
            $nestedData['points'] = $prod_cat->points;
            $nestedData['stock'] = $prod_cat->stock;
            $nestedData['photo'] = '<img src="' . asset('/images/products_catalogue/' . $prod_cat->photo) . '" alt="Product Image" style="max-width: 100px; max-height: 100px;">';
            $actions = '';
            $actions = '<a class="btn btn-primary waves-effect waves-light m-1" href="' . route('product.catalogue.edit', $prod_cat->id) . '" title="Ai voie?"> Edit </a>';
            $actions .= '<a class="btn btn-warning waves-effect waves-light m-1" href="' . route('product.catalogue.delete', $prod_cat->id) . '" > Delete </a>';

            $nestedData['action'] = $actions;


            $data[] = $nestedData;
        }


        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        return response()->json($json_data);
    }
}
