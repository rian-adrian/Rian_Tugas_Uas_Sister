@extends('admin.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/adminuser/create" class="btn btn-primary">Tambah</a>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Name User</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td><img src="{{ asset('/images/' . $user->image) }}" alt=""
                                                    style="width: 50px; height: auto;"></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="/adminuser/{{ $user->id }}/edit"
                                                        class="btn btn-success mr-2">Edit</a>
                                                    <form action="{{ route('adminuser.destroy', $user->id) }}"
                                                        method="post" id="quickForm" onsubmit="submitForm(event)">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody> --}}
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //buat tampilan menggunakan ajax setelah mengambil data
        $(document).ready(function() {
            $.ajax({
                url: 'http://127.0.0.1:8000/getalldatauser',
                method: 'GET',
                success: function(response) {
                    let user = response.user;
                    let tableBody = $('tbody');
                    tableBody.empty();

                    $.each(user, function(index, user) {
                        let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td><img src="/images/${user.image}" alt="" style="width: 50px; height: 50px;"></td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="/adminproduct/${user.id}/edit" class="btn btn-success">Edit</a>
                                <form action="/adminproduct/${user.id}" method="post" id="quickForm" onsubmit="submitForm(event)">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" value="${user.id}">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>`;
                        tableBody.append(row);
                    });
                }
            });
        });
    </script>
    <script>
        function submitForm(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: formData,
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Product Deleted successfully',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = '/adminuser';
                    });
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });;
        }
    </script>
@endsection
