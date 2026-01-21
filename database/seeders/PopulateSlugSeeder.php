<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Support\Str;

class PopulateSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Populate slug for SanPham
        $sanPhams = SanPham::whereNull('slug')->get();
        foreach ($sanPhams as $sp) {
            $sp->slug = Str::slug($sp->TenSP);
            // Ensure slug is unique
            $counter = 1;
            $originalSlug = $sp->slug;
            while (SanPham::where('slug', $sp->slug)->where('MaSP', '!=', $sp->MaSP)->exists()) {
                $sp->slug = $originalSlug . '-' . $counter++;
            }
            $sp->save();
        }

        // Populate slug for DanhMuc
        $danhMucs = DanhMuc::whereNull('slug')->get();
        foreach ($danhMucs as $dm) {
            $dm->slug = Str::slug($dm->TenDM);
            // Ensure slug is unique
            $counter = 1;
            $originalSlug = $dm->slug;
            while (DanhMuc::where('slug', $dm->slug)->where('MaDM', '!=', $dm->MaDM)->exists()) {
                $dm->slug = $originalSlug . '-' . $counter++;
            }
            $dm->save();
        }

        $this->command->info('Slug population completed successfully!');
    }
}
