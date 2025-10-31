<?php
include_once(__DIR__ . '/../public/header.php');
?>

<script>
    const chatux = new ChatUx();

    const opt = {
        api: {
            endpoint: 'http://localhost/chat/chat-server.php',
            method: 'GET',
            dataType: 'jsonp',
            escapeUserInput: true
        },
        window: {
            title: 'My chat',
            size: {
                width: 350,
                height: 500,
                minWidth: 300,
                minHeight: 300,
                titleHeight: 50
            },
            appearance: {
                border: {
                    shadow: '2px 2px 10px  rgba(0, 0, 0, 0.5)',
                    width: 0,
                    radius: 6
                },
                titleBar: {
                    fontSize: 14,
                    color: 'white',
                    background: '#4784d4',
                    leftMargin: 40,
                    height: 40,
                    buttonWidth: 36,
                    buttonHeight: 16,
                    buttonColor: 'white',
                    buttons: [
                        {
                            fa: 'fas fa-times',
                            name: 'hideButton',
                            visible: true
                        }
                    ],
                    buttonsOnLeft: [
                        {
                            fa: 'fas fa-comment-alt',
                            name: 'info',
                            visible: true
                        }
                    ],
                },
            }
        },
    };

    chatux.init(opt);
    chatux.start(true);
</script>

<style>
    .about-section {
        border-radius: 20px;
        background: #ffffff;
        color: #222;
        font-family: "Inter", sans-serif;
        padding: 85px 120px;
        max-width: 1200px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .about-left h1 {
        font-size: 34px;
        font-weight: 800;
        color: #1f3c88;
        text-align: center;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .about-left h2 {
        font-size: 26px;
        font-weight: 700;
        color: #1f6fb2;
        text-align: center;
        margin-bottom: 20px;
    }

    .about-left h3 {
        font-size: 22px;
        font-weight: 600;
        color: #1f6fb2;
        margin-top: 40px;
        margin-bottom: 15px;
        border-left: 4px solid #1f6fb2;
        padding-left: 12px;
    }

    .about-left p {
        font-size: 16px;
        color: #333;
        text-align: justify;
        margin-bottom: 18px;
    }

    .about-left p:hover {
        background: rgba(31, 111, 178, 0.04);
        transition: 0.3s;
    }

    .about-left {
        max-width: 900px;
        margin: 0 auto;
    }

    @media (max-width: 992px) {
        .about-section {
            padding: 0px;
            0px;
        }

        .about-left h1 {
            font-size: 28px;
        }

        .about-left h2 {
            font-size: 22px;
        }

        .about-left h3 {
            font-size: 20px;
        }
    }
</style>

<section class="about-section">
    <div class="container">
        <div class="about-left">
            <h1>Câu chuyện thương hiệu</h1>
            <h2>U&I Logistics – Uy tín quý hơn vàng, Tận tâm vì khách hàng!</h2>
            <h3>Khát vọng tuổi 20 của thương hiệu Logistics Việt Nam</h3>
            <p>
                Ngày 19/3/2003, Công ty Cổ phần Giao nhận Vận tải U&I ra đời, kế thừa toàn bộ hoạt động kinh doanh dịch
                vụ logistics từ công ty Cổ phần Đầu tư U&I, và không ngừng nỗ lực để lớn mạnh cùng khách hàng. Trải qua
                20 năm phát triển, U&I Logistics là một trong những thương hiệu logistics tư nhân hàng đầu Việt Nam, với
                đội ngũ trên 700 nhân sự hoạt động khắp các vùng kinh tế trọng điểm của cả nước như Bình Dương, Tp.HCM,
                Hà Nội, Hải Phòng, Hưng Yên, ….cùng mạng lưới kho có tổng sức chứa lên đến 2 triệu m2, đồng thời, U&I
                Logistics cũng là doanh nghiệp kinh doanh Kho Ngoại quan ngành Gỗ & Nội thất lớn nhất Đông Nam Á.
            </p>
            <p>
                Mỗi ngày, hàng ngàn chuyến xe rong ruổi ngược xuôi đưa hàng hóa của khách hàng “đi đến nơi, về đến
                chốn”, an toàn, an tâm, thông tin được báo cáo nhanh chóng, chuẩn xác. Mỗi ngày, hàng chục ngàn mặt hàng
                được lưu chuyển trong chuỗi cung ứng của khách hàng, từ thông quan đến lưu kho, từ soạn hàng ở Việt Nam
                đến giao hàng tận kho khách hàng ở Mỹ, châu Âu, Nhật Bản, Hàn Quốc, Trung Quốc,.. trơn tru và nhịp
                nhàng. U&I Logistics tự hào ghi tên mình vào bản đồ logistics trên thế giới với sự ủng hộ của hàng ngàn
                khách hàng trong và ngoài nước với một cam kết chung “Uy tín quý hơn vàng”.
            </p>
            <h3>Đứa con tinh thần của những doanh nhân lấy chữ “tín” làm kim chỉ nam</h3>
            <p>Bắt đầu vào hoạt động từ năm 1998, Công ty TNHH U&I (tiền thân của UNIGROUP sau này) ra đời với ngành
                nghề kinh doanh chính là tư vấn đầu tư, tư vấn xuất nhập khẩu, khai thuê hải quan, giao nhận hàng hóa
                xuất nhập khẩu. Trước làn sóng đầu tư của các doanh nghiệp trong và ngoài nước vào tỉnh Bình Dương,
                những nhà sáng lập của UNIGROUP đã xác định phương châm làm việc là “Vì quyền lợi của khách hàng trước”
                (Client’s interest first) – lấy đây làm “khẩu quyết hành động”. Đầu những năm 2000, khi có rất nhiều nhà
                đầu tư nước ngoài còn lạ lẫm với môi trường kinh doanh trong nước, sự tận tâm nói trên của Công ty U&I
                là một trong những điểm sáng để khách hàng chọn lựa và tin cậy.</p>
            <p>Từ đội ngũ ban đầu gồm 6 thành viên, năm 2003 công ty TNHH U&I tiến hành cổ phần hóa và chuyển đổi thành
                Công ty Cổ phần Đầu tư U&I (UNIGROUP), chuyển toàn bộ dịch vụ logistics cho công ty Cổ phần Giao nhận
                vận tải U&I (UNITRANS) để có thể mở rộng và đi sâu vào lĩnh vực logistics. Với một doanh nghiệp tư nhân
                trong nước không có nhiều nền tảng tài sản như các doanh nghiệp quốc doanh hay nước ngoài ở thời điểm
                đó, UNITRANS chọn cách kiên trì phục vụ khách hàng bằng những phẩm chất tiêu biểu của người Việt Nam:
                Trung thực – Kỷ luật – Uy tín. Đứa con tinh thần ngày đó của các nhà sáng lập UNIGROUP đã vững vàng phát
                triển thành một thương hiệu dịch vụ có lối đi riêng!</p>
            <h3>Thương hiệu logistics dẫn đầu trong lĩnh vực kho Ngoại Quan ngành Gỗ và Nội thất</h3>
            <p>Năm 2006, xác định chọn phân khúc chủ lực là ngành sản xuất và phân phối đồ gỗ gia dụng, U&I Logistics đã
                có một hành trình dài để chinh phục được một khách hàng lớn từ Bắc Mỹ, chứng minh được rằng đội ngũ Việt
                Nam có thể làm được tất cả mọi công đoạn chuẩn từ khi nhập hàng tại các nhà máy sản xuất ở Bình Dương,
                lưu trữ, thông quan, chuyển giao bằng vận tải đa phương thức đến tận các chuỗi cửa hàng tại Mỹ của khách
                hàng. Kho ngoại quan của U&I Logistics đã vượt qua các yêu cầu khắt khe của Hải quan Mỹ với chứng chỉ
                C-TPAT, là một trong những chứng nhận khó để phản ánh năng lực đảm bảo an ninh, an toàn cho hàng hóa.
                Một trong những thách thức cho các nhà cung cấp dịch vụ Kho cho hàng đồ gỗ là phải trang bị thiết bị hút
                ẩm chuyên dụng để đảm bảo chất lượng lưu trữ. Công ty U&I logistics không quản ngại khó khăn, chấp nhận
                xoay sở vốn đầu tư để đáp ứng mong muốn của khách hàng trong bối cảnh có rất ít kho dịch vụ có giải pháp
                này. Những nỗ lực của đội ngũ U&I đã được đền đáp xứng đáng bằng sự giới thiệu của chính khách hàng lớn
                nói trên cho cộng đồng doanh nghiệp trong lĩnh vực gỗ và nội thất ở Mỹ, châu Âu, Trung Quốc, Đài Loan,..
                Và cái tên U&I Logistics trong lĩnh vực Kho ngoại quan cho hàng Gỗ và Nội thất cũng bắt đầu thành danh
                từ đó trên sân chơi quốc tế!</p>
            <p>Ngày 26 tháng 01 năm 2007 là một ngày đáng nhớ trong lịch sử hình thành của U&I khi Kho ngoại quan số 1
                được khai trương với quy mô 39.600 m2 – là một trong những kho hàng lớn nhất Việt Nam ở thời điểm đó.
                Không chỉ diện tích lớn, kho của U&I đã được trang bị hệ thống kiểm soát độ ẩm và nhiệt độ tự động
                chuyên dụng cho ngành gỗ và nội thất. Hàng hóa trong kho được quản lý bằng mã vạch ứng dụng phần mềm
                thông minh giúp khách hàng kiểm soát, quản lý được hàng hóa, tiến độ thực hiện nghiệp vụ mọi lúc, mọi
                nơi. Năm 2007 khi điện toán đám mây còn ở giai đoạn sơ khai, hệ thống quản lý kho của U&I là giải pháp
                tự xây dựng thuần Việt và có khả năng tích hợp, tương tác trực tiếp với khách hàng, là một niềm tự hào
                của đội ngũ nhân sự. Với những ưu thế vượt trội nói trên, kho Ngoại quan số 1 nhanh chóng đầy hàng.</p>
            <p>Tiếp nối thành công, U&I Logistics còn liên tục mở rộng phạm vi kho Ngoại quan và trong vòng 14 năm từ
                ngày thành lập kho số 1, tính đến năm 2021, Công ty đã khánh thành kho ngoại quan thứ 10, nâng tổng diện
                tích sàn kho Ngoại quan lên đến mức 242,320 m2 và tổng diện tích lưu trữ trên 2 triệu m2, đứng đầu khu
                vực Đông Nam Á về lĩnh vực kho Ngoại quan dành riêng cho ngành Gỗ và Nội thất.</p>
            <h3>Mở rộng, đi sâu và trở thành nhà cung cấp giải pháp hiệu quả cho khách hàng</h3>
            <p>Năm 2015, Công ty UNITRANS một lần nữa đổi tên thành Công ty Cổ phần Logistics U&I (U&I Logistics) với
                mục đích phát triển toàn diện các dịch vụ logistics trọn gói cho khách hàng, đề cao tính hiệu quả và gắn
                bó lâu dài.</p>
            <p>Song hành cùng hoạt động Kho ngoại quan, các dịch vụ logistics của U&I Logistics đã phát triển và hoàn
                thiện dần, đáp ứng nhiều yêu cầu dịch vụ phức tạp của khách hàng: dịch vụ vận tải nội địa, dịch vụ giao
                nhận vận tải đa phương thức quốc tế, dịch vụ đại lý khai báo hải quan và tư vấn thuế xuất nhập khẩu,..
            </p>
            <p>Tính đến đầu năm 2023, U&I Logistics đang sở hữu 40 xe đầu kéo, hơn 100 rơ-moóc và mạng lưới đối tác vận
                tải quy mô đáp ứng 1.000 TEUs/ngày. Công ty cũng đang là đại lý cho 16 hãng hàng không lớn trong và
                ngoài nước, hơn 20 hãng tàu có các tuyến Nội Á và xuyên đại dương, phục vụ hàng chục ngàn container nhập
                – xuất hàng năm..</p>
            <p>Nhìn lại danh sách khách hàng đã gắn bó nhiều năm, U&I Logistics tự hào rằng, với các khách hàng, một khi
                đã tin cậy, họ có thể đưa ra yêu cầu nhiều dịch vụ logistics và đội ngũ U&I Logistics đủ khả năng xây
                dựng được giải pháp riêng hiệu quả cho từng khách hàng.</p>
            <p>Bên cạnh thị trường phục vụ hàng hóa Việt Nam ra quốc tế, trong thị trường tiêu dùng nội địa, ít người
                biết U&I Logistics cũng được hai thương hiệu siêu thị hàng đầu Việt Nam “chọn mặt gửi vàng”: Saigon
                Co.op (chủ nhân của chuỗi siêu thị Co.op Mart và Co.op Food) và Trancy (đối tác logistics của hệ thống
                siêu thị Aeon Mall tại Việt Nam). U&I Warehousing – một thành viên của U&I Logistics đã được giao hoạt
                động vận hành kho trung tâm để phục vụ các siêu thị tại miền Nam cho khách hàng. Mỗi ngày, hàng ngàn
                chuyến xe đều đặn nhập – xuất hàng hóa tại Trung tâm phân phối do U&I Logistics vận hành tại KCN Sóng
                Thần 1 và KCN VSIP, đảm bảo hàng hóa luôn có mặt tại kệ hàng các siêu thị nhanh chóng, chuẩn xác, hiệu
                quả. U&I logistics cũng mạnh dạn chọn cho mình những “ngách” riêng khi vận hành dịch vụ logistics trong
                lĩnh vực kho chuyên dụng cho hàng cao su, kho chuyên dụng trong ngành dược phẩm và thiết bị y tế, đem bí
                quyết, kinh nghiệm, công nghệ tích lũy được để nâng cao tính hiệu quả vận hành logistics cho khách hàng.
            </p>
            <p>Tăng trưởng cùng nhu cầu của khách hàng, U&I Logistics mở rộng mạng lưới phục vụ ở các vùng kinh tế trọng
                điểm: U&I miền Bắc (2019) đảm nhiệm “phủ sóng” toàn bộ khu vực kinh tế trọng điểm ở Đồng bằng Sông Hồng
                và Duyên hải, U&I Tp. HCM (2022) giúp chăm sóc khách hàng khu vực Tp.HCM, Đồng Nai thuận tiện và linh
                hoạt hơn. Mạng lưới đối tác đại lý của U&I Logistics cũng bao phủ ở các nước: Mỹ, Nhật, Anh, Pháp,
                Canada, Trung Quốc, các quốc gia khu vực Trung Đông.. Nơi nào có luồng hàng hóa đi và đến Việt Nam
                nhiều, nơi đó sẽ có sự phục vụ của U&I Logistics. U&I Logistics đặt sự phục vụ khách hàng lên trên để
                kết nối, dệt thành mạng lưới đối tác cung ứng dịch vụ chuyên nghiệp.</p>
            <h3>Số hóa vận hành, chủ động về công nghệ</h3>
            <p>U&I Logistics luôn khuyến khích các sáng kiến mới giúp cải tiến, nâng cao hiệu quả vận hành trong lĩnh
                vực logistics. Thấu hiểu vai trò của công nghệ trong quản trị, U&I Logistics mạnh dạn đầu tư đội ngũ kỹ
                thuật để làm chủ hoạt động vận hành, phục vụ kinh doanh nhanh chóng, hiệu quả hơn. U&I Logistics tự hào
                có được đội ngũ nhân sự giỏi lập trình, hiểu nghiệp vụ để có thể xây dựng đầy đủ các hệ thống quản lý
                nghiệp vụ theo nhu cầu đặc thù của khách hàng: quản lý kho (WMS), quản lý vận tải (TMS), quản lý vận
                hành tập trung (ONP), quản lý nhân sự (HRM), quản lý quan hệ khách hàng (CRM)… Đó cũng là một trong
                những điểm mà khách hàng tin cậy U&I ở khả năng cung cấp báo cáo hoạt động vận hành một cách nhanh
                chóng, chính xác.</p>
            <p>Ở thời điểm 2013, U&I Logistics là đơn vị đầu tiên đầu tư vào mô hình sàn vận tải Việt Nam (VTruck) nhằm
                giải quyết bài toán xe chạy rỗng chiều về, giúp giảm lãng phí trong vận tải ở Việt Nam. Bài toán này
                được nhiều doanh nghiệp Start up công nghệ tham gia chia sẻ, giải quyết và thu hút được sự quan tâm của
                cộng đồng, chẳng hạn như Logivan, EcoTruck, Loglag, VTGo, Smartlog,.. Tuy Vtruck chưa trở thành một hình
                mẫu thành công nhưng tính cách tiên phong, mạnh dạn thử cái mới đã là một phần trong bộ gene của U&I
                Logistics.</p>
            <p>Năm 2018, đã có tình huống khách hàng đề nghị U&I Logistics phải sử dụng phần mềm WMS nước ngoài với chi
                phí rất cao mới cho vận hành. Sau khi phân tích kỹ yêu cầu, đội công nghệ U&I Logistics mạnh dạn đề nghị
                phát triển riêng bộ WMS có chức năng tinh gọn hơn, vẫn đáp ứng đầy đủ yêu cầu vận hành và mà chi phí rẻ
                nhiều lần trong khoảng thời gian kỷ lục: chưa đến 2 tháng. Và đúng như cam kết, sau 2 tháng xây dựng,
                vận hành và điều chỉnh, phiên bản WMS của U&I Logistics đã đáp ứng được các yêu cầu vận hành, giúp
                nghiệp vụ kho trở nên trơn tru, chuẩn mực.</p>
            <p>Trong xu hướng “Logistics xanh”, U&I Logistics là một trong những doanh nghiệp logistics tiên phong đầu
                tư hệ thống điện mặt trời áp mái để cung ứng điện cho hệ thống máy kiểm soát độ ẩm trong toàn công ty,
                tiết giảm tiêu thụ điện lưới, góp phần “xanh hóa” hoạt động logistics. Ở U&I Logistics, ý tưởng công
                nghệ giúp nâng cao hiệu quả vận hành luôn được chào đón.</p>
            <h3>U&I – Hướng tới sự thịnh vượng cho cộng đồng</h3>
            <p>Suốt từ năm 2017 đến nay, U&I Logistics là nhà tài trợ Kim Cương trong chương trình thường niên “Tìm kiếm
                tài năng trẻ Logistics Việt Nam” (Vietnam Young Logistics Talent), không chỉ chia sẻ, lan tỏa kiến thức,
                tạo điều kiện tìm hiểu doanh nghiệp mà còn đồng hành, hỗ trợ các nhân tài logistics Việt Nam có cơ hội
                nghiên cứu, ứng dụng trong thực tế những ý tưởng hay, độc đáo.</p>
            <p>Thương hiệu U&I Logistics là cái tên quen thuộc trong hoạt động xã hội với mong muốn đóng góp tích cực
                cho cộng đồng địa phương. Còn nhớ giai đoạn căng thẳng của đợt giãn cách xã hội phòng chống dịch
                Covid-19 giữa năm 2021, trước áp lực về thiếu chỗ tiếp nhận bệnh nhân Covid-19 trên địa bàn tỉnh Bình
                Dương, khi kho số 10 vừa xây xong, U&I Logistics đã mạnh dạn đề xuất với lãnh đạo phường Khánh Bình, Thị
                xã Tân Uyên để đóng góp toàn bộ mặt bằng 12.800 m2 làm nơi tiếp nhận bệnh nhân Covid-19 tạm thời trong
                lúc chờ được chữa trị với sức chứa 2,500 người. Công ty cũng đã phối hợp cùng đội ngũ nhân sự, khách
                hàng, đối tác để quyên góp ủng hộ hoạt động đồng hành phòng chống dịch Covid-19 với tổng giá trị gần 3
                tỷ đồng cùng các hiện vật giá trị.</p>
            <p>Liên tục trong nhiều năm, U&I Logistics nằm trong danh sách các đơn vị có nhiều đóng góp cho hoạt động
                cộng đồng tại Bình Dương và cho Hiệp hội Doanh nghiệp dịch vụ logistics Việt Nam.</p>
            <p>Ông Nguyễn Xuân Phúc, Tổng Giám đốc U&I Logistics chia sẻ: “U&I Logistics tự hào là đơn vị Logistics hàng
                đầu Việt Nam chuyên cung cấp các dịch vụ logistics cho thị trường trong nước và quốc tế. Chúng tôi ủng
                hộ quan điểm phát triển bền vững và tin tưởng rằng việc cung cấp đến khách hàng các dịch vụ tiện ích
                nhất, chất lượng cao nhất, với giá cả phù hợp nhất là yếu tố quyết định tạo nên thành công và uy tín của
                chính mình. Logistics là một lĩnh vực hết sức quan trọng của nền kinh tế. Sứ mệnh của chúng tôi là tạo
                dựng được một thương hiệu logistics hàng đầu của người Việt Nam, với ý thức sâu sắc rằng sự phát triển
                của chúng tôi gắn liền với sự phát triển của khách hàng, của người lao động, và của cả cộng đồng”</p>
            <h3>Thúc đẩy luồng thương mại toàn cầu, mở rộng mạng lưới đối tác</h3>
            <p>Ở U&I Logistics, chúng tôi hiểu “muốn đi nhanh hãy đi một mình, muốn đi xa hãy đi cùng nhau”. Logistics
                là ngành đặc thù mà không một doanh nghiệp nào có thể giỏi mọi thứ, “phủ sóng” ở khắp mọi nơi và tự làm
                một mình. Hợp tác để tạo nên mạng lưới đối tác rộng lớn, tin cậy và có cùng quan điểm phục vụ khách hàng
                chính là chìa khóa để phát triển lâu dài trong ngành Logistics. Mạng lưới đối tác hợp tác lâu năm, từ
                các nhà vận tải đến các hãng tàu, đại lý giao nhận, các đối tác cung cấp kho bãi, cho thuê thiết bị..
                luôn giữ được mối quan hệ tin cậy, tích cực.</p>
            <p>U&I Logistics nhận thức rõ vị thế của mình cũng như cơ hội từ luồng hàng hóa thương mại Việt Nam với toàn
                cầu, cho nên, chúng tôi sẵn sàng hợp tác với các đối tác cùng chí hướng để tạo thành một khối liên kết
                đủ sức cạnh tranh trong thị trường logistics quốc tế. Với đội ngũ hơn 700 nhân sự nhiệt huyết, giàu kinh
                nghiệm, U&I Logistics đang hướng đến tầm nhìn “Trở thành nhà cung cấp các dịch vụ logistics hiệu quả
                nhất tại Việt Nam” trong 10 năm tới, vươn tầm phục vụ ra thị trường thế giới.</p>
            <p>Công nghệ hẳn nhiên sẽ thay đổi, quy trình công việc chắc chắn sẽ được cải tiến nâng cấp, nhưng sự chân
                thành và cam kết vẫn là chất keo quan trọng nhất để U&I Logistics và các đối tác dệt nên mạng lưới
                logistics có hiệu quả nhất!</p>
            <p>Trân trọng cảm ơn Quý khách hàng đã tin tưởng và chọn lựa dịch vụ của U&I Logistics. Cảm ơn quý Đối tác,
                nhân sự gắn bó, đồng hành cùng U&I Logistics trong suốt hành trình vừa qua. Cùng nhau, chúng ta sẽ tạo
                nên nhiều giá trị hơn cho ngành logistics Việt Nam!</p>
        </div>
</section>
<?php include_once(__DIR__ . '/../public/footer.php'); ?>