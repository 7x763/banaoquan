# Hướng Dẫn Cài Đặt và Chạy Dự Án 


*   **MySQL Workbench**  để quản lý cơ sở dữ liệu.
*   Trình duyệt web 

 Hướng Dẫn Import CSDL vào MySQL Workbench

Để đưa dữ liệu từ file `.sql` vào MySQL, làm theo các bước sau:

1.  Mở **MySQL Workbench**.
2.  Kết nối vào Local Instance  (thường là `localhost`).
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

 Các Lệnh PHP Để Chạy Dự Án

Mở Terminal (PowerShell hoặc CMD) tại thư mục `DUAN1_QUANAO\DUAN1_QUANAO` và chạy các lệnh sau:

**Bước 1: Kiểm tra PHP đã được cài đặt chưa**
```powershell
php -v
```

**Bước 2: Khởi động server**
Lệnh này sẽ chạy server tại cổng 8000. thay đổi số cổng nếu muốn.
```powershell
php -S localhost:8000
```

**Lệnh nâng cao (Nếu muốn chạy cổng khác):**
```powershell
php -S localhost:8080
```

**Bước 3: Truy cập web**
Sau khi chạy lệnh trên, đừng tắt cửa sổ Terminal. Hãy mở trình duyệt và nhập:
`http://localhost:8000`

---

Để dừng Server:** Nhấn `Ctrl + C` trong cửa sổ Terminal.






