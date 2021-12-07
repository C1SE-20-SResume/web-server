<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobApply;

class JobApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobApply::factory(1)->create([
            'cv_file' => 'cv_uploads/NguyenNgocThanh_CV_Full_1635460356.pdf',
        ]);
        JobApply::factory(1)->create([
            'cv_file' => 'cv_uploads/1635641306617de7da348e1_NguyenNgocThanh_CV_Full.docx',
        ]);
        JobApply::factory(1)->create([
            'cv_file' => 'cv_uploads/16358412516180f4e33f2e8_Capture.png',
        ]);
        JobApply::factory(1)->create([
            'cv_file' => 'cv_uploads/163638370461893bd86c174_Capture.jpeg',
        ]);
    }
}
