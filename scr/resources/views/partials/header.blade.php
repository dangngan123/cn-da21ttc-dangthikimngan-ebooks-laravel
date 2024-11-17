<style>
        .nav-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1.5rem;
        }
        .nav-icon span {
            font-size: 0.75rem; /* Kích thước chữ nhỏ hơn cho nhãn */
        }
    </style>
</head>
<body>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="img/logos/logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Books</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh mục</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-3" style="flex-grow: 1; max-width: 450px;">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search" style="border-radius: 20px;">
                <button class="btn btn-outline-dark" type="submit" style="border-radius: 20px;">
                    <i class="bi bi-search"></i> <!-- Biểu tượng tìm kiếm -->
                </button>
            </form>
            <div class="d-flex align-items-center">
                <form class="d-flex me-3">
                    <button class="btn btn-outline-dark" type="submit" style="border-radius: 20px; margin-right: -10px;">
                        <i class="bi-cart-fill me-1"></i>
                        Giỏ hàng
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
                <a class="nav-link" href="#!" style="position: relative; padding: 0 10px;">
                    <div class="nav-icon">
                        <i class="bi bi-bell-fill"></i>
                        <span class="badge bg-danger" style="position: absolute; top: -5px; right: 10px;">3</span>
                        <span>Thông báo</span>
                    </div>
                </a>
                <a class="nav-link" href="#" style="position: relative; padding: 0 20px;">
                    <div class="nav-icon">
                        <i class="bi bi-person-circle"></i>
                        <span>Tài khoản</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</nav>