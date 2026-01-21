<?php
/**
 * Script download hình ảnh mẫu cho sản phẩm SportStore
 * Chạy: php download_images.php
 */

$products = [
    // Giày thể thao
    1 => ['name' => 'Nike Air Max 270', 'search' => 'nike+air+max+270'],
    2 => ['name' => 'Nike Air Force 1', 'search' => 'nike+air+force+1+white'],
    3 => ['name' => 'Adidas Ultraboost 22', 'search' => 'adidas+ultraboost+22'],
    4 => ['name' => 'Adidas Stan Smith', 'search' => 'adidas+stan+smith'],
    5 => ['name' => 'Puma RS-X', 'search' => 'puma+rs-x'],
    6 => ['name' => 'New Balance 574', 'search' => 'new+balance+574'],
    7 => ['name' => 'Asics Gel-Kayano 29', 'search' => 'asics+gel+kayano+29'],

    // Áo thể thao
    8 => ['name' => 'Ao Nike Dri-FIT', 'search' => 'nike+dri+fit+shirt'],
    9 => ['name' => 'Ao Adidas Climalite', 'search' => 'adidas+climalite+shirt'],
    10 => ['name' => 'Ao Under Armour Tech', 'search' => 'under+armour+tech+shirt'],
    11 => ['name' => 'Ao Puma Training', 'search' => 'puma+training+shirt'],
    12 => ['name' => 'Ao Nike Pro Compression', 'search' => 'nike+pro+compression'],
    13 => ['name' => 'Ao Nike Pro', 'search' => 'nike+pro+shirt'],

    // Quần thể thao
    14 => ['name' => 'Quan Nike Flex', 'search' => 'nike+flex+shorts'],
    15 => ['name' => 'Quan Adidas Tiro', 'search' => 'adidas+tiro+pants'],
    16 => ['name' => 'Quan Under Armour Sportstyle', 'search' => 'under+armour+jogger'],
    17 => ['name' => 'Quan Puma Essentials', 'search' => 'puma+essentials+shorts'],

    // Phụ kiện
    18 => ['name' => 'Balo Nike Brasilia', 'search' => 'nike+brasilia+backpack'],
    19 => ['name' => 'Tui deo Adidas Linear', 'search' => 'adidas+linear+bag'],
    20 => ['name' => 'Mu Nike Dri-FIT', 'search' => 'nike+dri+fit+cap'],
    21 => ['name' => 'Gang tay tap gym', 'search' => 'under+armour+gym+gloves'],

    // Dụng cụ gym
    22 => ['name' => 'Ta tay Nike', 'search' => 'dumbbell+5kg'],
    23 => ['name' => 'Day khang luc Adidas', 'search' => 'resistance+band+set'],
    24 => ['name' => 'Tham yoga Puma', 'search' => 'yoga+mat'],
    25 => ['name' => 'Bong tap Pilates', 'search' => 'pilates+ball+65cm'],

    // Đồ bơi
    26 => ['name' => 'Kinh boi Speedo', 'search' => 'speedo+swimming+goggles'],
    27 => ['name' => 'Mu boi Adidas', 'search' => 'adidas+swim+cap+silicone'],
];

$targetDir = __DIR__ . '/public/img/products/';

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

echo "=== SportStore Image Download Script ===\n\n";
echo "HUONG DAN:\n";
echo "1. Truy cap vao cac trang web sau de download hinh:\n";
echo "   - https://unsplash.com (hinh mien phi)\n";
echo "   - https://www.pexels.com (hinh mien phi)\n";
echo "   - Google Images\n\n";

echo "2. Dat ten file theo quy tac: sp{MaSP}_{so thu tu}.jpg\n";
echo "   Vi du: sp1_1.jpg, sp1_2.jpg\n\n";

echo "3. Copy hinh vao thu muc:\n";
echo "   $targetDir\n\n";

echo "=== DANH SACH SAN PHAM CAN HINH ===\n\n";

foreach ($products as $id => $product) {
    $file1 = $targetDir . "sp{$id}_1.jpg";
    $file2 = $targetDir . "sp{$id}_2.jpg";

    $status1 = file_exists($file1) ? "[CO]" : "[THIEU]";
    $status2 = file_exists($file2) ? "[CO]" : "[THIEU]";

    echo "SP $id: {$product['name']}\n";
    echo "   - sp{$id}_1.jpg $status1\n";
    echo "   - sp{$id}_2.jpg $status2\n";
    echo "   Tim kiem: https://unsplash.com/s/photos/{$product['search']}\n\n";
}

echo "=== PLACEHOLDER IMAGES ===\n";
echo "Tao hinh placeholder cho cac san pham chua co hinh...\n\n";

// Tạo hình placeholder đơn giản
foreach ($products as $id => $product) {
    for ($i = 1; $i <= 2; $i++) {
        $file = $targetDir . "sp{$id}_{$i}.jpg";
        if (!file_exists($file)) {
            // Tạo placeholder image
            $img = imagecreatetruecolor(400, 400);
            $bgColor = imagecolorallocate($img, 240, 240, 240);
            $textColor = imagecolorallocate($img, 100, 100, 100);
            imagefill($img, 0, 0, $bgColor);

            $text = "SP{$id}";
            $fontSize = 5;
            $textWidth = imagefontwidth($fontSize) * strlen($text);
            $textHeight = imagefontheight($fontSize);
            $x = (400 - $textWidth) / 2;
            $y = (400 - $textHeight) / 2;

            imagestring($img, $fontSize, $x, $y, $text, $textColor);
            imagejpeg($img, $file, 90);
            imagedestroy($img);

            echo "Da tao placeholder: sp{$id}_{$i}.jpg\n";
        }
    }
}

echo "\nHoan thanh! Hay thay the placeholder bang hinh that.\n";
