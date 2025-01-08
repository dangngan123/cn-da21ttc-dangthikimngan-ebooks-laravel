<div>
    <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 85vh; margin-top: -20px;">
        <div class="card shadow" style="width: 100%; max-width: 500px; border-radius: 8px;">
            <div class="card-header text-center bg-primary text-white">
                <h4>Đổi mật khẩu</h4>
            </div>
            <div class="card-body">
                @if(Session::has('password_success'))
                <div class="alert alert-success" role="alert">{{ Session::get('password_success') }}</div>
                @endif
                @if(Session::has('password_error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('password_error') }}</div>
                @endif
                <form class="form-horizontal" wire:submit.prevent="changePassword">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" id="current_password" class="form-control" placeholder="Nhập mật khẩu hiện tại"
                            name="current_password" wire:model="current_password">
                        @error('current_password') <p class="text-danger small">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới"
                            name="password" wire:model="password">
                        @error('password') <p class="text-danger small">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" id="password_confirmation" class="form-control"
                            placeholder="Nhâp lại mật khẩu" name="password_confirmation"
                            wire:model="password_confirmation">
                        @error('password_confirmation') <p class="text-danger small">{{ $message }}</p> @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
