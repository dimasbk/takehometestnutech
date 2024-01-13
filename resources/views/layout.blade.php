<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        #sidebar {
            background-color: #f42619;
            color: white;
            min-height: 100vh;
        }

        #sidebar a {
            color: white;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-sticky">
                    <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
                        SIMS Web App
                    </h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/products">
                                <img src="{{ asset('assets/Package.png') }}" alt="product" class="mr-2" width="20"
                                    height="20">
                                Produk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">
                                <img src="{{ asset('assets/User.png') }}" alt="profile" class="mr-2" width="20"
                                    height="20">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            @auth
                            <a class="nav-link" href="/" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <img src="{{ asset('assets/SignOut.png') }}" alt="logout" class="mr-2" width="20"
                                    height="20">
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endauth
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>