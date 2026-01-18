# 📐 KIẾN TRÚC FRONTEND BLOG

## 🌳 Sơ Đồ Routing

```
http://localhost:8000/
├── /blog                          (BaiVietController@index)
│   └── Danh sách bài viết (9 bài/trang)
│       ├── Tìm kiếm
│       ├── Phân trang
│       └── Card grid 3 cột
│
└── /blog/{slug}                   (BaiVietController@show)
    └── Chi tiết bài viết
        ├── Breadcrumb
        ├── Nội dung full
        ├── Chia sẻ
        ├── Bài liên quan
        └── Sidebar
            ├── Tìm kiếm
            └── 5 bài mới nhất
```

---

## 📄 Component Structure

### **View: pages/bai-viet/index.blade.php**

```html
┌─────────────────────────────────────────────────────────┐
│  @extends('layouts.app')                                │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  ┌─────────────────────────────────────────────────────┐│
│  │ Section Title: "Blog & Tin Tức"                   ││
│  └─────────────────────────────────────────────────────┘│
│                                                          │
│  ┌─────────────────────────────────────────────────────┐│
│  │ Search Form                                         ││
│  │ ┌──────────────────────────────┐ ┌────────┐        ││
│  │ │ Tìm bài viết...             │ │ Tìm    │        ││
│  │ └──────────────────────────────┘ └────────┘        ││
│  └─────────────────────────────────────────────────────┘│
│                                                          │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐              │
│  │  Card 1  │  │  Card 2  │  │  Card 3  │              │
│  │ [Image]  │  │ [Image]  │  │ [Image]  │              │
│  │ Tiêu đề  │  │ Tiêu đề  │  │ Tiêu đề  │              │
│  │ Tóm tắt  │  │ Tóm tắt  │  │ Tóm tắt  │              │
│  │ 📅 Ngày  │  │ 📅 Ngày  │  │ 📅 Ngày  │              │
│  │ 👤 Tác g │  │ 👤 Tác g │  │ 👤 Tác g │              │
│  │ [Xem]    │  │ [Xem]    │  │ [Xem]    │              │
│  └──────────┘  └──────────┘  └──────────┘              │
│                                                          │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐              │
│  │  Card 4  │  │  Card 5  │  │  Card 6  │              │
│  │ ...      │  │ ...      │  │ ...      │              │
│  └──────────┘  └──────────┘  └──────────┘              │
│                                                          │
│  [◀ Trang trước] [1] [2] [3] [Trang sau ▶]             │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

**Key Components:**
```
Card Structure:
┌─────────────────────┐
│  card-img-top       │ (250px height, object-fit: cover)
│  ┌─────────────────┐│
│  │ card-body       ││
│  │ ┌─────────────┐││
│  │ │ card-title  │││ (Tiêu đề - 60 chars max)
│  │ └─────────────┘││
│  │ ┌─────────────┐││
│  │ │ card-text   │││ (Tóm tắt - 100 chars max)
│  │ │ text-muted  │││
│  │ └─────────────┘││
│  │ ┌─────────────┐││
│  │ │ post-meta   │││ (Ngày + Tác giả)
│  │ └─────────────┘││
│  │ ┌─────────────┐││
│  │ │ [Xem Chi    │││ (Button - mt-auto)
│  │ │  Tiết]      │││
│  │ └─────────────┘││
│  └─────────────────┘│
└─────────────────────┘
```

---

### **View: pages/bai-viet/show.blade.php**

```html
┌──────────────────────────────────────────────────────────────┐
│  @extends('layouts.app')                                     │
├──────────────────────────────────────────────────────────────┤
│                                                               │
│  Breadcrumb: Trang chủ > Blog > Bài viết X                  │
│                                                               │
│  ┌─────────────────────────────────────────────────────────┐ │
│  │ [IMAGE FULL WIDTH - 500px height, object-fit: cover]   │ │
│  └─────────────────────────────────────────────────────────┘ │
│                                                               │
│  ┌──────────────────────────────┬──────────────────────────┐ │
│  │ MAIN CONTENT (col-md-8)      │ SIDEBAR (col-md-4)       │ │
│  ├──────────────────────────────┼──────────────────────────┤ │
│  │                              │ ┌────────────────────────┤ │
│  │ H1: TIÊU ĐỀ BÀI VIẾT        │ │ Search Card            │ │
│  │                              │ │ ┌──────────────────┐   │ │
│  │ META:                        │ │ │ 🔍 Tìm kiếm      │   │ │
│  │ 📅 Ngày | 👤 Tác giả | 🏷️ Tag│ │ └──────────────────┘   │ │
│  │ ─────────────────────────    │ └────────────────────────┤ │
│  │                              │ ┌────────────────────────┤ │
│  │ <HTML CONTENT>               │ │ Latest Posts (5)       │ │
│  │ - Paragraphs                 │ │ ┌────────────────────┐ │ │
│  │ - Headings                   │ │ │ • Post Title 1    │ │ │
│  │ - Images (max-width: 100%)   │ │ │   Date            │ │ │
│  │ - Lists                      │ │ └────────────────────┘ │ │
│  │ - Tables                     │ │ ┌────────────────────┐ │ │
│  │                              │ │ │ • Post Title 2    │ │ │
│  │ ─────────────────────────    │ │ │   Date            │ │ │
│  │                              │ │ └────────────────────┘ │ │
│  │ SHARE BUTTONS:               │ │ ... (5 total)          │ │
│  │ [🔵 Facebook] [🐦 Twitter]   │ │                        │ │
│  │ [🔗 Copy Link]               │ │                        │ │
│  │                              │ └────────────────────────┤ │
│  │ ─────────────────────────    │                          │ │
│  │                              │                          │ │
│  │ RELATED POSTS (2):           │                          │ │
│  │ ┌──────────┐  ┌──────────┐   │                          │ │
│  │ │Card 1    │  │Card 2    │   │                          │ │
│  │ │[Image]   │  │[Image]   │   │                          │ │
│  │ │Title     │  │Title     │   │                          │ │
│  │ │Date      │  │Date      │   │                          │ │
│  │ │[Xem]     │  │[Xem]     │   │                          │ │
│  │ └──────────┘  └──────────┘   │                          │ │
│  │                              │                          │ │
│  │ [⬅️ Quay lại]                │                          │ │
│  │                              │                          │ │
│  └──────────────────────────────┴──────────────────────────┘ │
│                                                               │
└──────────────────────────────────────────────────────────────┘
```

---

## 🎨 CSS Classes & Styling

### **Colors & Typography**

```css
/* Text Colors */
.text-dark         /* #333 - tiêu đề */
.text-muted        /* #666 - ngày, tác giả */
.text-decoration-none

/* Backgrounds */
.bg-light          /* #f8f9fa - placeholder hình */

/* Cards */
.card              /* white background, shadow */
.shadow-sm         /* subtle shadow */
.hover-shadow      /* transform: translateY(-3px) */

/* Buttons */
.btn-primary       /* #007bff - chính */
.btn-outline-primary /* border only */
.btn-secondary     /* #6c757d - phụ */
.btn-sm            /* 0.375rem padding */

/* Borders */
.border-bottom     /* bottom border */
.rounded           /* border-radius: 0.25rem */

/* Spacing */
.mb-3, .mb-4, .mb-5  /* margin-bottom */
.mt-auto             /* margin-top: auto */
.gap-2               /* flex gap */

/* Layout */
.row               /* flexbox row */
.col-md-6          /* 50% width on medium+ */
.col-md-8          /* 66% width on medium+ */
.col-lg-4          /* 33% width on large+ */
.d-flex            /* display: flex */
.flex-grow-1       /* flex-grow: 1 */
```

### **Custom Styles**

```css
.section-title h2 {
    position: relative;
    font-weight: 700;
    color: #333;
}

.section-title h2::after {
    content: '';
    width: 60px;
    height: 3px;
    background-color: #007bff;
    /* Positioned below title */
}

.hover-shadow {
    transition: all 0.3s ease;
    box-shadow: 0.5rem 1rem rgba(0,0,0,0.15);
}

.hover-shadow:hover {
    transform: translateY(-3px);
}

.post-content {
    line-height: 1.8;
    font-size: 1rem;
}

.post-content img {
    max-width: 100%;
    margin: 20px 0;
}
```

---

## 🔗 Links & Routes

| Route | Controller | Method | Description |
|-------|-----------|--------|-------------|
| `/blog` | BaiVietController | index | List all public posts |
| `/blog/{slug}` | BaiVietController | show | Show single post |
| `/blog?q=keyword` | BaiVietController | index | Search posts |
| `/admin/bai-viet` | AdminBaiVietController | index | Manage posts (admin) |
| `/admin/bai-viet/create` | AdminBaiVietController | create | Create form |
| `/admin/bai-viet/store` | AdminBaiVietController | store | Save new post |
| `/admin/bai-viet/edit/{id}` | AdminBaiVietController | edit | Edit form |
| `/admin/bai-viet/update/{id}` | AdminBaiVietController | update | Save changes |
| `/admin/bai-viet/destroy/{id}` | AdminBaiVietController | destroy | Soft delete |
| `/admin/bai-viet/restore/{id}` | AdminBaiVietController | restore | Restore deleted |

---

## 📱 Responsive Design

### **Breakpoints**

```
xs (< 576px)       1 column
sm (≥ 576px)       1 column
md (≥ 768px)       2 columns (sidebar appears)
lg (≥ 992px)       3 columns (blog grid)
xl (≥ 1200px)      3 columns
xxl (≥ 1400px)     3 columns
```

### **Grid Breakdown**

```
HOMEPAGE: pages/bai-viet/index.blade.php
xs/sm: 1 column (full-width cards)
md/lg/xl: 3 columns (col-lg-4)

DETAIL PAGE: pages/bai-viet/show.blade.php
xs/sm: 1 column (full-width content)
md+: 2 columns (col-md-8 + col-md-4 sidebar)
```

---

## 🖼️ Image Handling

### **Upload Path Structure**

```
public/
├── uploads/
│   └── blog/
│       ├── 1705571600.jpg          (timestamp.ext format)
│       ├── 1705571601.png
│       └── 1705571602.gif
```

### **Image Display**

```blade
<!-- Check if image exists before showing -->
@if($baiViet->HinhAnh && file_exists(public_path($baiViet->HinhAnh)))
    <img src="{{ asset($baiViet->HinhAnh) }}" alt="...">
@else
    <div class="placeholder">
        <i class="bi bi-image"></i>
    </div>
@endif
```

### **Image Optimization**

```css
/* Index page cards */
img.card-img-top {
    height: 250px;
    object-fit: cover;  /* Maintain aspect ratio */
}

/* Detail page main image */
img (detail) {
    max-width: 100%;
    max-height: 500px;
    object-fit: cover;
}

/* Sidebar related images */
img (related) {
    height: 200px;
    object-fit: cover;
}
```

---

## 💾 Data Flow

### **Index Page**

```
GET /blog?q=keyword&page=1

    ↓
    
BaiVietController@index
  ├─ Query: SELECT * FROM BaiViet WHERE TrangThai=1 AND IsDeleted=0
  ├─ Search: LIKE %keyword%
  ├─ Order by: NgayTao DESC
  ├─ Paginate: 9 per page
  └─ Return: $baiviet (Collection)

    ↓
    
views/pages/bai-viet/index.blade.php
  ├─ @foreach($baiviet as $post)
  ├─ Display card with:
  │   ├─ HinhAnh (or placeholder)
  │   ├─ TieuDe (truncated 60 chars)
  │   ├─ TomTat (truncated 100 chars)
  │   ├─ NgayTao (format d/m/Y)
  │   ├─ author.name
  │   └─ Link to show page
  └─ Paginate links
```

### **Detail Page**

```
GET /blog/my-post-slug-1705571600

    ↓
    
BaiVietController@show($slug)
  ├─ Query: SELECT * FROM BaiViet WHERE slug=? AND TrangThai=1 AND IsDeleted=0
  ├─ Get related (2 posts by same author)
  ├─ Get latest (5 newest posts)
  └─ Return: $baiViet, $relatedPosts, $latestPosts

    ↓
    
views/pages/bai-viet/show.blade.php
  ├─ Display:
  │   ├─ Breadcrumb
  │   ├─ HinhAnh (full-width)
  │   ├─ TieuDe (H1)
  │   ├─ Meta info
  │   ├─ NoiDung (HTML rendered with {!! !!})
  │   ├─ Share buttons
  │   ├─ Related posts
  │   └─ Sidebar
  │       ├─ Search form
  │       └─ Latest posts list
  └─ Return: HTML page
```

---

## 🔍 SEO Considerations

```blade
<!-- Meta Tags (in layout.app) -->
<title>{{ $pageTitle ?? 'Blog - Tin tức' }}</title>
<meta name="description" content="{{ $pageDescription }}">

<!-- Index Page -->
<title>Blog - Tin tức và bài viết - {{ config('app.name') }}</title>

<!-- Detail Page -->
<title>{{ $baiViet->TieuDe }} - Blog - {{ config('app.name') }}</title>
```

---

## 📊 Performance Notes

- **Images**: Lazy loading recommended (add `loading="lazy"`)
- **Pagination**: 9 items/page balances load vs scroll
- **Caching**: Consider caching latest posts in detail page
- **Search**: Currently using LIKE (ok for < 10k posts, use fulltext after)
- **N+1 Prevention**: Using `with(['author'])` for eager loading

---

## 🧪 Testing URLs

```bash
# Index page
http://localhost:8000/blog

# Search
http://localhost:8000/blog?q=laravel

# Pagination
http://localhost:8000/blog?page=2

# Detail page
http://localhost:8000/blog/test-post-slug-1705571600

# Admin
http://localhost:8000/admin/bai-viet
http://localhost:8000/admin/bai-viet/create
```

