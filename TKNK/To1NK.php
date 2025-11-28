<?php
require_once(__DIR__ . "/../core/database.php");
require_once(__DIR__ . '/../core/phanQuyen.php');
require_role($_role_KhaiBao);
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}
//  if(!empty($_GET['id'])){
//         $sql = "SELECT * FROM `to1NK` WHERE id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("s", $_GET['id']);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $data = $result->fetch_assoc();
//         print_r($data); 
//      }
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tờ khai nhập khẩu</title>
    <link rel="stylesheet" href="style.css?v1.0.4">
    <style>
        .ac-wrap {
            position: relative
        }

        .ac-list {
            position: absolute;
            z-index: 9999;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 220px;
            overflow: auto;
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .08);
        }

        .ac-item {
            padding: 8px 10px;
            cursor: pointer;
            font-size: 14px;
            line-height: 1.3
        }

        .ac-item:hover,
        .ac-item.active {
            background: #f3f4f6
        }

        .ac-muted {
            color: #6b7280;
            font-size: 12px;
            margin-left: 6px
        }

        .hidden {
            display: none
        }
    </style>
</head>


<body>
    <div class="container">
        <h2>Tờ khai nhập khẩu - Thông tin chung 1</h2>
        <fieldset>
            <legend>Loại Xuất Khẩu:</legend>
            <div class="radio-group">
                <label><input type="radio" name="khuvuc" value="trong_nuoc" checked>Trong nước</label>
                <label><input type="radio" name="khuvuc" value="ngoai_nuoc">Ngoài nước</label>
            </div>
        </fieldset>
        <form method="POST" action="To2NK.php">
            <fieldset>
                <legend>Nhóm loại hình:</legend>
                <div class="radio-group">
                    <label><input type="radio" value="Kinh doanh, đầu tư" name="nhom_loai_hinh" checked> Kinh doanh,
                        đầu
                        tư</label>
                    <label><input type="radio" value="Sản xuất xuất khẩu" value="" name="nhom_loai_hinh"> Sản xuất
                        xuất
                        khẩu</label>
                    <label><input type="radio" value="Gia công" name="nhom_loai_hinh"> Gia công</label>
                    <label><input type="radio" value="Chế xuất" name="nhom_loai_hinh"> Chế xuất</label>
                </div>
                <div class="form-group">
                    <label>Mã loại hình:</label>
                    <select name="ma_loai_hinh">
                        <option value="" checked></option>
                        <option value="A11">A11: Nhập kinh doanh tiêu dùng</option>
                        <option value="A12">A12: Nhập kinh doanh sản xuất</option>
                    </select>
                    <label style="width: 240px">Phân loại cá nhân/tổ chức:</label>
                    <select name="phan_loai_to_chuc">
                        <option value="" checked></option>
                        <option value="P1">1: Cá nhân gửi cá nhân</option>
                        <option value="P2">2: Tổ chức gửi cá nhân</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Cơ quan Hải quan:</label>
                    <select name="co_quan_hq">
                        <option value="" checked></option>
                        <option value="28NJ">28NJ - Chi cục HQ Hà Nam</option>
                        <option value="01VN">01NV - Chi cục HQ Nội Bài</option>
                    </select>
                    <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
                    <select name="phuong_thuc_vc">
                        <option value="" checked></option>
                        <option value="P1">1: Đường không</option>
                        <option value="P2">2: Đường biển (container)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mã phân loại hàng hóa:</label>
                    <select name="ma_phan_loai_hang">
                        <option value="" checked></option>
                        <option value="A">A: Hàng quà biếu, quà tặng</option>
                        <option value="B">B: Hàng an ninh, quốc phòng</option>
                    </select>
                    <label style="width: 240px">Mã bộ phận xử lí tờ khai:</label>
                    <select name="ma_bo_phan_xu_ly">
                        <option value="" checked></option>
                        <option value="00">00: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho TCS.</option>
                        <option value="01">01: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho SCSC.</option>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin người nhập khẩu:</legend>
                <div class="form-group">
                    <label class="required">Mã số thuế doanh nghiệp:</label>
                    <input type="text" name="MSTDNNK" placeholder="Mã số thuế doanh nghiệp nhập khẩu" required>
                    <label style="width: 97px;">Mã bưu chính:</label>
                    <input type="text" name="MBCNK" placeholder="Mã bưu chính">
                </div>
                <div class="form-group">
                    <label class="required">Tên doanh nghiệp:</label>
                    <input type="text" name="TDNNK" placeholder="Tên doanh nghiệp nhập khẩu" required>
                </div>
                <div class="form-group">
                    <label class="required">Địa chỉ doanh nghiệp:</label>
                    <input type="text" name="DCDNNK" placeholder="Địa chỉ doanh nghiệp nhập khẩu" required>
                </div>
                <div class="form-group">
                    <label class="required">Số điện thoại doanh nghiệp:</label>
                    <input type="text" name="SDTDNNK" placeholder="Số điện thoại doanh nghiệp nhập khẩu" required>
                </div>
                <legend>Thông tin người ủy thác nhập khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác nhập khẩu:</label>
                    <input type="text" name="NUTNK" placeholder="Tên người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại người ủy thác nhập khẩu:</label>
                    <input type="text" name="SDTUTNK" placeholder="Số điện thoại người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" name="DCUTNK" placeholder="Địa chỉ người ủy thác nhập khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin người xuất khẩu:</legend>
                <div class="form-group">
                    <label class="required">Mã số thuế DN xuất khẩu:</label>
                    <input type="text" name="MSTDNXK" placeholder="Mã số thuế DN xuất khẩu" required>
                    <label style="width: 171px;">Mã bưu chính xuất khẩu:</label>
                    <input type="text" name="MBCXK" placeholder="Mã bưu chính xuất khẩu">
                </div>
                <div class="form-group">
                    <label class="required">Tên DN xuất khẩu:</label>
                    <input type="text" name="TDNXK" placeholder="Tên DN xuất khẩu" required>
                </div>
                <div class="form-group">
                    <label class="required">Địa chỉ DN xuất khẩu:</label>
                    <input type="text" name="DCDNXK" placeholder="Địa chỉ DN xuất khẩu" required>
                </div>
                <div class="form-group">
                    <label class="required">SĐT DN xuất khẩu:</label>
                    <input type="text" name="SDTDNXK" placeholder="SĐT DN xuất khẩu" required>
                </div>
                <legend>Thông tin người ủy thác xuất khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác xuất khẩu:</label>
                    <input type="text" name="NUTXK" placeholder="Tên người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>SĐT người ủy thác xuất khẩu:</label>
                    <input type="text" name="SDTUTXK" placeholder="SĐT người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác xuất khẩu:</label>
                    <input type="text" name="DCUTXK" placeholder="Địa chỉ người ủy thác xuất khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận đơn:</legend>
                <div class="form-group">
                    <label class="required">Số vận đơn:</label>
                    <input type="text" name="SVD" placeholder="Số vận đơn" required>
                    <label style="width: 111px" class="required">Ngày vận đơn:</label>
                    <input type="date" name="NVD" required>
                </div>
                <div class="form-group">
                    <label class="required">Số lượng kiện:</label>
                    <input type="text" name="SLK" placeholder="Số lượng kiện" required>
                    <select name="don_vi_kien" required>
                        <option value="" checked></option>
                        <option value="SET">SET: Bộ</option>
                        <option value="DZN">DZN: Tá</option>
                        <option value="PCE">PCE: Cái/Chiếc</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">Tổng trọng lượng hàng:</label>
                    <input type="text" name="TTLH" placeholder="Tổng trọng lượng hàng" required>
                    <select name="don_vi_tl" required>
                        <option value="" checked></option>
                        <option value="GRM">GRM: Gam</option>
                        <option value="KGM">KGM: Kilogam</option>
                        <option value="TNE">TNE: Tấn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">Mã địa điểm lưu kho:</label>
                    <input type="text" id="MDDLK_code" name="MDDLK" placeholder="Mã địa điểm lưu kho"
                        list="codes-by-region" required>
                    <select name="dia_diem_luu_kho" id="location-select">
                    </select>
                </div>
                <div class="form-group">
                    <label>Ký hiệu & số hiệu bao bì:</label>
                    <input type="text" name="KH_SHBB" placeholder="Ký hiệu và số hiệu bao bì">
                </div>
                <div class="form-group">
                    <label class="required">Phương tiện vận chuyển:</label>
                    <input type="text" name="so_hieu_tau" placeholder="Nếu là tàu biển ghi 9999">
                    <input type="text" name="PTVC" placeholder="Phương tiện vận chuyển" required>
                </div>
                <div class="form-group">
                    <label class="required">Ngày hàng đến:</label>
                    <input type="date" name="NHD" required>
                </div>
                <div class="form-group">
                    <label class="required">Địa điểm dỡ hàng:</label>
                    <input type="text" id="DDDH_code" name="DDDH" placeholder="Địa điểm dỡ hàng" list="codes-by-region"
                        required>
                    <select name="ma_dd_dohang" id="location-select2">
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">Địa điểm xếp hàng:</label>
                    <input type="text" id="DDXH_code" name="DDXH" placeholder="Địa điểm xếp hàng" list="codes-by-region"
                        required>
                    <select name="ma_dd_xephang" id="location-select3"></select>
                </div>

                <div class="form-group">
                    <label class="required">Số lượng container:</label>
                    <input type="number" name="SLCT" required>
                </div>
                <div class="form-group">
                    <label>Mã kết quả kiểm tra nội dung:</label>
                    <select name="ma_kq_ktnd">
                        <option value="" checked></option>
                        <option value="A1">A: Không có bất thường</option>
                        <option value="B1">B: Có bất thường</option>
                        <option value="C1">C: Cần tham vấn HQ</option>
                    </select>
                </div>
            </fieldset>

            <div class="button-group">
                <button type="submit" name="action" onclick="window.location.href='../TKNK/to2nk.php'">Trang
                    sau</button>
                <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
        </form>
        <script>
            const locations = {
                trong_nuoc: [{
                    code: "03CCS01",
                    name: "HOÀNG DIỆU"
                },
                {
                    code: "03CCS03",
                    name: "TÂN CẢNG"
                },
                {
                    code: "03CCS18",
                    name: "HECHUN"
                },
                {
                    code: "03CC0ZZ",
                    name: "ĐĐ LƯU KHO KVI"
                },
                {
                    code: "03CES01",
                    name: "HẢI AN"
                },
                {
                    code: "03CES02",
                    name: "CHÙA VẼ"
                },
                {
                    code: "03CES03",
                    name: "KHO VIETFRACHT"
                },
                {
                    code: "03CES04",
                    name: "KHO NAM PHÁT (HAI MINH)"
                },
                {
                    code: "03CES05",
                    name: "KHO SAO ĐỎ"
                },
                {
                    code: "03CES06",
                    name: "KHO INLACO"
                },
                {
                    code: "03CES07",
                    name: "KHO TÂN TIÊN PHONG"
                },
                {
                    code: "03CES11",
                    name: "NAM ĐÌNH VŨ"
                },
                {
                    code: "03CES14",
                    name: "MPC PORT (MIPEC)"
                },
                {
                    code: "03TGS01",
                    name: "CẢNG NAM HẢI"
                },
                {
                    code: "03TGS02",
                    name: "CẢNG ĐOẠN XÁ"
                },
                {
                    code: "03TGS03",
                    name: "CẢNG TRANSVINA"
                },
                {
                    code: "03TGS04",
                    name: "CẢNG GREEN PORT"
                },
                {
                    code: "03TGC01",
                    name: "KHO VINABRIDGE"
                },
                {
                    code: "03TGC02",
                    name: "KHO VICONSHIP"
                },
                {
                    code: "03TGC03",
                    name: "KHO GERMADEPT ĐÔNG HẢI"
                },
                {
                    code: "03TGC04",
                    name: "KHO VIJACO"
                },
                {
                    code: "03TGC05",
                    name: "KHO LOGISTICS XANH"
                },
                {
                    code: "03TGC06",
                    name: "KHO CFS GLC"
                },
                {
                    code: "03EES01",
                    name: "CẢNG ĐÌNH VŨ"
                },
                {
                    code: "03EES02",
                    name: "TÂN CẢNG 189"
                },
                {
                    code: "20CFS09",
                    name: "CẢNG CÁI LÂN"
                },
                {
                    code: "03CCS03",
                    name: "CẢNG CÁI MÉP"
                },
                {
                    code: "34CES01",
                    name: "CẢNG TIÊN SA"
                },
                {
                    code: "03EES09",
                    name: "TÂN CẢNG 128"
                },
                {
                    code: "03TGS02",
                    name: "Tanamexco"
                }
                ],
                ngoai_nuoc: [{
                    code: "JPMOJ",
                    name: "Moji"
                },
                {
                    code: "JPFUK",
                    name: "Fukuoka"
                },
                {
                    code: "JPNGO",
                    name: "Nagoya"
                },
                {
                    code: "CNSHA",
                    name: "Shanghai"
                },
                {
                    code: "CNSZX",
                    name: "Shenzhen"
                },
                {
                    code: "CNCAN",
                    name: "Guangzhou"
                },
                {
                    code: "CNCZZ",
                    name: "Cangzhou"
                },
                {
                    code: "KRPUS",
                    name: "Busan"
                },
                {
                    code: "KRINC",
                    name: "Incheon"
                },
                {
                    code: "SGSIN",
                    name: "Singapore (Port)"
                },
                {
                    code: "NLAMS",
                    name: "Rotterdam"
                },
                {
                    code: "USNYC",
                    name: "New Jersey port area"
                },
                {
                    code: "BRSSZ",
                    name: "Santos"
                },
                {
                    code: "DEHAM",
                    name: "Hamburg"
                },
                {
                    code: "ESVLC",
                    name: "Valencia"
                },
                {
                    code: "CAVAN",
                    name: "Vancouver"
                },
                {
                    code: "MAMAZ",
                    name: "Manzanillo"
                },
                {
                    code: "AUMEL",
                    name: "Melbourne / Sydney"
                },
                {
                    code: "INJNP",
                    name: "Jawaharlal Nehru (JNPT)"
                },
                {
                    code: "TRIST",
                    name: "Istanbul"
                },
                {
                    code: "THSRI",
                    name: "Sriracha Harbour"
                },
                {
                    code: "THSGZ",
                    name: "Songkhla Port"
                },
                {
                    code: "IDTPP",
                    name: "Tanjung Priok (Jakarta)"
                },
                {
                    code: "IDDUM",
                    name: "Dumai Port"
                },
                {
                    code: "MYPKG",
                    name: "Port Klang"
                },
                {
                    code: "PHMNL",
                    name: "Port of Manila"
                },
                {
                    code: "MYPEN",
                    name: "Penang Port"
                }
                ]
            };

            /* =======================
               2) HELPERS CHUNG
               ======================= */
            function getCurrentRegion() {
                const checked = document.querySelector('input[name="khuvuc"]:checked');
                return checked ? checked.value : 'trong_nuoc';
            }

            // Gom unique theo code, uppercase để khớp so sánh
            function buildOptionsByRegion(region) {
                const uniq = new Map();
                (locations[region] || []).forEach(loc => {
                    const code = (loc.code || '').toUpperCase();
                    if (!uniq.has(code)) uniq.set(code, loc.name || '');
                });
                return Array.from(uniq.entries()).map(([code, name]) => ({
                    code,
                    name
                }));
            }

            /* =======================
               3) POPULATE SELECT THEO KHU VỰC
               ======================= */
            function populateSelectFromRegion(selectId, region) {
                const select = document.getElementById(selectId);
                if (!select) return;
                const keep = select.value;
                select.innerHTML = '';

                // option rỗng
                const empty = document.createElement('option');
                empty.value = '';
                empty.textContent = '';
                select.appendChild(empty);

                buildOptionsByRegion(region).forEach(({
                    code,
                    name
                }) => {
                    const op = document.createElement('option');
                    op.value = code;
                    op.textContent = name || code;
                    select.appendChild(op);
                });

                if (keep && Array.from(select.options).some(o => o.value === keep)) {
                    select.value = keep;
                } else {
                    select.value = '';
                }
            }

            /* =======================
               4) ĐỒNG BỘ INPUT ↔ SELECT
               ======================= */
            function syncInputToSelect(inputId, selectId) {
                const input = document.getElementById(inputId);
                const select = document.getElementById(selectId);
                if (!input || !select) return;
                const val = (input.value || '').trim().toUpperCase();
                select.value = val && Array.from(select.options).some(o => (o.value || '').toUpperCase() === val) ? val :
                    '';
            }

            function syncSelectToInput(selectId, inputId) {
                const input = document.getElementById(inputId);
                const select = document.getElementById(selectId);
                if (!input || !select) return;
                input.value = select.value || '';
            }

            /* =======================
               5) BIND CẶP INPUT/SELECT
                  - regionOverride: 'trong_nuoc' | 'ngoai_nuoc' | null
               ======================= */
            function bindInputSelectPair({
                inputId,
                selectId,
                regionSensitive = true,
                regionOverride = null
            }) {
                const input = document.getElementById(inputId);
                const select = document.getElementById(selectId);
                if (!input || !select) return;

                const resolveRegion = () => regionOverride || getCurrentRegion();

                // Render lần đầu
                populateSelectFromRegion(selectId, resolveRegion());

                // Gõ mã → ép UPPERCASE + sync
                input.addEventListener('input', () => {
                    input.value = input.value.toUpperCase();
                    syncInputToSelect(inputId, selectId);
                });

                // Chọn option → điền ngược mã
                select.addEventListener('change', () => syncSelectToInput(selectId, inputId));

                // Rời ô → snap theo mã
                input.addEventListener('blur', () => syncInputToSelect(inputId, selectId));

                // Khởi tạo đồng bộ
                syncInputToSelect(inputId, selectId);

                return {
                    refreshByRegion() {
                        // Nếu cặp này có override → không bị ảnh hưởng khi đổi khu vực
                        if (regionOverride) return;
                        if (!regionSensitive) return;
                        populateSelectFromRegion(selectId, resolveRegion());
                        syncInputToSelect(inputId, selectId);
                    }
                };
            }

            /* =======================
               6) DATALIST GỢI Ý CƠ BẢN (FALLBACK)
               ======================= */
            function populateDatalistFromRegion(datalistId, region) {
                const dl = document.getElementById(datalistId);
                if (!dl) return;
                dl.innerHTML = '';

                const empty = document.createElement('option');
                empty.value = '';
                empty.label = '';
                dl.appendChild(empty);

                buildOptionsByRegion(region).forEach(({
                    code,
                    name
                }) => {
                    const op = document.createElement('option');
                    op.value = code;
                    op.label = name || code;
                    op.textContent = `${code} — ${name}`;
                    dl.appendChild(op);
                });
            }

            /* =======================
               7) AUTOCOMPLETE TÙY BIẾN (HIỆN KHI GÕ)
               ======================= */
            (function injectAutocompleteStyles() {
                const css = `
  .ac-wrap{position:relative}
  .ac-list{
    position:absolute; z-index:9999; top:100%; left:0; right:0;
    max-height:220px; overflow:auto; border:1px solid #e5e7eb; background:#fff;
    border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,.08)
  }
  .ac-item{padding:8px 10px; cursor:pointer; font-size:14px; line-height:1.3}
  .ac-item:hover,.ac-item.active{background:#f3f4f6}
  .ac-muted{color:#6b7280; font-size:12px; margin-left:6px}
  .hidden{display:none}`;
                const style = document.createElement('style');
                style.textContent = css;
                document.head.appendChild(style);
            })();

            function getCodeList(region) {
                return buildOptionsByRegion(region)
                    .filter(it => it.code)
                    .sort((a, b) => a.code.localeCompare(b.code));
            }

            function attachAutocomplete({
                inputId,
                selectId,
                regionOverride = null
            }) {
                const input = document.getElementById(inputId);
                if (!input) return;

                // Bọc input
                if (!input.parentElement.classList.contains('ac-wrap')) {
                    const wrap = document.createElement('div');
                    wrap.className = 'ac-wrap';
                    input.parentElement.insertBefore(wrap, input);
                    wrap.appendChild(input);
                }
                const wrap = input.parentElement;

                // Tạo list
                let list = wrap.querySelector('.ac-list');
                if (!list) {
                    list = document.createElement('div');
                    list.className = 'ac-list hidden';
                    wrap.appendChild(list);
                }

                let items = [];
                let idx = -1;

                function resolveRegion() {
                    return regionOverride || getCurrentRegion();
                }

                function refreshItemsByRegion() {
                    items = getCodeList(resolveRegion());
                }

                function renderList(filter) {
                    const q = (filter || '').trim().toUpperCase();
                    list.innerHTML = '';
                    idx = -1;

                    if (!q) {
                        list.classList.add('hidden');
                        return;
                    }

                    const starts = items.filter(it => it.code.startsWith(q));
                    const contains = items.filter(it => !it.code.startsWith(q) && it.code.includes(q));
                    const merged = [...starts, ...contains].slice(0, 12);

                    if (merged.length === 0) {
                        list.classList.add('hidden');
                        return;
                    }

                    merged.forEach((it) => {
                        const row = document.createElement('div');
                        row.className = 'ac-item';
                        row.dataset.code = it.code;
                        row.innerHTML =
                            `<strong>${it.code}</strong><span class="ac-muted">— ${it.name || it.code}</span>`;
                        row.addEventListener('mousedown', (e) => {
                            e.preventDefault();
                            pick(it.code);
                        });
                        list.appendChild(row);
                    });

                    list.classList.remove('hidden');
                }

                function highlight(delta) {
                    const children = Array.from(list.children);
                    if (children.length === 0) return;
                    idx = (idx + delta + children.length) % children.length;
                    children.forEach(c => c.classList.remove('active'));
                    children[idx].classList.add('active');
                    children[idx].scrollIntoView({
                        block: 'nearest'
                    });
                }

                function pick(code) {
                    input.value = code.toUpperCase();
                    list.classList.add('hidden');
                    if (selectId) syncInputToSelect(inputId, selectId);
                }

                // Events
                input.addEventListener('input', () => {
                    input.value = input.value.toUpperCase();
                    renderList(input.value);
                });
                input.addEventListener('keydown', (e) => {
                    if (list.classList.contains('hidden')) return;
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        highlight(+1);
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        highlight(-1);
                    } else if (e.key === 'Enter') {
                        if (idx >= 0) {
                            e.preventDefault();
                            const el = list.children[idx];
                            if (el) pick(el.dataset.code);
                        } else {
                            pick(input.value);
                        }
                    } else if (e.key === 'Escape') {
                        list.classList.add('hidden');
                    }
                });
                input.addEventListener('blur', () => {
                    setTimeout(() => list.classList.add('hidden'), 150);
                    if (selectId) syncInputToSelect(inputId, selectId);
                });

                // Init
                refreshItemsByRegion();

                return {
                    refresh() {
                        refreshItemsByRegion();
                        if (document.activeElement === input && input.value) {
                            renderList(input.value);
                        } else {
                            list.classList.add('hidden');
                        }
                    }
                };
            }

            /* =======================
               8) KHỞI TẠO & SỰ KIỆN
               ======================= */
            // Bind 3 cặp
            const handlers = [
                bindInputSelectPair({
                    inputId: 'MDDLK_code',
                    selectId: 'location-select',
                    regionSensitive: true
                }),
                bindInputSelectPair({
                    inputId: 'DDDH_code',
                    selectId: 'location-select2',
                    regionSensitive: false,
                    regionOverride: 'trong_nuoc'
                }),
                bindInputSelectPair({
                    inputId: 'DDXH_code',
                    selectId: 'location-select3',
                    regionSensitive: true
                })
            ].filter(Boolean);

            // Datalist fallback
            populateDatalistFromRegion('codes-by-region', getCurrentRegion());

            // Autocomplete tùy biến (hiện khi gõ)
            const acHandlers = [
                attachAutocomplete({
                    inputId: 'MDDLK_code',
                    selectId: 'location-select'
                }),
                attachAutocomplete({
                    inputId: 'DDDH_code',
                    selectId: 'location-select2',
                    regionOverride: 'trong_nuoc'
                }),
                attachAutocomplete({
                    inputId: 'DDXH_code',
                    selectId: 'location-select3'
                })
            ].filter(Boolean);

            // Đổi radio khu vực → refresh datalist, autocomplete, và các select động
            document.querySelectorAll('input[name="khuvuc"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    const region = getCurrentRegion();
                    // datalist
                    populateDatalistFromRegion('codes-by-region', region);
                    // autocomplete dropdown
                    acHandlers.forEach(h => h.refresh && h.refresh());
                    // select đã bind (bị ảnh hưởng bởi khu vực)
                    handlers.forEach(h => h.refreshByRegion && h.refreshByRegion());
                });
            });
        </script>

        <datalist id="codes-by-region"></datalist>

</body>

</html>