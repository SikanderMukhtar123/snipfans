<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    .card {
        width: 35%;
        margin-top: 5%;
    }

    @media (max-width:375px) {
        .card {
            width: 90%;
        }
    }

    @media (min-width:375px) and (max-width: 425px) {
        .card {
            width: 90%;
        }
    }

    @media (min-width:425px) and (max-width: 768px) {
        .card {
            width: 90%;
        }
    }
</style>

<body class="bg-light">

    <div class="card mx-auto shadow-sm rounded-4 border-0">
        <div class="card-header bg-white border-0 text-center">
            <h3 class="fw-bold mt-3">Login</h3>
        </div>
        <div class="card-body bg-white">
            <form action="{{ route('login.request') }}" method="post">
                @csrf

                <!-- Email Field -->
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Email" required>
                    <label for="email">Email</label>
                    @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>