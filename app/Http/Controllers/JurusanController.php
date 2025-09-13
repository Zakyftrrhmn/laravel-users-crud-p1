<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|unique:jurusans',
            'logo_jurusan' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $path = null;

        if ($request->hasFile('logo_jurusan')) {
            $path = $request->file('logo_jurusan')->store('jurusan', 'public');
        }

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'logo_jurusan' => $path
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Successfully added Jurusan data');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan' . $jurusan->id,
            'logo_jurusan' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $path = $jurusan->logo_jurusan;

        if ($request->hasFile('logo_jurusan')) {
            if ($jurusan->logo_jurusan) {
                Storage::disk('public')->delete($jurusan->logo_jurusan);
            }

            $path = $request->file('logo_jurusan')->store('jurusan', 'public');
        }

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
            'logo_jurusan' => $path
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Successfully Edit Data');
    }

    public function destroy(Jurusan $jurusan)
    {
        if ($jurusan->logo_jurusan) {
            Storage::disk('public')->delete($jurusan->logo_jurusan);
        }

        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Successfully delete data');
    }
}
