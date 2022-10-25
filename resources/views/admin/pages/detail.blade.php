@extends('admin/layout/main')
@section('content')
    <div class="d-flex justify-content-end me-5 mt-3">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari nama fasilitas.." title="Type in a name"
            style="background-image: url('/images/search.png'); background-position: 10px 10px;
    background-repeat: no-repeat; background-size: 20px; padding: 12px 20px 12px 40px; width: 30%;">
    </div>
    <div class="d-flex justify-content-center ms-5 mt-2 me-5">
        <table class="table table-hover table-bordered" id="myTable">
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
    <div class="d-flex justify-content-end me-5 mt-2">
        {{ $lokasis->links() }}
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
