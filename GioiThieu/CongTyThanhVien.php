<section class="members-section">
    <div class="members-container">
        <h2 class="members-title">Công ty thành viên</h2>
        <p class="members-subtitle">Hoạt động trong lĩnh vực logistics</p>

        <div class="member-cards">
            <!-- Mỗi card là 1 công ty thành viên -->
            <div class="member-card">
                <img src="https://www.unilogistics.vn/upload/files/unitran-U%26I.jpg" alt="Unitrans"
                    class="member-logo">
                <h3>Unitrans</h3>
                <p>Trụ sở chính: 158 Ngô Gia Tự, Bình Dương</p>
                <p>Tel: +84 27 4382 2908</p>
                <a href="https://unitrans.vn" class="member-link">Xem thêm &raquo;</a>
            </div>
            <div class="member-card">
                <img src="https://www.unilogistics.vn/upload/files/unitran-U%26I.jpg" alt="U&I Warehouse"
                    class="member-logo">
                <h3>U&I Warehouse</h3>
                <p>Trụ sở chính: 158 Ngô Gia Tự, Bình Dương</p>
                <p>Tel: +84 274 3816288</p>
                <a href="https://unilogistics.vn" class="member-link">Xem thêm &raquo;</a>
            </div>
            <div class="member-card">
                <img src="https://www.unilogistics.vn/upload/files/U%26I-mien-bac.jpg" alt="U&I Logistics – Miền Bắc"
                    class="member-logo">
                <h3>U&I Logistics - Miền Bắc</h3>
                <p>Văn phòng Hà Nội: Trường Chinh, Thanh Xuân</p>
                <p>Tel: +84 24 7300 0548</p>
                <a href="#" class="member-link">Xem thêm &raquo;</a>
            </div>
            <div class="member-card">
                <img src="https://www.unilogistics.vn/upload/files/van-tai-U%26I.jpg" alt="U&I Logistics – Miền Bắc"
                    class="member-logo">
                <h3>Công ty Cổ phần Vận tải U&I Miền Bắc (Unitrans - Northern JSC)</h3>
                <p>Văn phòng Hải Phòng
                    Tầng 10, Tòa nhà Saigonbank, Lô 2, 3B Lê Hồng Phong, Phường Đông Khê, Quận Ngô Quyền, TP. Hải Phòng,
                    Việt Nam</p>
                <p>Tel: +84 225 3222 399</p>
                <a href="#" class="member-link">Xem thêm &raquo;</a>
            </div>
        </div>
    </div>
</section>

<style>
body {
    font-family: 'Inter', sans-serif;
}

.members-section {
    background: #ffffff;
    padding: 80px 60px;
    color: #222;
}

.members-container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.members-title {
    font-size: 32px;
    font-weight: 800;
    color: #1f3c88;
    margin-bottom: 8px;
}

.members-subtitle {
    font-size: 18px;
    color: #555;
    margin-bottom: 40px;
}

.member-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
}

.member-card {
    background: #fafbfc;
    border-radius: 12px;
    padding: 28px 20px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.member-card:hover {
    background: linear-gradient(135deg, #1f6fb2, #2b86d6);
    color: #fff;
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
}

.member-card .member-logo {
    width: 80px;
    height: auto;
    margin-bottom: 16px;
}

.member-card h3 {
    font-size: 20px;
    margin: 0 0 8px;
    color: inherit;
}

.member-card p {
    margin: 4px 0;
    font-size: 14px;
    color: inherit;
}

.member-link {
    margin-top: auto;
    font-size: 15px;
    font-weight: 600;
    color: #1f3c88;
    text-decoration: none;
    transition: color 0.2s ease;
}

.member-card:hover .member-link {
    color: #fff;
}

@media (max-width: 768px) {
    .members-section {
        padding: 60px 20px;
    }
}
</style>