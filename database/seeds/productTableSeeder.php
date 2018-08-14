<?php

use Illuminate\Database\Seeder;

class productTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(App\product::class,30)->create();
//
//        $p1=[
//                'name' => 'learn',
//                'image' => 'uploads/products/insta.jpg',
//                'price' => 5000,
//                'description' => 'barang bagus'
//        ];
//
//        $p2=[
//            'name' => 'something',
//            'image' => 'uploads/products/job.jpg.jpg',
//            'price' => 6000,
//            'description' => 'barang bagus'
//        ];
//
//        \App\product::create($p1);
//        \App\product::create($p2);
    }
}
