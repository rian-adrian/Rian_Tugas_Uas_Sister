<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-container button {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="register-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style-type: none; padding-left: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Register</h2>
        <form method="POST" action="registerakun" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
            @error('name')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <input type="file" name="image" placeholder="Upload Image" id="imageUpload" accept="image/*" required>
            @error('image')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <img id="imagePreview" src="#" alt="Preview Image"
                style="display: none; max-width: 200px; max-height: 200px; padding-bottom: 2rem">

            <button type="submit">Register</button>
            <p>sudah punya akun? <a href="/login" style="">Login !</a></p>
        </form>

    </div>
    <script>
        // Function to preview image before upload
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('imagePreview');
                imgElement.src = reader.result;
                imgElement.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Add event listener to the file input element
        var fileInput = document.getElementById('imageUpload');
        fileInput.addEventListener('change', previewImage);
    </script>
</body>

</html>
