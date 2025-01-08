
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quản lý liên hệ</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Chủ đề</th>
                                <th>Tin nhắn</th>
                                <th>Ngày tạo</th>
                                <th>Trạng Thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $index => $contact)
                            <tr wire:key="contact-{{ $contact->id }}">
                                <td>{{$index+$contacts->firstItem()}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->telephone}}</td>
                                <td>{{$contact->subject}}</td>
                                <td>{{$contact->message}}</td>
                                <td>{{$contact->created_at->format('d/m/Y H:i')}}</td>
                                <td>
                                    <span class="badge bg-{{ $contact->status == 0 ? 'warning' : 'success' }}">
                                        {{ $contact->status == 0 ? 'Chưa xử lý' : 'Đã xử lý' }}
                                    </span>
                                </td>
                                <td>
                                    <button
                                        wire:click="sendEmail({{ $contact->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="sendEmail({{ $contact->id }})"
                                        class="btn btn-primary btn-sm"
                                        {{ $contact->status == 1 ? 'disabled' : '' }}>
                                        <span wire:loading.remove wire:target="sendEmail({{ $contact->id }})">
                                            Gửi
                                        </span>
                                        <span wire:loading wire:target="sendEmail({{ $contact->id }})">
                                            <i class="spinner-border spinner-border-sm"></i> Đang gửi...
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">Không có liên hệ nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>