@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <!-- Form Buang Sampah -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Buang Sampah</div>
        <div class="card-body">
            <form action="{{ route('waste-transactions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="waste_type" class="form-label">Jenis Sampah</label>
                    <select name="waste_type" id="waste_type" class="form-select" required>
                        <option value="organik">Organik</option>
                        <option value="anorganik">Anorganik</option>
                        <option value="plastik">Plastik</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Berat Sampah (kg)</label>
                    <input type="number" step="0.1" name="weight" id="weight" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Buang Sampah</button>
            </form>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="card">
        <div class="card-header bg-primary text-white">Riwayat Transaksi Sampah</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Koin</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst($transaction->waste_type) }}</td>
                            <td>{{ $transaction->weight }}</td>
                            <td>{{ $transaction->coins }}</td>
                            <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
