<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password | toko baju</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <!-- reCAPTCHA -->
</head>

<body>
    <!-- Form Login -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            @if (session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 3000, // 3 seconds
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif
            @if ($errors->any())
                <div class="alertfail alert-danger">
                    <ul style="list-style-type: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow-lg p-3 .bg-light.bg-gradient">
                <div class="card-body">
                    <form method="post" action="/lupapw">
                        @csrf
                        <div class="form-group" style="padding-top: 5%; padding-bottom: 5%;">
                            <label for="exampleInputEmail1">Kirim Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter email">
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href=""><button type="button" class="btn btn-danger"
                                    style="width: 100px">Batal</button></a>
                            <button type="submit" class="btn btn-primary" style="width: 100px">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
