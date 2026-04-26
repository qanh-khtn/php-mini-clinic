# PHP Mini Clinic Appointment

Dự án mini thực hành PHP Lab02 với các phương thức HTTP quan trọng: GET, POST, HEAD, OPTIONS.
Ứng dụng mô phỏng hệ thống đăng ký lịch khám cơ bản, tập trung vào xử lý request/response đúng chuẩn status code và tổ chức cấu trúc dự án rõ ràng.

## Mục tiêu

- Xây dựng ứng dụng PHP theo kiến trúc tách lớp cơ bản (Controller, Data, Support, View).
- Hiển thị danh sách lịch khám và trạng thái còn chỗ/hết chỗ.
- Cung cấp API đăng ký lịch khám qua JSON.
- Trả về đúng mã trạng thái HTTP cho các tình huống thành công và.

## Sử dụng các thư viện

- PHP 8.x
- Composer (PSR-4 autoload)
- vlucas/phpdotenv (quản lý biến môi trường)
- Built-in PHP server (`php -S`)

## Cấu trúc chính

- `public/index.php`: bootstrap ứng dụng và router đơn giản.
- `src/Controllers`: xử lý logic cho home, appointments, registrations.
- `src/Data/appointments.php`: dữ liệu mẫu dạng mảng PHP.
- `src/Support`: helper đọc env và helper response JSON.
- `views/home.php`: giao diện trang chủ.
- `public/assets/home.css`: stylesheet cho giao diện mới.

## Hướng dẫn chạy

1. Cài dependencies:

```bash
composer install
composer dump-autoload
```

2. Tạo file môi trường (nếu chưa có):

```bash
copy .env.example .env
```

3. Chạy server local:

```bash
php -S localhost:8000 -t public
```

4. Truy cập:

- Trang chủ: http://localhost:8000/
- API base: http://localhost:8000/

## Danh sách endpoint

| Method | Endpoint | Mô tả |
|---|---|---|
| GET | `/` | Hiển thị trang chủ |
| GET | `/appointments` | Trả về danh sách lịch khám (JSON) |
| HEAD | `/appointments` | Trả header cho danh sách lịch khám |
| POST | `/registrations` | Đăng ký lịch khám bằng JSON |
| OPTIONS | `/registrations` | Trả về phương thức được hỗ trợ |
| GET | `/health` | Kiểm tra trạng thái ứng dụng |

## Ví dụ body hợp lệ cho POST /registrations

```json
{
  "appointment_id": 1,
  "patient_name": "Test User",
  "email": "test@example.com",
  "quantity": 1
}
```

## Các phần làm thêm

- Nâng cấp giao diện trang chủ theo kiểu hiện đại, dùng card layout và responsive mobile.
- Tách CSS ra file riêng `public/assets/home.css` để mã view gọn hơn.
- Bổ sung màu trạng thái rõ ràng cho `Open` và `Full`.
- Cải thiện validate dữ liệu ở API đăng ký:
  - Trước đây có thể phát sinh lỗi 500 khi dữ liệu sai kiểu.
  - Sau cải tiến, các trường hợp sai kiểu được trả về 422 đúng chuẩn nghiệp vụ.

## Kết quả kiểm thử sau khi cải tiến

| Method | Path | Expected | Actual |
|---|---|---|---|
| GET | `/` | 200 | 200 |
| GET | `/appointments` | 200 | 200 |
| HEAD | `/appointments` | 200 | 200 |
| PUT | `/appointments` | 405 | 405 |
| POST | `/registrations` (JSON hợp lệ) | 201 | 201 |
| POST | `/registrations` (text/plain) | 415 | 415 |
| POST | `/registrations` (thiếu patient_name) | 422 | 422 |
| POST | `/registrations` (sai kiểu dữ liệu) | 422 | 422 |
| POST | `/registrations` (appointment_id không tồn tại) | 422 | 422 |
| POST | `/registrations` (quantity vượt giới hạn) | 422 | 422 |
| OPTIONS | `/registrations` | 204 | 204 |
| GET | `/health` | 200 | 200 |
| GET | `/unknown` | 404 | 404 |

