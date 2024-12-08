<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $now = Carbon::now();

        $dataProduct = [
            'cake' => [
                [
                    'name' => 'Bánh Mỳ Bơ Tỏi',
                    'description' => 'Bánh mì giòn rụm với lớp bơ tỏi thơm lừng, mang đến vị béo ngậy và hương tỏi nướng. Thích hợp làm món ăn vặt hoặc cho tiệc nhỏ.',
                    'price' => 35000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Bánh Phô Mai Việt Quất',
                    'description' => 'Bánh với vỏ mềm, nhân phô mai béo ngậy và vị việt quất chua ngọt, hoàn hảo cho trà chiều hoặc làm món ăn vặt.',
                    'price' => 35000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Bánh Sừng Bò Bơ Nguyên Chất',
                    'description' => 'Bánh sừng bò giòn rụm với bơ nguyên chất, mang đến hương vị béo ngậy và mềm mại, lý tưởng cho bữa sáng hoặc xế.',
                    'price' => 50000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Bánh Sừng Bò Chocolate',
                    'description' => 'Bánh sừng bò giòn, nhân chocolate chảy mềm, mang đến hương vị ngọt ngào, thích hợp cho bữa sáng hoặc xế.',
                    'price' => 55000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Bánh Sừng Bò Hạnh Nhân',
                    'description' => 'Bánh sừng bò giòn, nhân hạnh nhân béo ngậy, tuyệt vời khi thưởng thức với trà hoặc cà phê.',
                    'price' => 45000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pain Suisse Thuỵ Sĩ',
                    'description' => 'Bánh mềm xốp với sô-cô-la và hạt hạnh nhân, thích hợp cho cà phê sáng hoặc trà chiều, mang đến hương vị ngọt ngào.',
                    'price' => 65000,
                    'discount_price' => 5000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Tart Chocolate',
                    'description' => 'Bánh tart với vỏ giòn và nhân sô-cô-la đen mịn, một món tráng miệng hấp dẫn cho các dịp đặc biệt.',
                    'price' => 70000,
                    'discount_price' => 5000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Tiramisu',
                    'description' => 'Món tráng miệng Ý với bánh quy cà phê và kem mascarpone, mang đến sự kết hợp hoàn hảo giữa vị ngọt và đắng, lý tưởng cho tiệc hoặc thư giãn.',
                    'price' => 70000,
                    'discount_price' => 5000,
                    'quantity' => rand(50, 150),
                ],
            ],
            'salad' => [
                [
                    'name' => 'Salad Phô Mai Sữa Trâu',
                    'description' => 'Salad Phô Mai Sữa Trâu mang đến sự hòa quyện tuyệt vời giữa vị béo ngậy của phô mai sữa trâu và độ tươi mát của các loại rau củ. Món salad này không chỉ thơm ngon mà còn rất bổ dưỡng, lý tưởng cho những ngày hè nóng bức. Vị ngọt nhẹ của rau xanh kết hợp với phô mai béo ngậy sẽ làm bạn phải yêu ngay từ lần đầu thưởng thức.',
                    'price' => 70000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Salad Phô Mai Sữa Dê',
                    'description' => 'Salad Phô Mai Sữa Dê là một sự kết hợp độc đáo giữa vị chua nhẹ của rau củ và sự béo ngậy, đậm đà của phô mai sữa dê. Đây là lựa chọn hoàn hảo cho những ai yêu thích sự mới mẻ trong bữa ăn. Với màu sắc hấp dẫn và hương vị thơm ngon, món salad này sẽ trở thành điểm nhấn trong bữa ăn của bạn.',
                    'price' => 100000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Beetroot Salad',
                    'description' => 'Beetroot Salad nổi bật với sắc đỏ tươi tắn của củ dền và vị ngọt tự nhiên đầy hấp dẫn. Món salad này không chỉ đẹp mắt mà còn cực kỳ bổ dưỡng, cung cấp nhiều vitamin và khoáng chất cần thiết cho cơ thể. Sự kết hợp giữa củ dền và rau xanh tươi mát mang đến một bữa ăn lành mạnh và năng động cho bạn.',
                    'price' => 100000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Burrata Salad',
                    'description' => 'Burrata Salad là sự kết hợp tinh tế giữa phô mai burrata mịn màng, béo ngậy và các loại rau củ tươi mát. Phô mai burrata, với lớp vỏ mềm mại và nhân béo ngậy, mang đến một trải nghiệm ẩm thực đầy hấp dẫn. Cùng với chút dầu olive và giấm balsamic, món salad này sẽ khiến bạn cảm nhận được sự tươi mới, nhẹ nhàng nhưng không kém phần thơm ngon.',
                    'price' => 120000,
                    'discount_price' => 20000,
                    'quantity' => rand(50, 150),
                ],
            ],
            'pizza' => [
                [
                    'name' => 'Pizza Hải sản Pesto Xanh',
                    'description' => 'Pizza Hải Sản Pesto Xanh kết hợp hải sản tươi ngon với sốt pesto xanh đậm đà từ húng quế và hạt thông. Phô mai mozzarella tan chảy tạo nên hương vị thơm ngon, thích hợp cho những ai yêu thích sự tươi mới và đậm đà của hải sản.',
                    'price' => 200000,
                    'discount_price' => 45000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Chay',
                    'description' => 'Pizza Chay với đế bánh giòn và lớp rau củ tươi như ớt chuông, nấm, hành tây, cà chua. Phô mai béo ngậy kết hợp hoàn hảo với các nguyên liệu tự nhiên, tạo nên món ăn nhẹ nhàng và bổ dưỡng cho những ai yêu thích thực phẩm chay.',
                    'price' => 120000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Carbonara',
                    'description' => 'Pizza Carbonara mang hương vị sốt kem béo ngậy, kết hợp với thịt xông khói, hành tây và tiêu đen. Phô mai mozzarella tan chảy làm tăng thêm độ phong phú cho món ăn, phù hợp với những tín đồ ẩm thực Ý.',
                    'price' => 200000,
                    'discount_price' => 30000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Raffaello',
                    'description' => 'Pizza Raffaello kết hợp sốt cà chua, thịt xông khói và phô mai mozzarella tan chảy. Hương vị đậm đà và hấp dẫn, phù hợp cho những ai yêu thích sự giản dị nhưng đầy lôi cuốn của món pizza truyền thống.',
                    'price' => 150000,
                    'discount_price' => 50000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Pesto Burrata',
                    'description' => 'Pizza Pesto Burrata với phô mai burrata béo ngậy và sốt pesto húng quế tươi. Đế giòn rụm kết hợp cà chua tươi, mang đến một trải nghiệm nhẹ nhàng và thanh thoát. Thích hợp cho những ai yêu thích hương vị đặc biệt và độc đáo.',
                    'price' => 180000,
                    'discount_price' => 50000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Margherita',
                    'description' => 'Pizza Margherita là món pizza truyền thống với đế giòn và sốt cà chua tươi. Phô mai mozzarella tan chảy cùng lá húng quế xanh và dầu ô liu, tạo nên một hương vị Ý đặc trưng.',
                    'price' => 150000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Burrata Cay',
                    'description' => 'Pizza Burrata Cay với phô mai burrata béo ngậy kết hợp sốt cà chua cay nồng. Các loại rau củ tươi như ớt chuông và hành tây tạo thêm độ giòn và sắc màu. Rắc thêm ớt bột để tăng thêm phần kích thích cho vị giác, mang đến trải nghiệm phấn khích cho những buổi tụ tập cùng bạn bè và gia đình.',
                    'price' => 175000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Cà Tím',
                    'description' => 'Pizza Cà Tím có đế giòn, sốt cà chua tươi mát, và cà tím nướng vàng ươm. Phô mai mozzarella tan chảy cùng húng quế và dầu ô liu mang đến một món ăn bổ dưỡng và thơm ngon, lý tưởng cho các buổi tiệc vui vẻ.',
                    'price' => 100000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Gập Calzone',
                    'description' => 'Pizza Gập Calzone là món pizza độc đáo, gập lại như túi và nhồi đầy phô mai, thịt, và rau củ tươi mát. Món ăn này mang đến trải nghiệm mới lạ, hoàn hảo khi thưởng thức cùng sốt cà chua.',
                    'price' => 180000,
                    'discount_price' => 30000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza 4 Cheese',
                    'description' => 'Pizza 4 Cheese là sự kết hợp của bốn loại phô mai thơm ngon như mozzarella, cheddar, gorgonzola và parmesan. Đế bánh giòn kết hợp với phô mai béo ngậy mang đến hương vị quyến rũ, lý tưởng cho những ai yêu thích phô mai.',
                    'price' => 180000,
                    'discount_price' => 30000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Nấm Truffle',
                    'description' => 'Pizza Nấm Truffle với lớp đế giòn rụm và sốt kem béo ngậy, kết hợp hoàn hảo với nấm truffle thơm lừng. Phô mai mozzarella tan chảy hòa quyện cùng hương vị đặc trưng của nấm truffle, mang đến một trải nghiệm ẩm thực sang trọng và tinh tế. Thưởng thức cùng bạn bè trong những bữa tiệc đặc biệt!',
                    'price' => 155000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Emilio',
                    'description' => 'Pizza Emilio là sự hòa quyện hoàn hảo giữa hương vị đậm đà và sự tươi mới của nguyên liệu. Với lớp sốt cà chua thơm lừng, phô mai mozzarella mềm mịn, thịt xông khói đậm vị và các loại rau củ tươi như ớt chuông và hành tây, mỗi miếng pizza đều mang đến trải nghiệm vị giác khó quên. Đây là lựa chọn lý tưởng để thưởng thức cùng bạn bè và gia đình trong các buổi họp mặt, làm cho mọi khoảnh khắc thêm phần đặc biệt!',
                    'price' => 155000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Thịt Ba Chỉ Xông Khói',
                    'description' => 'Pizza Thịt Ba Chỉ Xông Khói với lớp đế giòn, sốt cà chua và phô mai mozzarella, phủ đầy thịt ba chỉ xông khói thơm ngon. Hương vị béo ngậy của thịt xông khói kết hợp với rau củ tươi mát, tạo nên một món ăn hấp dẫn không thể bỏ qua.',
                    'price' => 200000,
                    'discount_price' => 65000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Xúc Xích Đức',
                    'description' => 'Pizza Xúc Xích Đức với đế bánh giòn rụm, sốt cà chua và phô mai mozzarella, phủ lên trên là những lát xúc xích Đức thơm phức. Hương vị đặc trưng của xúc xích kết hợp với rau củ tươi ngon mang đến một bữa ăn truyền thống tuyệt vời.',
                    'price' => 200000,
                    'discount_price' => 65000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Capricciosa',
                    'description' => 'Pizza Capricciosa là sự kết hợp tinh tế của sốt cà chua, phô mai mozzarella, nấm, nghệ tây, và ô liu đen trên nền đế bánh giòn rụm. Hương vị phong phú và tươi mát sẽ mang đến trải nghiệm ẩm thực tuyệt vời. Thưởng thức cùng gia đình và bạn bè để thêm phần gắn kết và vui vẻ!',
                    'price' => 155000,
                    'discount_price' => 20000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Dăm Bông Parma',
                    'description' => 'Pizza Dăm Bông Parma mang đến hương vị Ý cổ điển với lớp đế bánh giòn, sốt cà chua ngọt, phô mai mozzarella và dăm bông Parma nhập khẩu. Một chút húng quế tươi rắc lên tạo sự hài hòa tuyệt vời. Thưởng thức trong các buổi tiệc tối đầy vui vẻ!',
                    'price' => 155000,
                    'discount_price' => 20000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Napoli Loại 1',
                    'description' => 'Pizza Napoli Loại 1 mang đến hương vị đặc trưng của ẩm thực Ý với đế bánh mềm mại, sốt cà chua tươi và phô mai mozzarella. Điểm nhấn là cá cơm mặn mà và ô liu đen, tạo nên sự hòa quyện giữa các hương vị. Lý tưởng cho những bữa ăn gia đình và tiệc tùng!',
                    'price' => 170000,
                    'discount_price' => 50000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Napoli Loại 2',
                    'description' => 'Pizza Napoli Loại 2 là sự kết hợp mới lạ giữa hương vị truyền thống và sáng tạo. Đế bánh giòn rụm phủ sốt cà chua tươi, phô mai mozzarella, thịt xông khói, nấm tươi và ớt chuông sắc màu. Hương vị đậm đà, hài hòa giữa ngọt, mặn và béo ngậy sẽ chinh phục bạn ngay từ miếng đầu tiên. Đây là lựa chọn hoàn hảo cho những bữa tiệc hoặc bữa ăn gia đình.',
                    'price' => 170000,
                    'discount_price' => 50000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Margherita DOP',
                    'description' => 'Pizza Margherita DOP là tinh hoa của ẩm thực Ý với đế bánh mỏng giòn, sốt cà chua San Marzano ngọt tự nhiên, phô mai mozzarella béo ngậy và húng quế tươi. Hương vị đơn giản nhưng tinh tế này sẽ mang đến cảm giác như bạn đang thưởng thức món ăn ngay tại Naples. Một lựa chọn lý tưởng cho những ai yêu thích sự truyền thống và thanh lịch.',
                    'price' => 200000,
                    'discount_price' => 65000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Pháp',
                    'description' => 'Pizza Pháp mang đậm nét tinh tế của ẩm thực Pháp. Đế bánh giòn rụm, phủ sốt cà chua tươi, phô mai béo ngậy và thịt xông khói thơm lừng. Thêm vào đó là sự tươi mát của các loại rau củ như ớt chuông, hành tây, và nấm, tạo nên hương vị hài hòa và đầy màu sắc. Một món ăn hoàn hảo cho những bữa tiệc gia đình hay buổi gặp mặt bạn bè.',
                    'price' => 200000,
                    'discount_price' => 65000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Nấm Truffle Hảo Hạng',
                    'description' => 'Pizza Nấm Truffle Hảo Hạng mang đến trải nghiệm ẩm thực đẳng cấp với lớp sốt kem mịn, phô mai mozzarella béo ngậy và nấm truffle thơm lừng. Từng miếng bánh còn được tô điểm bằng lát nấm tươi và chút húng quế, mang lại sự tươi mới và độc đáo. Đây là lựa chọn lý tưởng cho những buổi tối lãng mạn hoặc tự thưởng bản thân sau một ngày bận rộn.',
                    'price' => 200000,
                    'discount_price' => 35000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Marinara',
                    'description' => 'Pizza Marinara mang hương vị biển cả tươi mới, với tôm, mực, và sò điệp trên lớp đế bánh giòn tan, phủ sốt cà chua ngọt chua hài hòa. Hương thơm của tỏi, dầu ô liu, và húng quế tươi làm tăng thêm sức hút cho món ăn này. Một lựa chọn tuyệt vời cho những tín đồ hải sản hoặc những dịp đặc biệt cùng gia đình và bạn bè.',
                    'price' => 200000,
                    'discount_price' => 35000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza 5 Cheese',
                    'description' => 'Pizza 5 Cheese là bữa tiệc phô mai đích thực với sự kết hợp hoàn hảo của mozzarella, parmesan, cheddar, gouda, và phô mai bleu. Lớp đế bánh giòn tan kết hợp cùng phô mai béo ngậy, thêm một chút húng quế tươi, mang đến hương vị đậm đà, khó quên. Thích hợp cho những buổi gặp mặt bạn bè hoặc dành tặng những người yêu thích phô mai.',
                    'price' => 70000,
                    'discount_price' => 35000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Sicilian',
                    'description' => 'Pizza Sicilian mang phong cách Địa Trung Hải với đế bánh dày đặc trưng và hình vuông độc đáo. Lớp sốt cà chua tươi, phô mai mozzarella, thịt xông khói hoặc xúc xích kết hợp hài hòa với rau củ như ớt chuông, hành tây và olive đen, tạo nên hương vị phong phú và đậm đà. Món ăn lý tưởng cho những buổi tụ họp gia đình hay tiệc tùng cùng bạn bè.',
                    'price' => 70000,
                    'discount_price' => 35000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Pizza Mật Ong Nóng',
                    'description' => 'Pizza Mật Ong Nóng là sự kết hợp độc đáo giữa vị ngọt của mật ong và vị mặn của phô mai mozzarella cùng thịt xông khói. Đế bánh giòn rụm, thêm chút mật ong nóng rưới lên trên, mang lại trải nghiệm hương vị mới lạ và thú vị. Đây là lựa chọn tuyệt vời cho những ai yêu thích sự sáng tạo trong ẩm thực, hoàn hảo cho các buổi tiệc hoặc những bữa tối đặc biệt.',
                    'price' => 250000,
                    'discount_price' => 40000,
                    'quantity' => 0,
                ]
            ],
            'pasta' => [
                [
                    'name' => 'Pasta Bolognese',
                    'description' => 'Hương vị cổ điển của Ý với sốt Bolognese đậm đà từ thịt bò xay, cà chua tươi và chút rượu vang. Mì mềm dai, hòa quyện hoàn hảo với sốt, rắc thêm phô mai Parmesan và húng quế tươi. Một món ăn đậm chất truyền thống và khó cưỡng',
                    'price' => 120000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pasta Carbonara',
                    'description' => 'Trải nghiệm vị béo ngậy của sốt Carbonara từ trứng, phô mai Parmesan và pancetta. Sợi mì spaghetti bao phủ bởi lớp sốt mịn, thêm chút tiêu đen xay cho hương vị đậm đà. Món ăn đưa bạn đến tinh hoa ẩm thực Ý.',
                    'price' => 120000,
                    'discount_price' => 20000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pasta Xốt Pesto Genovese',
                    'description' => 'Hương vị tươi mát từ sốt pesto xanh mướt, làm từ húng quế, hạt thông, dầu ô liu và phô mai Parmesan. Mì thấm đẫm hương thơm đặc trưng, hoàn hảo cho bữa ăn nhẹ nhàng, dinh dưỡng và tràn đầy cảm hứng từ Ý.',
                    'price' => 120000,
                    'discount_price' => 20000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pasta Nấm Hương Shiitake',
                    'description' => 'Thưởng thức hương vị umami từ nấm shiitake xào với tỏi, dầu ô liu và sốt kem mịn. Món pasta thơm ngon, bổ dưỡng, lý tưởng cho những bữa ăn nhẹ nhàng mà đầy đủ dinh dưỡng.',
                    'price' => 100000,
                    'discount_price' => 20000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pasta Tôm Cay',
                    'description' => 'Sự kết hợp hoàn hảo giữa tôm tươi, vị cay nồng từ ớt, tỏi và gia vị đặc trưng. Mì dai giòn, thêm rau thơm như húng quế, tạo nên một món ăn đậm đà, đầy kích thích vị giác.',
                    'price' => 100000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
            ],
            'soft' => [
                [
                    'name' => 'Coca Classic Lon 320ml',
                    'description' => 'Coca Classic Lon 320ml là thức uống giải khát quen thuộc, mang đến hương vị coca cola nguyên bản mà ai cũng yêu thích. Sảng khoái từng ngụm, giúp xua tan cơn khát và tiếp thêm năng lượng cho ngày dài năng động.',
                    'price' => 15000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Coca Light Lon 320ml',
                    'description' => 'Coca Light Lon 320ml dành cho những ai yêu thích hương vị truyền thống của coca nhưng muốn giảm bớt lượng đường. Vẫn đậm đà và sảng khoái, nhưng ít calorie hơn, giúp bạn thoải mái thưởng thức mà không lo tăng cân.',
                    'price' => 15000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Coca Plus Fiber Lon 320ml',
                    'description' => 'Coca Plus Fiber Lon 320ml là lựa chọn mới mẻ cho người thích coca, với bổ sung chất xơ để hỗ trợ tiêu hóa. Không chỉ giúp bạn giải khát, mà còn giúp cảm thấy nhẹ nhàng và tốt cho sức khỏe hơn.',
                    'price' => 15000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Coca Zero Lon 320ml',
                    'description' => 'Coca Zero Lon 320ml mang đến hương vị coca đậm đà mà không có đường. Hoàn hảo cho những ai muốn thưởng thức vị ngon của coca mà vẫn giữ được chế độ ăn uống lành mạnh.',
                    'price' => 15000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Fanta Hương Cam Lon 320ml',
                    'description' => 'Fanta Hương Cam Lon 320ml là thức uống ngọt ngào với hương cam thơm mát. Sảng khoái từng ngụm, đem lại cảm giác tươi mới, như đang thưởng thức một ly nước cam tươi mọng vào ngày nắng.',
                    'price' => 18000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Fanta Hương Nho Lon 320ml',
                    'description' => 'Fanta Hương Nho Lon 320ml mang đến hương vị nho ngọt ngào và thơm lừng. Giải khát cực đã, với từng ngụm đầy sức sống như đang thưởng thức trái nho mọng nước. Đồ uống này sẽ làm bạn mê mẩn ngay từ lần đầu thưởng thức.',
                    'price' => 18000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Fanta Hương Soda Kem Lon 320ml',
                    'description' => 'Fanta Hương Soda Kem Lon 320ml là sự kết hợp thú vị giữa vị soda sảng khoái và kem ngọt ngào. Vừa uống vừa cảm nhận lớp bọt mịn tan ngay trên đầu lưỡi, mang đến cảm giác vui nhộn như đang thưởng thức ly soda kem lạnh giữa ngày hè nóng bức.',
                    'price' => 18000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Fanta Hương Xá Xị Lon 320ml',
                    'description' => 'Fanta Hương Xá Xị Lon 320ml là thức uống cổ điển với vị xá xị đậm đà quen thuộc. Hương vị độc đáo và sảng khoái này sẽ gợi nhớ lại những kỷ niệm tuổi thơ, mỗi ngụm đều mang đến sự sảng khoái không thể chối từ.',
                    'price' => 18000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Fuzetea Trà Bí Đao Lon 320ml',
                    'description' => 'Fuzetea Trà Bí Đao Lon 320ml mang đến hương vị thanh mát của trà bí đao tự nhiên, giúp giải nhiệt và sảng khoái ngay tức thì. Đồ uống này là sự lựa chọn hoàn hảo để thư giãn và làm mới tinh thần sau một ngày dài bận rộn.',
                    'price' => 20000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pepsi Nitro Draft Coca Lon 320ml',
                    'description' => 'Pepsi Nitro Draft Coca Lon 320ml là sự sáng tạo mới mẻ từ Pepsi, với lớp bọt nitro mềm mịn và hương vị coca đặc trưng. Cảm giác uống như đang thưởng thức một ly bia tươi nhưng không cồn, mang lại trải nghiệm cực kỳ thú vị.',
                    'price' => 20000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pepsi Nitro Draft Vanilla Lon 320ml',
                    'description' => 'Pepsi Nitro Draft Vanilla Lon 320ml kết hợp hương vị coca với chút vani ngọt ngào, tạo ra sự cân bằng hoàn hảo giữa sự tươi mát và mịn màng. Lớp bọt nitro làm cho mỗi ngụm thêm phần đặc biệt, đầy lôi cuốn.',
                    'price' => 20000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Schweppes Soda Lon 320ml',
                    'description' => 'Schweppes Soda Lon 320ml là lựa chọn sảng khoái với hương vị soda tinh khiết. Đồ uống này rất lý tưởng để giải khát, hoặc kết hợp với các loại cocktail và đồ uống khác để tạo nên sự hòa quyện tuyệt hảo.',
                    'price' => 20000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Schweppes Tonic Lon 320ml',
                    'description' => 'Schweppes Tonic Lon 320ml mang đến hương vị tonic đặc trưng với độ đắng nhẹ vừa phải, thích hợp cho những ai yêu thích cảm giác mới lạ. Có thể thưởng thức riêng hoặc kết hợp với các loại rượu để tạo nên ly cocktail hoàn hảo.',
                    'price' => 20000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
            ],
            'chicken' => [
                [
                    'name' => 'Cánh gà nướng',
                    'description' => 'Cánh gà nướng có lớp da giòn rụm, thịt gà mềm ngọt. Món ăn được ướp gia vị kỹ, mang lại hương vị đậm đà, phù hợp cho bữa tiệc hay tụ họp gia đình. Ăn kèm với sốt cay nhẹ hoặc tương ớt để thêm phần hấp dẫn.',
                    'price' => 35000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Gà không xương sốt cay',
                    'description' => 'Gà không xương sốt cay là món ăn với miếng gà mềm, phủ sốt cay nồng, mang đến cảm giác "nóng bỏng". Vị cay và ngọt hòa quyện, tạo nên trải nghiệm ẩm thực độc đáo và thú vị.',
                    'price' => 50000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Cánh gà sốt cay',
                    'description' => 'Cánh gà sốt cay có lớp da giòn, ngập trong sốt cay đặc biệt. Vị cay nồng lan tỏa, hòa quyện với thịt gà mềm, mang lại một trải nghiệm ăn uống vừa cay vừa ngon.',
                    'price' => 50000,
                    'discount_price' => 0,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Gà phủ phô mai',
                    'description' => 'Gà phủ phô mai có lớp phô mai tan chảy béo ngậy, hòa quyện với thịt gà giòn bên ngoài, mềm ngọt bên trong, mang lại một hương vị hấp dẫn khó cưỡng.',
                    'price' => 50000,
                    'discount_price' => 10000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Đùi gà chiên giòn',
                    'description' => 'Đùi gà chiên giòn có lớp vỏ ngoài giòn rụm, thịt mềm ngọt. Món ăn này rất thích hợp làm món nhắm hay món chính cho bữa ăn gia đình.',
                    'price' => 65000,
                    'discount_price' => 15000,
                    'quantity' => 0,
                ],
                [
                    'name' => 'Gà nướng mật ong',
                    'description' => 'Gà nướng mật ong có lớp da vàng giòn, mật ong ngọt ngào thấm vào từng thớ thịt gà mềm, mang lại hương vị thơm ngon, dễ ăn và hấp dẫn.',
                    'price' => 80000,
                    'discount_price' => 10000,
                    'quantity' => 0,
                ]
            ],
            'combo' => [
                [
                    'name' => 'Combo 2 Pizza + Pepsi - Ăn thả ga - Giá siêu rẻ',
                    'description' => 'Pizza Hải sản Pesto Xanh, Pizza Chay, Coca Classic Lon 320ml',
                    'price' => 399000,
                    'discount_price' => 200000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Combo Sương Sương',
                    'description' => 'Pizza Sicilian, Pizza Mật Ong Nóng, Fanta Hương Cam Lon 320ml',
                    'price' => 399000,
                    'discount_price' => 30000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Ăn Hết Menu Không Lo Mập Ú',
                    'description' => 'Pizza 5 Cheese, Pizza Marinara, Pizza Nấm Truffle Hảo Hạng',
                    'price' => 399000,
                    'discount_price' => 30000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Dành Cho Người Ăn Kiêng',
                    'description' => 'Pizza Pháp, Pizza Thịt Ba Chỉ Xông Khói',
                    'price' => 300000,
                    'discount_price' => 30000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Ăn Một Mình Nhưng Phải Đủ Món',
                    'description' => 'Pizza Margherita DOP, Pizza Emilio, Coca Classic Lon 320ml',
                    'price' => 120000,
                    'discount_price' => 30000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Pizza Slay',
                    'description' => 'Pizza Napoli Loại 2, Fanta Hương Cam Lon 320ml',
                    'price' => 300000,
                    'discount_price' => 15000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Combo Siêu To Khổng Lồ',
                    'description' => 'Pizza Napoli Loại 1, Pizza Nấm Truffle, Pizza 4 Cheese, Pizza Gập Calzone',
                    'price' => 250000,
                    'discount_price' => 25000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Gia Đình Vui Vẻ - Cả Nhà Cùng Vui',
                    'description' => 'Pizza Dăm Bông Parma, Pizza Cà Tím',
                    'price' => 450000,
                    'discount_price' => 45000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Cặp Đôi Yêu Thương - Ăn Là Phải Có Đôi',
                    'description' => 'Pizza Capricciosa, Fanta Hương Soda Kem Lon 320ml',
                    'price' => 450000,
                    'discount_price' => 45000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Năng Lượng Ngập Tràn - Đầy Đủ Chất',
                    'description' => 'Pizza Xúc Xích Đức, Fanta Hương Nho Lon 320ml',
                    'price' => 250000,
                    'discount_price' => 45000,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Ăn Vặt Cuối Tuần - Nhâm Nhi Cả Ngày',
                    'description' => 'Pizza Napoli Loại 2, Fanta Hương Cam Lon 320ml',
                    'price' => 450000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
                [
                    'name' => 'Mua 1 Tặng 1 - Tiết Kiệm Nhân Đôi',
                    'description' => 'Pizza 5 Cheese, Pizza Marinara, Pizza Nấm Truffle Hảo Hạng',
                    'price' => 300000,
                    'discount_price' => 0,
                    'quantity' => rand(50, 150),
                ],
            ]
        ];

        // Create Product
        $categories = Category::all();

        foreach ($categories as $category) {
            $products = $dataProduct[$category->slug] ?? [];

            foreach ($products as $product => $productData) {
                // sku 10 characters and unique
                $sku = $faker->unique()->regexify('[A-Z]{3}[0-9]{7}');
                Product::create([
                    'name' => $productData['name'],
                    'slug' => $sku . '-' . Str::slug($productData['name']),
                    'image' => Str::slug($productData['name']) . '.jpeg',
                    'description' => $productData['description'],
                    'category_id' => $category->id,
                    'price' => $productData['price'],
                    'discount_price' => $productData['discount_price'] == 0 ? 0 : $productData['price'] - $productData['discount_price'],
                    'quantity' => $productData['quantity'],
                    'sku' => $sku,
                    'status' => 1,
                    'is_featured' => rand(0, 1),
                    'avg_rating' => rand(1, 5),
                    'total_rating' => rand(0, 100),
                ]);
            }
        }
    }
}
