<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productA = Product::where('name', 'キウイ')->first();
        $productB = Product::where('name', 'ストロベリー')->first();
        $productC = Product::where('name', 'オレンジ')->first();
        $productD = Product::where('name', 'スイカ')->first();
        $productE = Product::where('name', 'ピーチ')->first();
        $productF = Product::where('name', 'シャインマスカット')->first();
        $productG = Product::where('name', 'パイナップル')->first();
        $productH = Product::where('name', 'ブドウ')->first();
        $productI = Product::where('name', 'バナナ')->first();
        $productJ = Product::where('name', 'メロン')->first();


        $spring = Season::where('name', '春')->first();
        $summer = Season::where('name', '夏')->first();
        $autumn = Season::where('name', '秋')->first();
        $winter = Season::where('name', '冬')->first();

        // Product A を 秋、冬 に関連付け あとは同様に設定する
        $productA->seasons()->attach([$autumn->id, $winter->id]);
        $productB->seasons()->attach([$spring->id]);
        $productC->seasons()->attach([$winter->id]);
        $productD->seasons()->attach([$summer->id]);
        $productE->seasons()->attach([$summer->id]);
        $productF->seasons()->attach([$summer->id, $autumn->id]);
        $productG->seasons()->attach([$spring->id, $summer->id]);
        $productH->seasons()->attach([$summer->id, $autumn->id]);
        $productI->seasons()->attach([$autumn->id]);
        $productJ->seasons()->attach([$spring->id, $summer->id]);
    }
}
