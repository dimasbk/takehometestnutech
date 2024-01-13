<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(25);
        $categories = Category::all();
        $filter = "";
        $search = null;

        return view('product', compact(['products', 'categories', 'filter', 'search']));
    }

    public function create()
    {
        $categories = Category::all();

        return view('add-product', compact(['categories']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nama_produk' => 'required|unique:products',
            'hargaBeli' => 'required|numeric',
            'hargaJual' => 'required|numeric',
            'stokBarang' => 'required|numeric',
            'uploadImage' => 'required|image|mimes:png|max:100',
        ]);

        if ($request->hasFile('uploadImage')) {
            $image = $request->file('uploadImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $product = Product::create([
                'nama_produk' => $request->input('nama_produk'),
                'id_kategori' => $request->input('kategori'),
                'harga_beli' => $request->input('hargaBeli'),
                'harga_jual' => $request->input('hargaJual'),
                'stok' => $request->input('stokBarang'),
                'image_name' => $imageName
            ]);
        }

        return redirect()->back()->with('success', 'Product has been stored successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product has been deleted successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('update-product', compact(['product', 'categories']));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nama_produk' => 'required',
            'hargaBeli' => 'required|numeric',
            'hargaJual' => 'required|numeric',
            'stokBarang' => 'required|numeric',
            'uploadImage' => 'required|image|mimes:png|max:100',
        ]);

        if ($request->hasFile('uploadImage')) {
            $image = $request->file('uploadImage');
            Storage::delete('images/' . $request->input('uploadImage'));
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $product = Product::where('id', $request->id)->update([
                'nama_produk' => $request->input('nama_produk'),
                'id_kategori' => $request->input('kategori'),
                'harga_beli' => $request->input('hargaBeli'),
                'harga_jual' => $request->input('hargaJual'),
                'stok' => $request->input('stokBarang'),
                'image_name' => $imageName
            ]);
        }

        return redirect()->back()->with('success', 'Product has been updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->parameter;
        $filter = "";

        $products = Product::where('nama_produk', 'like', '%' . $search . '%')->paginate(25);
        $categories = Category::all();

        return view('product', compact(['products', 'categories', 'filter', 'search']));
    }

    public function filter(Request $request)
    {
        $filter = $request->filterProduct;
        $search = "";
        $products = Product::where('id_kategori', $filter)->paginate(25);
        $categories = Category::all();

        return view('product', compact(['products', 'categories', 'filter']));
    }

    public function export(Request $request)
    {
        $data = Product::where('nama_produk', 'like', '%' . $request->search . '%')
            ->orWhere('id_kategori', $request->filter)
            ->get();

        return Excel::download(new ProductsExport($data), 'exported_data.xlsx');
    }
}
