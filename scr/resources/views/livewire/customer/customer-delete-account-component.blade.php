<div>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card shadow" style="max-width: 500px; width: 100%; border-radius: 8px;">
            <div class="card-header text-center bg-danger text-white">
                <h4>Xóa Tài Khoản</h4>
            </div>
            <div class="card-body">
                @if (session()->has('account_deleted'))
                <div class="alert alert-success">
                    {{ session('account_deleted') }}
                </div>
                @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if(!$showConfirmation)
                <div class="text-center mb-4">
                    <p class="text-danger fw-bold">Cảnh báo: Hành động này không thể hoàn tác!</p>
                    <p>Khi xóa tài khoản:</p>
                    <ul class="text-start">
                        <li>Tất cả thông tin cá nhân của bạn sẽ bị xóa</li>
                        <li>Bạn sẽ không thể đăng nhập lại</li>
                        <li>Mọi dữ liệu liên quan sẽ bị xóa vĩnh viễn</li>
                    </ul>
                    <button wire:click="showDeleteConfirmation" class="btn btn-warning">
                        Tôi muốn xóa tài khoản
                    </button>
                </div>
                @else
                <div class="mb-3">
                    <label for="password" class="form-label">Nhập mật khẩu để xác nhận:</label>
                    <input type="password"
                        wire:model="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button wire:click="deleteAccount" class="btn btn-danger">
                        Xác nhận xóa tài khoản
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>