@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Detail Kategori</h4>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">ID</th>
                            <td>{{ $kategori->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kategori</th>
                            <td>{{ $kategori->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $kategori->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $kategori->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $kategori->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus kategori?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection