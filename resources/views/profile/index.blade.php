@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">

    <!-- Section 1: Profil Pengguna -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header bg-success text-white">Profil Pengguna</div>

                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <a href="{{ route('profile.index') }}" class="btn btn-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Transaksi Sampah -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">Transaksi Sampah</div>

                <div class="card-body">
                    <form action="{{ route('waste-transactions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="waste_type" class="form-label">Jenis Sampah</label>
                            <input type="text" class="form-control" id="waste_type" name="waste_type" required placeholder="Masukkan jenis sampah">
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Berat (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="weight" name="weight" required placeholder="Masukkan berat sampah (kg)">
                        </div>
                        <div class="mb-3">
                            <label for="coins" class="form-label">Koin</label>
                            <input type="number" class="form-control" id="coins" name="coins" required placeholder="Masukkan jumlah koin">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                    </form>

                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Sampah</th>
                                <th>Berat (kg)</th>
                                <th>Koin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->waste_type }}</td>
                                    <td>{{ $transaction->weight }}</td>
                                    <td>{{ $transaction->coins }}</td>
                                    <td>
                                        <form action="{{ route('waste-transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada transaksi. Tambahkan transaksi baru untuk mulai!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
