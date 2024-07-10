<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.product.index');
    }

    public function getalldata()
    {

        return response()->json([
            'message' => 'Product created successfully',
            'product' => Product::all(),
        ], 201);
        //ambil semua data product
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            //TODO
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

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'harga' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika validasi berhasil, simpan data
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->harga = $request->harga;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }
        $product->save();

        // Redirect dengan pesan sukses
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // dd($product);
        return view('admin.product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'harga' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk gambar
        ]);

        $product = Product::findOrFail($id);

        // Hapus gambar lama jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari public/images jika ada
            if ($product->image) {
                $imagePath = public_path('images') . '/' . $product->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Pindahkan gambar baru ke public/images dan simpan nama file ke database
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Update data produk lainnya
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->harga = $request->input('harga');
        $product->save();

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
        // return redirect('/adminproduct')->with('success', 'Product updated successfully.');
    }
    public function updateApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'harga' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk gambar
        ]);
        $id = $request->input('id');
        $product = Product::findOrFail($id);

        // Hapus gambar lama jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari public/images jika ada
            if ($product->image) {
                $imagePath = public_path('images') . '/' . $product->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Pindahkan gambar baru ke public/images dan simpan nama file ke database
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Update data produk lainnya
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->harga = $request->input('harga');
        $product->save();

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
        // return redirect('/adminproduct')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari produk berdasarkan ID

        $product = Product::findOrFail($id);
        if (!$product) {
            return response()->json([
                'message' => 'Data not Found',
            ], 400);
        }
        // Hapus gambar produk dari penyimpanan jika ada
        if ($product->image) {
            $imagePath = public_path('images') . '/' . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus produk dari database
        $product->delete();

        return response()->json([
            'message' => 'Data Delete Success',
        ], 201);

    }
    public function destroyApi(Request $request)
    {
        // Cari produk berdasarkan ID
        $id = $request->input('id');
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return response()->json([
                'message' => 'Data not Found',
            ], 400);
        }
        // Hapus gambar produk dari penyimpanan jika ada
        if ($product->image) {
            $imagePath = public_path('images') . '/' . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus produk dari database
        $product->delete();

        return response()->json([
            'message' => 'Data Delete Success',
        ], 201);

    }
}
