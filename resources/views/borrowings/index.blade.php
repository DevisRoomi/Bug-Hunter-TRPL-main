@extends('layouts.app')

@section('title', 'Daftar Perlengkapan')

@section('hero')
    <section class="hero-cinema">
        <div class="hero-cinema__backdrop">
            <div class="hero-cinema__content">
                <div class="hero-cinema__headline-group">
                    <span class="badge-pill" style="margin-bottom: var(--space-xs);">
                        <span class="badge-pill__dot"></span>
                        Official Paddock Equipment
                    </span>
                    <h1 class="display-mega">{{ config('app.name') }}</h1>
                    <p class="hero-cinema__subtitle">
                        Sistem distribusi dan telemetri peminjaman perangkat resmi kompetisi Edurace. Pilih perlengkapan dan registrasikan kelompok Anda.
                    </p>
                </div>

                <div>
                    <a href="#katalog-alat" class="btn-primary">Jelajahi Alat</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert-banner" role="status">
            <div>
                <span class="caption-uppercase" style="color: var(--color-semantic-success); display: block; margin-bottom: 2px;">
                    Konfirmasi Telemetri
                </span>
                <strong style="color: var(--color-ink);">{{ session('success') }}</strong>
            </div>
            <span class="badge-pill">Tercatat</span>
        </div>
    @endif

    <!-- Spec Cells Bar (Ringkasan Statistik Paddock) -->
    <div class="spec-bar">
        <div class="spec-cell">
            <div class="number-display">{{ str_pad($equipments->count(), 2, '0', STR_PAD_LEFT) }}</div>
            <span class="caption-uppercase spec-cell__label">Katalog Perangkat</span>
        </div>
        <div class="spec-cell">
            <div class="number-display number-display--rosso">{{ str_pad($borrowings->count(), 2, '0', STR_PAD_LEFT) }}</div>
            <span class="caption-uppercase spec-cell__label">Log Transaksi Paddock</span>
        </div>
        <div class="spec-cell">
            <div class="number-display">{{ str_pad($borrowings->sum('quantity'), 2, '0', STR_PAD_LEFT) }}</div>
            <span class="caption-uppercase spec-cell__label">Total Unit Dipinjam</span>
        </div>
    </div>

    <!-- Band 1: Daftar Perlengkapan -->
    <section id="katalog-alat" class="editorial-band">
        <div class="band-header">
            <div>
                <span class="caption-uppercase band-header__eyebrow">01 / Technical Inventory</span>
                <h2 class="display-lg">Daftar Perlengkapan</h2>
            </div>
            <span class="badge-pill">{{ $equipments->count() }} Item Tersedia</span>
        </div>

        @if ($equipments->isNotEmpty())
            <ul class="equipment-list">
                @foreach ($equipments as $index => $equipment)
                    <li class="equipment-card">
                        <div>
                            <div class="equipment-card__media">
                                <span class="equipment-card__index">GEAR // {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <img src="{{ $equipment->image_url }}" alt="{{ $equipment->name }}" class="equipment-thumb">
                            </div>
                            <div class="equipment-card__body">
                                <span class="caption-uppercase equipment-card__meta">Edurace Spec</span>
                                <h3 class="title-md">{{ $equipment->name }}</h3>
                            </div>
                        </div>
                        <div class="equipment-card__footer">
                            <a href="{{ route('borrowings.create', $equipment) }}" class="btn-primary">
                                Pinjam Alat
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="empty-state">
                <p class="title-sm" style="margin-bottom: var(--space-xxs);">Belum ada perlengkapan.</p>
                <span>Inventaris perlengkapan akan segera ditampilkan di sini.</span>
            </div>
        @endif
    </section>

    <!-- Band 2: Riwayat Peminjaman (Race Calendar Row Style) -->
    <section class="editorial-band">
        <div class="band-header">
            <div>
                <span class="caption-uppercase band-header__eyebrow">02 / Live Dispatch Log</span>
                <h2 class="display-lg">Riwayat Peminjaman</h2>
            </div>
            <span class="badge-pill">Aktivitas Terbaru</span>
        </div>

        @if ($borrowings->isNotEmpty())
            <ul class="race-calendar-list">
                @foreach ($borrowings as $index => $borrowing)
                    <li class="race-calendar-row">
                        <span class="race-position-num">
                            #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div class="race-row__group">
                            {{ $borrowing->group_name }}
                        </div>

                        <div class="race-row__equipment">
                            <span class="badge-pill">Unit</span>
                            <span style="color: var(--color-ink); font-weight: 500;">{{ $borrowing->equipment->name }}</span>
                        </div>

                        <div class="race-row__qty">
                            {{ $borrowing->quantity }} <span class="caption-uppercase" style="color: var(--color-body);">Unit</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="empty-state">
                <p class="title-sm" style="margin-bottom: var(--space-xxs);">Belum ada peminjaman.</p>
                <span>Seluruh riwayat peminjaman kelompok akan tercatat secara real-time di bagian ini.</span>
            </div>
        @endif
    </section>
@endsection
