<!-- Test Checklist cho chức năng Blog -->
<!-- Sau khi chạy migration và nhập liệu, kiểm tra các điểm sau: -->

## ✅ TEST CHECKLIST - Blog Feature

### Backend Tests

- [ ] **1. Create BaiViet (POST /admin/bai-viet/store)**
  - Nhập tiêu đề
  - Nhập nội dung
  - Upload hình ảnh
  - Chọn trạng thái
  - Verify: File lưu ở `/public/uploads/blog/`, DB lưu đường dẫn đúng

- [ ] **2. Update BaiViet (PUT /admin/bai-viet/update/{id})**
  - Edit tiêu đề
  - Change hình ảnh
  - Verify: Hình cũ xóa, hình mới lưu, DB update

- [ ] **3. List BaiViet (GET /admin/bai-viet)**
  - Verify: 2 tabs (Đang sử dụng, Đã xóa)
  - Verify: Phân trang hoạt động
  - Verify: Tìm kiếm hoạt động
  - Verify: Sắp xếp theo Mới nhất/Cũ nhất

- [ ] **4. Delete BaiViet (DELETE /admin/bai-viet/{id})**
  - Click Xóa
  - Verify: Chuyển sang tab "Đã xóa" (IsDeleted = true)

- [ ] **5. Restore BaiViet (POST /admin/bai-viet/restore/{id})**
  - Click Khôi phục từ tab Đã xóa
  - Verify: Quay lại tab "Đang sử dụng"

### Frontend Tests

- [ ] **6. Blog Index Page (GET /blog)**
  - Verify: Hiển thị bài công khai dưới dạng card grid
  - Verify: Hình ảnh hiển thị đúng
  - Verify: Tiêu đề, tóm tắt, ngày tạo, tác giả hiển thị
  - Verify: Tìm kiếm hoạt động
  - Verify: Phân trang 9 bài/trang

- [ ] **7. Blog Detail Page (GET /blog/{slug})**
  - Verify: Breadcrumb hiển thị đúng
  - Verify: Hình ảnh full width hiển thị
  - Verify: Nội dung hiển thị đầy đủ (HTML được render)
  - Verify: Ngày, tác giả, tag hiển thị
  - Verify: Bài viết liên quan (2 bài) hiển thị

- [ ] **8. Sidebar - Bài Viết Mới Nhất**
  - Verify: Hiển thị 5 bài mới nhất
  - Verify: Link hoạt động

- [ ] **9. Share Buttons**
  - Verify: Facebook share link hoạt động
  - Verify: Twitter share link hoạt động
  - Verify: Copy link button hoạt động

### Security Tests

- [ ] **10. Chỉ admin có thể access /admin/bai-viet**
  - Test: Không login → redirect tới login page

- [ ] **11. Chỉ hiển thị bài công khai trên frontend**
  - Tạo bài với TrangThai = 0 (Draft)
  - Verify: Không hiển thị ở /blog
  - Verify: URL trực tiếp cũng không hiển thị

- [ ] **12. Bài đã xóa không hiển thị trên frontend**
  - Xóa 1 bài
  - Verify: Không hiển thị ở /blog

### Edge Cases

- [ ] **13. Bài viết không có hình ảnh**
  - Tạo bài mà không upload hình
  - Verify: Hiển thị placeholder icon thay vì lỗi 404

- [ ] **14. Hình ảnh > 2MB**
  - Upload hình > 2MB
  - Verify: Hiển thị lỗi validation

- [ ] **15. Slug unique**
  - Tạo 2 bài cùng tiêu đề
  - Verify: Slug khác nhau (do timestamp)

- [ ] **16. Tìm kiếm toàn văn**
  - Tạo bài với từ khóa ở tiêu đề, nội dung, tóm tắt
  - Verify: Tìm kiếm hoạt động trên cả 3 field

---

## 📋 Công Cụ Test

### Postman/Curl

```bash
# Get all bai viet
curl -X GET http://localhost:8000/admin/bai-viet

# Create bai viet
curl -X POST http://localhost:8000/admin/bai-viet/store \
  -F "TieuDe=Test" \
  -F "NoiDung=Test content" \
  -F "HinhAnh=@/path/to/image.jpg" \
  -F "TrangThai=1"

# Frontend
curl -X GET http://localhost:8000/blog
curl -X GET http://localhost:8000/blog/test-slug
```

### Database Queries

```sql
-- Check bai viet
SELECT * FROM BaiViet WHERE IsDeleted = 0;

-- Check hình ảnh
SELECT HinhAnh FROM BaiViet;

-- Check soft deleted
SELECT * FROM BaiViet WHERE IsDeleted = 1;
```

