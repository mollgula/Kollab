<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'departmentName' => 'ITエキスパート学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'ITスペシャリスト学科'
        ];

        DB::table('departments')->insert($param);


        $param = [
            'departmentName' => '情報処理学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => '情報工学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => '情報ビジネス学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => '建築・インテリア'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'インダストリアルデザイン学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'グラフィックデザイン学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'エンターテイメントソフト学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'ゲームソフト学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => '3DCGアニメーション学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'デジタルアニメ学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => '声優タレント学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'サウンドクリエイト学科'
        ];

        DB::table('departments')->insert($param);

        $param = [
            'departmentName' => 'サウンドテクニック学科'
        ];

        DB::table('departments')->insert($param);

    }
}
