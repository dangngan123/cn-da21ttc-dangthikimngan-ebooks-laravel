<style>
    input::placeholder {
        font-style: italic;
        /* Chữ in nghiêng */
        color: #888;
        /* Màu placeholder */
    }
</style>

<div>
    <div class="totall-product">
        <form action="{{ route('search') }}" class="d-flex">
            <input id="searchInput" type="text" name="search" placeholder="Sách giá rẻ tìm kiếm nhanh..."
                value="{{ $search ?? '' }}" style="border-radius: 100px; width: 350px; border: 1px solid #F15412;">
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const placeholders = [
            "Đọc sách hôm nay, thành công mai sau...",
            "Sách là chìa khóa mở cánh cửa tri thức...",
            "Mỗi trang sách là một hành trình mới...",
            "Học từ sách để phát triển tương lai..."
        ];

        let index = 0;
        const input = document.getElementById('searchInput');

        // Chuyển đổi placeholder sau mỗi 3 giây
        setInterval(() => {
            index = (index + 1) % placeholders.length; // Lặp lại danh sách
            input.placeholder = placeholders[index]; // Thay đổi placeholder
        }, 3000); // 3 giây đổi placeholder
    });
</script>