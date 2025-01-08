<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow">Trang chủ</a>
                <span></span> Liên hệ
            </div>
        </div>
    </div>
    <div class="contact-container">
        <div wire:loading class="loading-overlay">
            <div class="spinner"></div>
        </div>

        @if(session()->has('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger animate__animated animate__fadeIn">
            {{ session('error') }}
        </div>
        @endif

        <div class="contact-header">
            <h1>Liên hệ với chúng tôi</h1>
            <p>Chúng tôi luôn sẵn sàng lắng nghe ý kiến của bạn</p>
        </div>

        <form wire:submit.prevent="submit" class="contact-form">
            <div class="form-group">
                <label for="name">Họ và tên <span class="required">*</span></label>
                <input
                    type="text"
                    id="name"
                    wire:model.lazy="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nhập họ và tên của bạn">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input
                    type="email"
                    id="email"
                    wire:model.lazy="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="example@domain.com">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telephone">Số điện thoại <span class="required">*</span></label>
                <input
                    type="tel"
                    id="telephone"
                    wire:model.lazy="telephone"
                    class="form-control @error('telephone') is-invalid @enderror"
                    placeholder="0xxxxxxxxx"
                    pattern="[0-9]{10,11}">
                @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject">Chủ đề <span class="required">*</span></label>
                <input
                    type="text"
                    id="subject"
                    wire:model.lazy="subject"
                    class="form-control @error('subject') is-invalid @enderror"
                    placeholder="Nhập chủ đề">
                @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Nội dung tin nhắn <span class="required">*</span></label>
                <textarea
                    id="message"
                    wire:model.lazy="message"
                    class="form-control @error('message') is-invalid @enderror"
                    rows="5"
                    placeholder="Nhập nội dung tin nhắn của bạn"></textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>Gửi tin nhắn</span>
                    <span wire:loading>Đang gửi...</span>
                </button>
            </div>
        </form>
    </div>

    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .page-header {
            background: #fff;
            padding: 1rem 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: #0066cc;
        }

        .contact-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .contact-header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .contact-header p {
            color: #666;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .required {
            color: #dc3545;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .btn-submit {
            background: #0066cc;
            color: #fff;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-submit:hover {
            background: #0052a3;
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #0066cc;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                margin: 1rem;
                padding: 1.5rem;
            }

            .contact-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('contactSubmitted', () => {
                setTimeout(() => {
                    window.location.href = '{{ route("home") }}';
                }, 2000);
            });
        });
    </script>
</div>