<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Khách hàng</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index=> $user)
                        @if($user->utype !== 'admin') {{-- Kiểm tra nếu không phải admin --}}
                        <tr>
                            <td>{{$index+$users->firstItem()}}</td>
                            <td>#{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->status == 1)
                                <span class="badge bg-success">Đang hoạt động</span>
                                @else
                                <span class="badge bg-danger">Không hoạt động</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($user->status == 0)
                                <a href="#" class="btn-small d-block" wire:click.prevent="unblockUser({{ $user->id }})" style="color:rgb(177, 6, 6);">Mở khóa</a>
                                @else
                                <a href="#" class="btn-small d-block" wire:click.prevent="blockUser({{ $user->id }})" style="color:rgb(177, 6, 6);">Chặn</a>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-danger">Không có khách hàng nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>