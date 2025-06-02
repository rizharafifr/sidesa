<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index()
    {
        $residentId = Auth::user()->resident->id ?? null;
        $complaints = Complaint::when(Auth::user()->role_id == 2, function ($query) use ($residentId) {
            $query->where('resident_id', $residentId);
        })->paginate(5);

        return view('pages.complaint.index', compact(
            'complaints',
        ));
    }

    public function create()
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk');
        }

        return view('pages.complaint.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2555'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $resident = Auth::user()->resident;

        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk');
        }

        $complaint = new Complaint();
        $complaint->resident_id = $resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Behasil membuat aduan');
    }

    public function edit($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk');
        }
        $complaint = Complaint::findOrFail($id);

        return view('pages.complaint.edit', compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2555'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk');
        }

        $complaint = Complaint::findOrFail($id);

        if ($complaint->status !== 'new') {
            return redirect('/complaint')->with('error', "Gagal menghapus aduan, status anda saat ini adalah $complaint->status_label");
        }

        $complaint->resident_id = $resident->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            if (isset($complaint->photo_proof)) {
                Storage::delete($complaint->photo_proof);
            }
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Behasil mengubah aduan');
    }

    public function update_status(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['new', 'processing', 'completed'])],
        ]);

        $resident = Auth::user()->resident;
        if (Auth::user()->role_id == 2 && !$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk');
        }

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->input('status');

        $complaint->save();

        return redirect('/complaint')->with('success', 'Behasil mengubah status');
    }

    public function destroy($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk');
        }
        $complaint = Complaint::findOrFail($id);
        if ($complaint->status !== 'new') {
            return redirect('/complaint')->with('error', "Gagal menghapus aduan, status anda saat ini adalah $complaint->status_label");
        }
        $complaint->delete();

        return redirect('/complaint')->with('success', 'Behasil menghapus aduan');
    }
}
