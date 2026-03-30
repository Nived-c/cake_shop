<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Categories
        $categories = [
            ['name' => 'Signature Cakes', 'slug' => 'signature-cakes'],
            ['name' => 'Wedding Cakes',   'slug' => 'wedding-cakes'],
            ['name' => 'Cupcakes',        'slug' => 'cupcakes'],
            ['name' => 'Desserts',        'slug' => 'desserts']
        ];
        foreach ($categories as $cat) {
            \App\Models\Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Fetch one category to attach to products
        $catIds = \App\Models\Category::pluck('id')->toArray();

        // 3. Products
        $products = [
            [
                'name' => 'Wedding Cake (3-tier)',
                'slug' => 'wedding-cake-3-tier',
                'description' => 'A beautifully designed 3-tier wedding cake.',
                'base_price' => 250.00,
                'thumbnail' => 'wedding-cake.jpg',
                'category_id' => $catIds[1] ?? 1,
                'is_available' => true
            ],
            [
                'name' => 'Birthday Cake (Chocolate)',
                'slug' => 'birthday-cake-chocolate',
                'description' => 'Rich chocolate birthday cake.',
                'base_price' => 50.00,
                'thumbnail' => 'birthday-cake.jpg',
                'category_id' => $catIds[0] ?? 1,
                'is_available' => true
            ],
            [
                'name' => 'Cupcake Box (12 pcs)',
                'slug' => 'cupcake-box-12',
                'description' => 'Assorted cupcakes box of 12.',
                'base_price' => 30.00,
                'thumbnail' => 'cupcakes.jpg',
                'category_id' => $catIds[2] ?? 1,
                'is_available' => true
            ],
            [
                'name' => 'Strawberry Tart',
                'slug' => 'strawberry-tart',
                'description' => 'Fresh strawberry tart.',
                'base_price' => 20.00,
                'thumbnail' => 'tart.jpg',
                'category_id' => $catIds[3] ?? 1,
                'is_available' => true
            ],
            [
                'name' => 'Baby Shower Cake',
                'slug' => 'baby-shower-cake',
                'description' => 'Customizable baby shower cake.',
                'base_price' => 80.00,
                'thumbnail' => 'baby-shower.jpg',
                'category_id' => $catIds[0] ?? 1,
                'is_available' => true
            ]
        ];
        
        foreach ($products as $prod) {
            \App\Models\Product::firstOrCreate(['slug' => $prod['slug']], $prod);
        }

        $prodIds = \App\Models\Product::pluck('id')->toArray();

        // 4. Dummy Users/Customers
        $users = [
            ['name' => 'Nived K.',   'email' => 'nived@example.com',  'password' => bcrypt('password')],
            ['name' => 'Sahad M.',   'email' => 'sahad@example.com',  'password' => bcrypt('password')],
            ['name' => 'Arya P.',    'email' => 'arya@example.com',   'password' => bcrypt('password')],
            ['name' => 'Fathima R.', 'email' => 'fathima@example.com','password' => bcrypt('password')],
            ['name' => 'Mirate S.',  'email' => 'mirate@example.com', 'password' => bcrypt('password')]
        ];

        foreach ($users as $u) {
            \App\Models\User::firstOrCreate(['email' => $u['email']], $u);
        }

        $userIds = \App\Models\User::pluck('id')->toArray();

        // 5. Orders & Items
        $now = now();
        $ordersData = [
            ['order_number' => 'CA-1042', 'status' => 'Pending',    'date' => $now->clone()->addDays(2), 'addr' => 'Kozhikode, Kerala', 'user_index' => 0, 'prod_index' => 0],
            ['order_number' => 'CA-1041', 'status' => 'Processing', 'date' => $now->clone()->addDay(),   'addr' => 'Calicut, Kerala',   'user_index' => 1, 'prod_index' => 1],
            ['order_number' => 'CA-1040', 'status' => 'Delivered',  'date' => $now->clone()->subDays(1), 'addr' => 'Malappuram, Kerala','user_index' => 2, 'prod_index' => 2],
            ['order_number' => 'CA-1039', 'status' => 'Delivered',  'date' => $now->clone()->subDays(2), 'addr' => 'Thrissur, Kerala',  'user_index' => 3, 'prod_index' => 4],
            ['order_number' => 'CA-1038', 'status' => 'Cancelled',  'date' => $now->clone()->subDays(5), 'addr' => 'Kochi, Kerala',     'user_index' => 4, 'prod_index' => 3],
        ];

        foreach ($ordersData as $o) {
            $user_id = $userIds[$o['user_index']] ?? $userIds[0];
            $product_id = $prodIds[$o['prod_index']] ?? $prodIds[0];
            
            // Generate total roughly based on product base_price
            $prod = \App\Models\Product::find($product_id);
            $total = $prod ? $prod->base_price : 50.00;

            $order = \App\Models\Order::firstOrCreate(
                ['order_number' => $o['order_number']],
                [
                    'user_id'            => $user_id,
                    'total_amount'       => $total,
                    'status'             => $o['status'],
                    'delivery_date'      => $o['date'],
                    'delivery_time_slot' => '10:00 AM - 12:00 PM',
                    'shipping_address'   => $o['addr']
                ]
            );

            // Create Order Item
            \App\Models\OrderItem::firstOrCreate([
                'order_id'   => $order->id,
                'product_id' => $product_id,
            ],[
                'quantity'          => 1,
                'price_at_purchase' => $total,
            ]);
        }
    }
}
