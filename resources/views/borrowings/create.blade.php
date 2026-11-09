@extends('layouts.app')

@section('title', 'Form Peminjaman')

@section('content')
    <div style="margin-bottom: var(--space-lg);">
        <a href="{{ route('borrowing.index') }}" class="btn-tertiary">
            &larr; Kembali ke daftar alat
        </a>
    </div>

    <section class="editorial-band">
        <div class="band-header">
            <div>
                <span class="caption-uppercase band-header__eyebrow">Paddock Requisition Form</span>
                <h1 class="display-xl">Pinjam  {{ $equipment->name }}</h1>
            </div>
            <span class="badge-pill">
                <span class="badge-pill__dot"></span>
                Ready for Dispatch
            </span>
        </div>

        <div class="form-split-layout">
            <!-- Sisi Kiri: Equipment Showcase Plate (driver-card style) -->
            <div class="driver-showcase-card">
                <div class="driver-showcase-card__badge">
                    <span class="badge-pill">Selected Gear</span>
                </div>

                <img
                    src="{{ $equipment->image_url }}"
                    alt="{{ $equipment->name }}"
                    class="equipment-image-large"
                >

                <h2 class="display-md" style="margin-bottom: var(--space-xs);">{{ $equipment->name }}</h2>

                <div class="driver-showcase-card__footer">
                    <span class="caption-uppercase">Status Unit</span>
                    <span class="caption-uppercase" style="color: var(--color-ink);">Tersedia di Posko</span>
                </div>
            </div>

            <!-- Sisi Kanan: Formulir Peminjaman (text-input-on-dark) -->
            <div class="form-panel">
                <div style="margin-bottom: var(--space-md); padding-bottom: var(--space-sm); border-bottom: 1px solid var(--color-hairline);">
                    <h2 class="title-md">Detail Peminjaman Kelompok</h2>
                    <p style="margin: 6px 0 0; color: var(--color-body);">
                        Lengkapi identitas kelompok dan kuantitas unit sebelum mengirim permintaan ke posko.
                    </p>
                </div>

                <form method="POST" action="{{ route('borrowings.store', $equipment) }}">
                    @csrf

                    <div class="form-group">
                        <label for="group_name" class="form-label">Nama kelompok</label>
                        <input
                            id="group_name"
                            name="group_name"
                            type="text"
                            class="text-input-dark"
                            value="{{ old('group_name') }}"
                            placeholder="Contoh: Kelompok 3"
                            required
                        >
                        @error('group_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="form-label">Jumlah Unit</label>
                        <input
                            id="quantity"
                            name="quantity"
                            type="number"
                            step="1"
                            min="1"
                            class="text-input-dark"
                            value="{{ old('quantity', 1) }}"
                            required
                        >
                        @error('quantity')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            Kirim Peminjaman
                        </button>
                        <a href="{{ route('borrowing.index') }}" class="btn-outline-dark">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
