# Hướng Dẫn Cài Đặt và Chạy Dự Án (Dự Án 1 - Quần Áo)

Dự án này là một trang web bán quần áo được phát triển bằng PHP và MySQL. Dưới đây là hướng dẫn chi tiết để bạn có thể cài đặt và chạy dự án này trên môi trường local.

## 1. Yêu Cầu Hệ Thống
*   **XAMPP** hoặc **WAMP** (Chương trình tạo môi trường server giả lập có hỗ trợ PHP và MySQL).
*   **MySQL Workbench** (Hoặc phpMyAdmin) để quản lý cơ sở dữ liệu.
*   Trình duyệt web (Chrome, Edge, Firefox, etc.).

## 2. Hướng Dẫn Import CSDL vào MySQL Workbench

Để đưa dữ liệu từ file `.sql` vào MySQL, bạn làm theo các bước sau:

1.  Mở **MySQL Workbench**.
2.  Kết nối vào Local Instance của bạn (thường là `localhost`).
3.  Tạo một Schema (Cơ sở dữ liệu) mới:
    *   Nhấp vào biểu tượng **Create a new schema in the connected server** trên thanh công cụ.
    *   Nhập tên là: `duan1_quanao`.
    *   Nhấn **Apply** -> **Apply** -> **Finish**.
4.  Import dữ liệu:
    *   Vào menu **Server** -> **Data Import**.
    *   Chọn **Import from Self-Contained File**.
    *   Tìm và chọn đường dẫn đến file `duan1_quanao.sql` trong thư mục dự án này.
    *   Tại mục **Default Target Schema**, chọn `duan1_quanao` mà bạn vừa tạo.
    *   Nhấn **Start Import** ở góc dưới bên phải.
    *   Đợi quá trình chạy xong (Status: Import Completed).

## 3. Cấu Hình Kết Nối Cơ Sở Dữ Liệu

Kiểm tra thông tin kết nối trong file: `config/config.php`

```php
$dburl = "mysql:host=localhost;dbname=duan1_quanao;charset=utf8";
$username = 'root'; // Thay đổi nếu username MySQL của bạn khác
$password = 'root'; // Thay đổi nếu password MySQL của bạn khác
```

## 4. Cách Chạy Dự Án

1.  Copy toàn bộ thư mục `DUAN1_QUANAO` vào thư mục:
    *   XAMPP: `C:\xampp\htdocs\`
    *   WAMP: `C:\wamp64\www\`
2.  Mở bảng điều khiển **XAMPP Control Panel** và **Start** 2 dịch vụ: **Apache** và **MySQL**.
3.  Mở trình duyệt web và truy cập theo đường dẫn:
    `http://localhost/DUAN1_QUANAO/DUAN1_QUANAO/`

## 5. Tài Khoản Đăng Nhập (Mặc định)
*   **Admin**: `admin` / (Vui lòng kiểm tra lại mật khẩu hoặc reset nếu cần trong bảng `users`)
*   **Khách hàng**: `khoanguyen`

---
Chúc bạn thực hiện thành công!
