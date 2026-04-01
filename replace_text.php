<?php

$paths = [
    __DIR__.'/resources/views/welcome.blade.php',
    __DIR__.'/resources/views/layouts/app.blade.php',
    __DIR__.'/resources/views/shop/products.blade.php',
    __DIR__.'/resources/views/shop/product-detail.blade.php',
    __DIR__.'/resources/views/shop/customized.blade.php',
    __DIR__.'/resources/views/shop/contact.blade.php',
    __DIR__.'/resources/views/shop/delivery.blade.php',
    __DIR__.'/resources/views/admin/layouts/app.blade.php',
];

$replacements = [
    'Kerala' => 'UAE',
    '+91 98955 88988' => '000000',
    '919895588988' => '000000',
    '0484 2767660' => '000000',
    'Bespoke' => 'Custom Cakes',
    'bespoke' => 'custom',
    'Collections' => 'Cakes'
];

foreach ($paths as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $modified = false;
        
        foreach ($replacements as $search => $replace) {
            if (strpos($content, $search) !== false) {
                $content = str_replace($search, $replace, $content);
                $modified = true;
            }
        }
        
        if ($modified) {
            file_put_contents($file, $content);
            echo "Updated: $file\n";
        }
    }
}
echo "Done.\n";
