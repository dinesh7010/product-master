<!-- resources/views/welcome.blade.php or create resources/views/products.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4">
        @livewire('product-crud')
    </div>

    @livewireScripts
</body>
</html>
