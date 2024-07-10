<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
        ]);
    }
    public function getalldata()
    {
        return response()->json([
            'message' => 'User created successfully',
            'user' => User::all(),
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
        return view('admin.user.create', [
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
            'email' => 'required|string|email|unique:users,email', // Menambahkan validasi unik untuk email
            'password' => 'required|string|min:6', // Validasi untuk password minimal 6 karakter
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika validasi berhasil, simpan data
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); // Enkripsi password sebelum disimpan

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->save();
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
        // Redirect dengan pesan sukses
        // return redirect("/adminuser")->with('success', 'User created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // dd($product);
        return view('admin.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id, // Menambahkan validasi unik untuk email, kecuali untuk pengguna dengan ID yang sedang diperbarui
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
        ]);

        // Ambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update nama dan email pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Mengelola gambar profil jika ada yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image) {
                $imagePath = public_path('images') . '/' . $user->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Pindahkan gambar baru ke direktori publik dan simpan nama file ke database
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        // Simpan perubahan ke dalam database
        $user->save();
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
        // Redirect dengan pesan sukses
        // return redirect("/adminuser")->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari produk berdasarkan ID
        $product = User::findOrFail($id);
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
            'message' => 'User Delete Success',
        ], 201);

    }

}
