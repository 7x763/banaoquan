# Hướng Dẫn Cài Đặt và Chạy Dự Án 


*   **MySQL Workbench** (Hoặc phpMyAdmin) để quản lý cơ sở dữ liệu.
*   Trình duyệt web (Chrome, Edge, Firefox, etc.).

 Hướng Dẫn Import CSDL vào MySQL Workbench

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

 Cấu Hình Kết Nối Cơ Sở Dữ Liệu

Kiểm tra thông tin kết nối trong file: `config/config.php`

```php
$dburl = "mysql:host=localhost;dbname=duan1_quanao;charset=utf8";
$username = 'root'; // Thay đổi nếu username MySQL của bạn khác
$password = 'root'; // Thay đổi nếu password MySQL của bạn khác
```

## 4. Cách Chạy Dự Án (Không cần XAMPP)

Bạn có thể chạy dự án trực tiếp bằng PHP Built-in Server (có sẵn khi cài PHP):

1.  Mở Terminal hoặc Command Prompt tại thư mục của dự án (`DUAN1_QUANAO/DUAN1_QUANAO`).
2.  Đảm bảo bạn đã cài đặt PHP và đã thêm vào biến môi trường (Environment Variables). Kiểm tra bằng lệnh: `php -v`.
3.  Chạy lệnh sau để khởi động server:
    ```bash
    php -S localhost:8000
    ```
4.  Mở trình duyệt web và truy cập theo đường dẫn:
    `http://localhost:8000`

**Lưu ý:** Bạn vẫn cần một dịch vụ MySQL đang chạy (có thể cài đặt MySQL độc lập hoặc dùng Laragon) để cơ sở dữ liệu hoạt động.



