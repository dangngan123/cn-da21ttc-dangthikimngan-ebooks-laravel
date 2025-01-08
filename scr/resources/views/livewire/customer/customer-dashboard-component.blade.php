<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Trang chủ</a>
                    <span></span> Tài khoản của tôi
                </div>
            </div>
        </div>
        <section class="pt-10 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-30 m-auto">
                        <div class="row  g-1">
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="account-tab" data-bs-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Tài khoản của tôi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false"><i class="fi-rs-user mr-10"></i>Đổi mật khẩu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="delete_account-tab" data-bs-toggle="tab" href="#delete_account" role="tab" aria-controls="delete_account" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Xóa tài khoản</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>Địa chỉ</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="login.html"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div>
                                                <div class="container_body">


                                                    <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="name">Tên</label>
                                                            <input type="text" wire:model="name" id="name" class="form-control">
                                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" wire:model="email" id="email" class="form-control">
                                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </form>
                                                </div>

                                                <style>
                                                    .profile-card {
                                                        text-align: center;
                                                        background-color: #f8f9fa;
                                                        padding: 15px;
                                                        /* Reduced padding */
                                                        border-radius: 10px;
                                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                        max-width: 350px;
                                                        /* Reduced max-width */
                                                        width: 100%;
                                                        margin: 0 auto;
                                                        /* Changed from 10px auto to 0 auto */
                                                    }

                                                    .container_body {
                                                        max-width: 800px;
                                                        margin: 0 auto;
                                                        padding: 10px 20px 20px;
                                                        /* Added top padding */
                                                    }


                                                    .avatar-container {
                                                        position: relative;
                                                        margin-bottom: 20px;
                                                        display: inline-block;
                                                        /* Changed from flex to inline-block */
                                                    }

                                                    .avatar-img,
                                                    .avatar-placeholder {
                                                        width: 120px;
                                                        height: 120px;
                                                        border-radius: 50%;
                                                        border: 3px solid #007bff;
                                                    }

                                                    .avatar-placeholder {
                                                        background-color: #007bff;
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        color: white;
                                                        font-size: 40px;
                                                        font-weight: bold;
                                                    }

                                                    .edit-icon {
                                                        position: absolute;
                                                        bottom: 5px;
                                                        /* Move slightly upward */
                                                        right: 5px;
                                                        /* Move more inward */
                                                        background-color: rgba(0, 0, 0, 0.5);
                                                        padding: 5px;
                                                        border-radius: 50%;
                                                        color: white;
                                                        cursor: pointer;
                                                        font-size: 14px;
                                                        width: 24px;
                                                        height: 24px;
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                    }

                                                    .edit-icon i {
                                                        font-size: 10px;
                                                    }

                                                    .btn {
                                                        width: auto;
                                                        /* Changed from 100% to auto */
                                                        padding: 10px 20px;
                                                        /* Reduced padding */
                                                        background-color: #007bff;
                                                        color: white;
                                                        font-size: 1rem;
                                                        border: none;
                                                        border-radius: 5px;
                                                        cursor: pointer;
                                                        display: block;
                                                        /* Added display: block */
                                                        margin: 0 auto;
                                                        /* Center the button */
                                                    }


                                                    .btn:hover {
                                                        background-color: #0056b3;
                                                    }

                                                    .text-danger {
                                                        color: #dc3545;
                                                        font-size: 0.875rem;
                                                        margin-top: 5px;
                                                        display: block;
                                                    }

                                                    .alert {
                                                        padding: 12px;
                                                        margin-bottom: 20px;
                                                        border: 1px solid transparent;
                                                        border-radius: 5px;
                                                    }

                                                    .alert-success {
                                                        background-color: #d4edda;
                                                        border-color: #c3e6cb;
                                                        color: #155724;
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                                        @livewire('customer.customer-account-component')
                                    </div>
                                    <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                        @livewire('customer.customer-change-password-component')
                                    </div>
                                    <div class="tab-pane fade" id="delete_account" role="tabpanel" aria-labelledby="delete_account-tab">
                                        @livewire('customer.customer-delete-account-component')
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        @livewire('customer.customer-address-component')
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>