<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $List = [];
        $row1 = [
            'book_title' => 'Cây Cam Ngọt Của Tôi',
            'description' => '“Vị chua chát của cái nghèo hòa trộn với vị ngọt ngào khi khám phá ra những điều khiến cuộc đời này đáng sống... một tác phẩm kinh điển của Brazil.” - Booklist

“Một cách nhìn cuộc sống gần như hoàn chỉnh từ con mắt trẻ thơ… có sức mạnh sưởi ấm và làm tan nát cõi lòng, dù người đọc ở lứa tuổi nào.” - The National

Hãy làm quen với Zezé, cậu bé tinh nghịch siêu hạng đồng thời cũng đáng yêu bậc nhất, với ước mơ lớn lên trở thành nhà thơ cổ thắt nơ bướm. Chẳng phải ai cũng công nhận khoản “đáng yêu” kia đâu nhé. Bởi vì, ở cái xóm ngoại ô nghèo ấy, nỗi khắc khổ bủa vây đã che mờ mắt người ta trước trái tim thiện lương cùng trí tưởng tượng tuyệt vời của cậu bé con năm tuổi.

Có hề gì đâu bao nhiêu là hắt hủi, đánh mắng, vì Zezé đã có một người bạn đặc biệt để trút nỗi lòng: cây cam ngọt nơi vườn sau. Và cả một người bạn nữa, bằng xương bằng thịt, một ngày kia xuất hiện, cho cậu bé nhạy cảm khôn sớm biết thế nào là trìu mến, thế nào là nỗi đau, và mãi mãi thay đổi cuộc đời cậu.

Mở đầu bằng những thanh âm trong sáng và kết thúc lắng lại trong những nốt trầm hoài niệm, Cây cam ngọt của tôi khiến ta nhận ra vẻ đẹp thực sự của cuộc sống đến từ những điều giản dị như bông hoa trắng của cái cây sau nhà, và rằng cuộc đời thật khốn khổ nếu thiếu đi lòng yêu thương và niềm trắc ẩn. Cuốn sách kinh điển này bởi thế không ngừng khiến trái tim người đọc khắp thế giới thổn thức, kể từ khi ra mắt lần đầu năm 1968 tại Brazil.',
            'thumbnail' => 'public/img/books/book-1.jpg',
            'quantity' => 15,
            'price' => '83800',
            'discount' => '0',
            'discontinued' => '0',
            'is_featured' => '0',
            'author_id' => 1,
            'category_id' => 1,
            'publish_id' => 1,
            'supplier_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),

        ];
        array_push($List, $row1);
        $row2 = [
            'book_title' => 'Ra Bờ Suối Ngắm Hoa Kèn Hồng',
            'description' => 'Ra bờ suối ngắm hoa kèn hồng là tác phẩm trong trẻo, tràn đầy tình yêu thương mát lành, trải ra trước mắt người đọc khu vườn trại rực rỡ cỏ hoa của vùng quê thanh bình, kèm theo đó là những “nhân vật” đáng yêu, làm nên một “thế giới giàu có, rộng lớn và vô cùng hấp dẫn” mà dường như người lớn đã bỏ quên đâu đó từ lâu.

Sau Tôi là Bê Tô, Có hai con mèo ngồi bên cửa sổ, Con chó nhỏ mang giỏ hoa hồng, đây là một cuốn sách nữa của nhà văn Nguyễn Nhật Ánh mà nhân vật chính là những bé động vật ngộ nghĩnh, được mô tả sống động dưới ngòi bút tài hoa và giàu tình thương.

Câu chuyện chạy qua 8 phần với 64 chương sách nhỏ đầy ắp lòng thương yêu, tính lương thiện, tình thân bạn bè, lòng dũng cảm và bao dung, đánh bạt sự ác độc và cả mọi thói xấu.

Khép cuốn sách lại, tự nhiên thấy lòng mình dịu lắng, bình yên đến lạ lùng…

Vài đoạn trích trong tác phẩm Ra bờ suối ngắm hoa kèn hồng

“Tắm mình trong suối âm thanh, vẫn là những điệu buồn quen thuộc, nhưng đêm nay Mắt Tròn thấy tâm hồn mình như bay lên. Âm nhạc như một bàn tay vô hình đã nâng đỡ nó, lên cao, lên cao mãi. Cao hơn nỗi buồn, cao hơn những phiền muộn vẫn dày vò nó trong những ngày qua.

Nỗi buồn, ờ thì nó vẫn ở đó, trong trái tim Mắt Tròn, nhưng nó không làm trái tim con gà xây xát nữa. Mắt Tròn ngạc nhiên nhận ra nỗi buồn có thể phát sáng, trở nên đẹp đẽ dưới sự vỗ về của âm nhạc.

Tiếng đàn của chàng nhạc sĩ giang hồ đã sưởi ấm con gà, đã an ủi nó thật nhiều trong đêm hôm đó.

Mắt Tròn neo mình trên cỏ, bất động, lặng thinh, đầy xao xuyến. Nó lắng nghe tiếng đàn, cảm tưởng đang lắng nghe chính bản thân nó, bắt gặp mình đang xúc động.

Có lẽ bạn cũng thế thôi, khi nỗi buồn trong lòng bạn được âm nhạc chắp cánh, nó sẽ thăng hoa. Thay vì nhấn chìm bạn, nỗi buồn sẽ giúp bạn giàu có hơn về cảm xúc. Nó trở thành một giá trị và bạn chợt nhận ra nó là một phần thanh xuân của bạn.',
            'thumbnail' => 'public/img/books/book-2.jpg',
            'quantity' => 15,
            'price' => '121800',
            'discount' => '0',
            'discontinued' => '0',
            'is_featured' => '0',
            'author_id' => 2,
            'category_id' =>2,
            'publish_id' => 2,
            'supplier_id' =>2,
            'created_at' => now(),
            'updated_at' => now(),


        ];
        array_push($List, $row2);
        $row3 = [
            'book_title' => 'Đường Gia Tiểu Miêu',
            'description' => 'Cô đã chuẩn bị xong, cho dù có bốn khẩu súng đang nhắm vào mình. Một người nếu muốn sống thì việc quan trọng đầu tiên chính là đánh giá đúng, nhìn nhận khách quan và thẳng thắn về bản thân. Về điểm này thì cô suy nghĩ rất thoáng, cô chưa bao giờ sợ phải sống thế nào, chỉ cần còn sống là tốt rồi. Tô Tiểu Miêu lặng lẽ nhắm mắt lại. Lúc cô mở mắt ra một lần nữa, bất thình lình nhún người nhảy lên.

Một bóng người từ phía sau đột nhiên xuất hiện, theo kịp tốc độ của cô, cùng cô tung người nhảy xuống biển. Tiếng súng vang lên. Giữa không trung, cô được người đó ôm vào lòng.

Giữa lằn ranh của sự sống và cái chết, người đó đã dùng thứ tình yêu sâu đậm đến hoang đường của mình để bảo vệ cô an toàn.

“Tiểu Miêu, em phải sống!”',
            'thumbnail' => 'public/img/books/book-3.jpg',
            'quantity' => 15,
            'price' => '141120',
            'discount' => '0',
            'discontinued' => '0',
            'is_featured' => '0',
            'author_id' => 3,
            'category_id' => 3,
            'publish_id' => 3,
            'supplier_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        array_push($List, $row3);
        DB::table('books')->insert($List);
                                


    }
}
