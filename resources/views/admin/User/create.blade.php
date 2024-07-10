@extends('admin.layouts.main')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New User</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('adminuser.store') }}" method="POST" enctype="multipart/form-data"
                            id="quickForm" onsubmit="submitForm(event)">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name User</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Enter name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Enter email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" id="image"
                                        onchange="previewImage(event)">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img id="imagePreview"
                                        style="display: none; max-width: 100%; height: auto; margin-top: 10px;">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Script untuk preview gambar -->
    <script>
        function previewImage(event) {
            const image = document.getElementById('image').files[0];
            const preview = document.getElementById('imagePreview');

            if (image) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(image);
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        }



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
                        title: 'Product created successfully',
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
