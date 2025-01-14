<div>
    <div class="container_body">
        <div class="profile-card">
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
            <div>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <!-- Your form and other content goes here -->
            </div>
        </div>
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