<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <title>Code Test</title>
</head>
<body>

    <div class="container mx-auto py-8 min-h-screen">
        <div class="flex justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black">Lawline Code Test</h1>
                <p class="w-64">Use the user-swapper panel on the right to quickly switch between the seeded users for testing.</p>
                <p class="text-pink-600 font-black">Thanks for the opportunity!</p>
            </div>

            <div class="border border-gray-300 rounded p-2">
                <h2 class="font-bold mb-2">Current User: {{ auth()->user()->email ?? 'N/A' }}</h2>
                <table class="text-xs">
                    <thead><tr>
                        <th class="pr-2 text-left">Email</th>
                        <th class="px-2 text-center">Admin</th>
                        <th class="pl-2 text-center">Subscriber</th>
                    </tr></thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="pr-2"><button class="text-blue-500 hover:underline">{{ $user->email }}</button></td>
                                <td class="px-2 text-center">
                                    @if ($user->is_admin)
                                        <span class="text-green-500">true</span>
                                    @else
                                        <span class="text-red-500">false</span>
                                    @endif
                                </td>
                                <td class="pl-2 text-center">
                                    @if ($user->is_subscribed)
                                        <span class="text-green-500">true</span>
                                    @else
                                        <span class="text-red-500">false</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="app">
            <nav class="flex items-center space-x-8 pb-4 border-b border-gray-300 mb-4">
                <a @click="allProducts" :class="{ 'font-bold': activeSection == 'productList' }" class="uppercase text-sm hover:underline cursor-pointer">All Products</a>
                @if (auth()->user()->is_subscribed ?? false)
                    <a @click="myProducts" :class="{ 'font-bold': activeSection == 'productUserList' }" class="uppercase text-sm hover:underline cursor-pointer">My Products</a>
                @endif
                @if (auth()->user()->is_admin ?? false)
                    <a @click="newProduct" :class="{ 'font-bold': activeSection == 'newProduct' }" class="uppercase text-sm hover:underline cursor-pointer">New Product</a>
                @endif
            </nav>

            <main id="main">
                <product-list v-if="activeSection == 'productList'" :products="products"></product-list>
                <product-list v-if="activeSection == 'productUserList'" :products="products"></product-list>
                <product-new></product-new>
            </main>
        </div>
    </div>
</body>
</html>
