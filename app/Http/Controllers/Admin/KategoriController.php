<?php
namespace App\Http\Controllers\Admin;
use App\Models\Kategori;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class KategoriController extends Controller
{
    // Method untuk mengecek apakah user sudah login sebagai admin
    private function checkAdminAuth()
    {
        if (!session('admin_user_id')) {
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        $user = User::find(session('admin_user_id'));
        
        if (!$user || $user->role !== 'admin') {
            session()->flush();
            return redirect('/admin/login')->with('error', 'Akses ditolak! Hanya admin yang bisa mengakses halaman ini.');
        }

        return null;
    }

    public function index()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        Kategori::create($request->all());

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $kategori = Kategori::findOrFail($id);
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        $kategori->update($request->all());

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        $authCheck = $this->checkAdminAuth();
        if ($authCheck) return $authCheck;

        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}

