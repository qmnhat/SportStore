<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // De tao dung thu tu va FK khong bi loi
        Schema::disableForeignKeyConstraints();

        // 1) DanhMuc
        Schema::create('DanhMuc', function (Blueprint $table) {
            $table->increments('MaDM');
            $table->string('TenDM', 100);
            $table->longText('MoTa')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();
        });

        // 2) ThuongHieu
        Schema::create('ThuongHieu', function (Blueprint $table) {
            $table->increments('MaTH');
            $table->string('TenTH', 100);
            $table->longText('MoTa')->nullable();
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();
        });

        // 3) SanPham
        Schema::create('SanPham', function (Blueprint $table) {
            $table->increments('MaSP');
            $table->string('TenSP', 200);
            $table->unsignedInteger('MaDM');
            $table->unsignedInteger('MaTH');
            $table->longText('MoTa')->nullable();
            $table->unsignedTinyInteger('TrangThai')->default(1);
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            $table->foreign('MaDM')->references('MaDM')->on('DanhMuc');
            $table->foreign('MaTH')->references('MaTH')->on('ThuongHieu');
        });

        // 4) KichThuoc
        Schema::create('KichThuoc', function (Blueprint $table) {
            $table->increments('MaKT');
            $table->string('TenKT', 20); // S, M, L, XL, 40, 41, 42...
        });

        // 5) BienTheSanPham
        Schema::create('BienTheSanPham', function (Blueprint $table) {
            $table->increments('MaBT');
            $table->unsignedInteger('MaSP');
            $table->unsignedInteger('MaKT');
            $table->decimal('GiaGoc', 12, 2);
            $table->integer('SoLuong');
            $table->unsignedTinyInteger('TrangThai')->default(1);

            $table->foreign('MaSP')->references('MaSP')->on('SanPham');
            $table->foreign('MaKT')->references('MaKT')->on('KichThuoc');

            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            $table->unique(['MaSP', 'MaKT']); // UNIQUE (MaSP, MaKT)
        });

        // 6) HinhAnhSanPham
        Schema::create('HinhAnhSanPham', function (Blueprint $table) {
            $table->increments('MaHinh');
            $table->unsignedInteger('MaSP')->nullable(); // file ghi MaSP INT (khong NOT NULL)
            $table->string('DuongDan', 255);

            $table->foreign('MaSP')->references('MaSP')->on('SanPham');
        });

        // 7) KhachHang
        Schema::create('KhachHang', function (Blueprint $table) {
            $table->increments('MaKH');
            $table->string('HoTen', 120);
            $table->string('Email', 150)->unique();
            $table->string('MatKhau', 255);
            $table->string('DiaChi', 255)->nullable();
            $table->string('SDT', 15)->nullable();
            $table->date('NgaySinh')->nullable();
            $table->unsignedTinyInteger('TrangThai')->default(1); // 1: Active, 0: Block
            $table->dateTime('NgayTao')->useCurrent();
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();
        });

        // 8) KhuyenMai
        Schema::create('KhuyenMai', function (Blueprint $table) {
            $table->increments('MaKM');
            $table->string('TenKM', 150);
            $table->integer('PhanTramGiam');
            $table->date('NgayBatDau');
            $table->date('NgayKetThuc');
            $table->unsignedTinyInteger('TrangThai')->default(1);
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();
        });

        // 9) SanPhamKhuyenMai (pivot)
        Schema::create('SanPhamKhuyenMai', function (Blueprint $table) {
            $table->unsignedInteger('MaSP');
            $table->unsignedInteger('MaKM');

            $table->primary(['MaSP', 'MaKM']);

            $table->foreign('MaSP')->references('MaSP')->on('SanPham');
            $table->foreign('MaKM')->references('MaKM')->on('KhuyenMai');
        });

        // 10) DonHang
        Schema::create('DonHang', function (Blueprint $table) {
            $table->increments('MaDH');
            $table->unsignedInteger('MaKH');
            $table->dateTime('NgayDat')->useCurrent();
            $table->integer('TrangThai'); // vi du: 0-Cho xac nhan, 1-Dang giao, 2-Hoan thanh, 3-Huy
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            $table->foreign('MaKH')->references('MaKH')->on('KhachHang');
        });

        // 11) ChiTietDonHang (pivot)
        Schema::create('ChiTietDonHang', function (Blueprint $table) {
            $table->unsignedInteger('MaDH');
            $table->unsignedInteger('MaBT');
            $table->integer('SoLuong');

            $table->primary(['MaDH', 'MaBT']);

            $table->foreign('MaDH')->references('MaDH')->on('DonHang');
            $table->foreign('MaBT')->references('MaBT')->on('BienTheSanPham');
        });

        // 12) HoaDon
        Schema::create('HoaDon', function (Blueprint $table) {
            $table->increments('MaHD');
            $table->unsignedInteger('MaDH');
            $table->dateTime('NgayLap')->useCurrent();
            $table->decimal('TongTien', 12, 2);
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            $table->foreign('MaDH')->references('MaDH')->on('DonHang');
        });

        // 13) ChiTietHoaDon (pivot)
        Schema::create('ChiTietHoaDon', function (Blueprint $table) {
            $table->unsignedInteger('MaHD');
            $table->unsignedInteger('MaBT');
            $table->integer('SoLuong');
            $table->decimal('DonGia', 12, 2);

            $table->primary(['MaHD', 'MaBT']);

            $table->foreign('MaHD')->references('MaHD')->on('HoaDon');
            $table->foreign('MaBT')->references('MaBT')->on('BienTheSanPham');
        });

        // 14) GioHang
        Schema::create('GioHang', function (Blueprint $table) {
            $table->increments('MaGH');
            $table->unsignedInteger('MaKH');
            $table->dateTime('NgayTao')->useCurrent();

            $table->foreign('MaKH')->references('MaKH')->on('KhachHang');
            $table->unique('MaKH'); // moi khach 1 gio
        });

        // 15) ChiTietGioHang (pivot)
        Schema::create('ChiTietGioHang', function (Blueprint $table) {
            $table->unsignedInteger('MaGH');
            $table->unsignedInteger('MaBT'); // bien the: san pham + size
            $table->integer('SoLuong');

            $table->primary(['MaGH', 'MaBT']);

            $table->foreign('MaGH')->references('MaGH')->on('GioHang');
            $table->foreign('MaBT')->references('MaBT')->on('BienTheSanPham');
        });

        // 16) DanhGia
        Schema::create('DanhGia', function (Blueprint $table) {
            $table->increments('MaDG');
            $table->unsignedInteger('MaKH');
            $table->unsignedInteger('MaSP');
            $table->integer('SoSao'); // CHECK (SoSao BETWEEN 1 AND 5)
            $table->longText('NoiDung')->nullable();
            $table->dateTime('NgayDanhGia')->useCurrent();

            $table->foreign('MaKH')->references('MaKH')->on('KhachHang');
            $table->foreign('MaSP')->references('MaSP')->on('SanPham');

            $table->unique(['MaKH', 'MaSP']); // moi khach chi danh gia 1 lan / 1 san pham
        });


        // 17) NhaQuanLy
        Schema::create('NhaQuanLy', function (Blueprint $table) {
            $table->increments('MaQL');
            $table->string('HoTen', 120);
            $table->string('Email', 150)->unique();
            $table->string('MatKhau', 255);
            $table->string('DiaChi', 255)->nullable();
            $table->string('SDT', 15)->nullable();
            $table->date('NgaySinh')->nullable();
            $table->unsignedTinyInteger('VaiTro'); // 1: Admin-- 2: Quan ly
            $table->unsignedTinyInteger('TrangThai')->default(1); // 1: Hoat dong, 0: Khoa
            $table->dateTime('NgayTao')->useCurrent();
        });

        // 18) NhaCungCap  (tao truoc PhieuNhap de FK khong loi)
        Schema::create('NhaCungCap', function (Blueprint $table) {
            $table->increments('MaNCC');
            $table->string('TenNCC', 200);
            $table->string('DiaChi', 255)->nullable();
            $table->string('SDT', 15)->nullable();
            $table->string('Email', 150)->nullable();
            $table->unsignedTinyInteger('TrangThai')->default(1); // 1: Hoat dong | 0: Ngung
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();
            $table->dateTime('NgayTao')->useCurrent();
        });

        // 19) PhieuNhap
        Schema::create('PhieuNhap', function (Blueprint $table) {
            $table->increments('MaPN');
            $table->unsignedInteger('MaQL');  // nguoi tao/duyet
            $table->unsignedInteger('MaNCC'); // nha cung cap
            $table->dateTime('NgayNhap')->useCurrent();
            $table->string('GhiChu', 255)->nullable();
            $table->unsignedTinyInteger('TrangThai')->default(0); // 0: Cho duyet | 1: Da duyet | 2: Huy
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            $table->foreign('MaQL')->references('MaQL')->on('NhaQuanLy');
            $table->foreign('MaNCC')->references('MaNCC')->on('NhaCungCap');
        });

        // 20) ChiTietPhieuNhap (pivot)
        Schema::create('ChiTietPhieuNhap', function (Blueprint $table) {
            $table->unsignedInteger('MaPN');
            $table->unsignedInteger('MaBT');
            $table->integer('SoLuong');
            $table->decimal('GiaNhap', 12, 2);

            $table->primary(['MaPN', 'MaBT']);

            $table->foreign('MaPN')->references('MaPN')->on('PhieuNhap');
            $table->foreign('MaBT')->references('MaBT')->on('BienTheSanPham');
        });

        // 21) PhieuXuat
        Schema::create('PhieuXuat', function (Blueprint $table) {
            $table->increments('MaPX');
            $table->unsignedInteger('MaDH');
            $table->unsignedInteger('MaQL');
            $table->dateTime('NgayXuat')->useCurrent();
            $table->unsignedTinyInteger('TrangThai')->default(0); // 0: Cho duyet | 1: Da duyet | 2: Huy
            $table->boolean('IsDeleted')->default(false);
            $table->dateTime('DeletedAt')->nullable();

            // 0: Chờ duyệt | 1: Đã duyệt | 2: Hủy
            $table->foreign('MaDH')->references('MaDH')->on('DonHang');
            $table->foreign('MaQL')->references('MaQL')->on('NhaQuanLy');
        });

        // 22) ChiTietPhieuXuat (pivot)
        Schema::create('ChiTietPhieuXuat', function (Blueprint $table) {
            $table->unsignedInteger('MaPX');
            $table->unsignedInteger('MaBT');
            $table->integer('SoLuong');

            $table->primary(['MaPX', 'MaBT']);

            $table->foreign('MaPX')->references('MaPX')->on('PhieuXuat');
            $table->foreign('MaBT')->references('MaBT')->on('BienTheSanPham');
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        // Drop theo thu tu nguoc FK
        Schema::dropIfExists('ChiTietPhieuXuat');
        Schema::dropIfExists('PhieuXuat');

        Schema::dropIfExists('ChiTietPhieuNhap');
        Schema::dropIfExists('PhieuNhap');

        Schema::dropIfExists('NhaCungCap');
        Schema::dropIfExists('NhaQuanLy');

        Schema::dropIfExists('DanhGia');
        Schema::dropIfExists('ChiTietGioHang');
        Schema::dropIfExists('GioHang');

        Schema::dropIfExists('ChiTietHoaDon');
        Schema::dropIfExists('HoaDon');

        Schema::dropIfExists('ChiTietDonHang');
        Schema::dropIfExists('DonHang');

        Schema::dropIfExists('SanPhamKhuyenMai');
        Schema::dropIfExists('KhuyenMai');

        Schema::dropIfExists('KhachHang');

        Schema::dropIfExists('HinhAnhSanPham');
        Schema::dropIfExists('BienTheSanPham');
        Schema::dropIfExists('KichThuoc');
        Schema::dropIfExists('SanPham');
        Schema::dropIfExists('ThuongHieu');
        Schema::dropIfExists('DanhMuc');

        Schema::enableForeignKeyConstraints();
    }
};
