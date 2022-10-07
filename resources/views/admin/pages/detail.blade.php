@extends('admin/layout/main')
@section('content')
    <div class="d-flex justify-content-center p-5">
        <table class="table table-hover table-bordered">
            <thead style="background-color: #00a6ff">
                <tr>
                    <th>No</th>
                    <th class="col-4">Nama</th>
                    <th class="col-6">Alamat</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasis as $lokasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lokasi->name }}</td>
                        <td class="text-wrap">{{ $lokasi->address }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="/detail-lokasi/{{ $lokasi->id }}"><i
                                    class="mdi mdi-eye me-1"></i>Detail</a>
                            <a class="btn btn-secondary btn-sm" href="/edit/{{ $lokasi->id }}"><i
                                    class="mdi mdi-pencil me-1"></i>Edit</a>
                            <a class="btn btn-danger btn-sm" href="/delete/{{ $lokasi->id }}"><i
                                    class="mdi mdi-trash-can me-1"></i>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
