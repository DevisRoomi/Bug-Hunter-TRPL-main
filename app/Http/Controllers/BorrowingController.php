<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function index(): View
    {
        return view('borrowings.index', [
            'equipments' => Equipment::orderBy('name')->get(),
            'borrowings' => Borrowing::with('equipment')->latest('id')->get(),
        ]);
    }

    public function create(Equipment $equipment): View
    {
        return view('borrowings.create', compact('equipment'));
    }

    public function store(Request $request, Equipment $equipment): RedirectResponse
    {
        $validated = $request->validate([
            'group_name' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1', 'max:4294967295'],
        ], [
            'group_name.required' => 'Nama kelompok wajib diisi.',
            'quantity.required' => 'Jumlah pinjaman wajib diisi.',
            'quantity.integer' => 'Jumlah pinjaman harus berupa bilangan bulat.',
            'quantity.min' => 'Jumlah pinjaman minimal 1 unit.',
        ]);

        Borrowing::create([
            'equipment_id' => $equipment->id,
            'group_name' => $validated['group_name'],
            'quantity' => $validated['quantity'],
        ]);

        return to_route('borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }
}
