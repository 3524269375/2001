<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// use App\Models\BrandModel;
class UserBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //单条数据填充
		// DB::table('brand')->insert([
		// 'brand_name' => str::random(10),
		// 'brand_url' => str::random(10).'@gmail.com',
		// 'brand_logo' => 'http://img.2001.com/upload/Z1zzXi5nKRjMJuffATF0kNSO3Ch9KTAIOYnzxNJ1.jpeg',
		// 'brand_desc' => str::random(10),
        // 'created_at' => date('Y-m-d H:i:s'),
        // 'updated_at' => date('Y-m-d H:i:s'),
		// ]);
        //利用模型工厂进行多数据填充
        factory(App\Models\BrandModel::class, 10)->create()->make();

    }
}
