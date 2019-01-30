<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'department_id' => 3,
            'courseName' => 'ITエンジニアコース',
        ];

        DB::table('courses')->insert($param);

        $param = [
            'department_id' => 3,
            'courseName' => 'Webエンジニアコース',
        ];

        DB::table('courses')->insert($param);

        $param = [
            'department_id' => 6,
            'courseName' => '建築デザインコース',
        ];

        DB::table('courses')->insert($param);

        $param = [
            'department_id' => 6,
            'courseName' => 'インテリアデザインコース',
        ];

        DB::table('courses')->insert($param);

        $param = [
            'department_id' => 8,
            'courseName' => 'グラフィック専攻',
        ];

        DB::table('courses')->insert($param);

        $param = [
            'department_id' => 8,
            'courseName' => 'Web専攻',
        ];

        DB::table('courses')->insert($param);


    }
}
