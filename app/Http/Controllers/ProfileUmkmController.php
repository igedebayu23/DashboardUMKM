<?php

namespace App\Http\Controllers;

use App\Models\ProfileUmkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProfileUmkmController extends Controller
{
    public function index(Request $request): View
    {
        $profiles = ProfileUmkm::query()
            ->when($request->string('search')->trim()->value(), function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('nama_umkm', 'like', "%{$search}%")
                        ->orWhere('nama_pemilik', 'like', "%{$search}%")
                        ->orWhere('sektor', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_umkm')
            ->paginate(10)
            ->withQueryString();

        return view('profile-umkm.index', compact('profiles'));
    }

    public function create(): View
    {
        return view('profile-umkm.form', ['profile' => new ProfileUmkm]);
    }

    public function store(Request $request): RedirectResponse
    {
        ProfileUmkm::create($this->validated($request));

        return redirect()->route('profile-umkm.index')->with('success', 'Profile UMKM berhasil ditambahkan.');
    }

    public function edit(ProfileUmkm $profileUmkm): View
    {
        Gate::authorize('update', $profileUmkm);

        return view('profile-umkm.form', ['profile' => $profileUmkm]);
    }

    public function update(Request $request, ProfileUmkm $profileUmkm): RedirectResponse
    {
        Gate::authorize('update', $profileUmkm);
        $profileUmkm->update($this->validated($request));

        return redirect()->route('profile-umkm.index')->with('success', 'Profile UMKM berhasil diperbarui.');
    }

    public function destroy(ProfileUmkm $profileUmkm): RedirectResponse
    {
        Gate::authorize('delete', $profileUmkm);
        $profileUmkm->delete();

        return back()->with('success', 'Profile UMKM berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_umkm' => ['required', 'string', 'max:255'],
            'sektor' => ['required', 'string', 'max:100'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'jumlah_karyawan' => ['required', 'integer', 'min:0'],
        ]);
    }
}
