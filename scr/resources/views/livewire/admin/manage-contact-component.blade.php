<div>
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <!-- Tiêu đề nằm bên trái -->
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
                        <tr wire:key="contact-{{ $contact->id }}" class="{{ $contact->status == 1 ? 'bg-light' : '' }}">
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
                                @if($contact->status == 0)
                                <button
                                    wire:click="openReplyModal({{ $contact->id }})"
                                    class="btn btn-primary btn-sm">
                                    Trả lời
                                </button>
                                @else
                                <button class="btn btn-secondary btn-sm" disabled>
                                    Đã trả lời
                                </button>
                                @endif
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

    <!-- Modal Trả lời -->
    @if($showReplyModal)
    <div class="modal show" style="display: block; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trả lời liên hệ</h5>
                    <button type="button" class="btn-close" wire:click="closeReplyModal"></button>
                </div>
                <form wire:submit.prevent="sendEmail({{ $selectedContactId }})">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nội dung trả lời:</label>
                            <textarea
                                wire:model.live="replyMessage"
                                class="form-control"
                                rows="5"
                                placeholder="Nhập nội dung trả lời..."
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeReplyModal">Đóng</button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            wire:loading.attr="disabled"
                            @if(!$replyMessage) disabled @endif>
                            <span wire:loading.remove wire:target="sendEmail">
                                Gửi
                            </span>
                            <span wire:loading wire:target="sendEmail">
                                <i class="spinner-border spinner-border-sm"></i> Đang gửi...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>