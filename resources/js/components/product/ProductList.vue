<template>
    <div class="flex flex-wrap items-stretch">
        <div v-for="product in products" :key="product.id" class="w-1/3 p-2">
            <div class="border border-gray-300 rounded p-4 h-full">
                <div class="flex justify-between mb-4">
                    <a @click="showProduct" class="font-bold text-lg leading-none text-blue-500 hover:underline">{{ product.name }}</a>
                    <div class="text-lg font-light text-gray-700">${{ product.price/100 }}</div>
                </div>
                <p class="leading-normal">{{ product.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['products'],

        methods: {
            showProduct() {
                // emit show product
            }
        }
    }
</script>
