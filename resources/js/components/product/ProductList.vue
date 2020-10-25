<template>
    <div>
        <div v-if="products.length" class="flex flex-wrap items-stretch">
            <div v-for="product in products" :key="product.id" class="w-1/3 p-2">
                <div class="border border-gray-300 rounded p-4 h-full">
                    <div class="flex justify-between mb-4">
                        <a @click="showProduct(product)" class="font-bold text-lg leading-none text-blue-500 cursor-pointer over:underline">{{ product.name }}</a>
                        <div class="text-lg font-light text-gray-700">${{ product.price/100 }}</div>
                    </div>
                    <p class="leading-normal">{{ product.description }}</p>
                </div>
            </div>
        </div>
        <div v-else class="italic text-gray-700 text-xl text-center p-4">There are no products!</div>
    </div>
</template>

<script>
export default {
    props: ['products'],

    methods: {
        showProduct(product) {
            this.$emit('show-product', product);
        }
    }
}
</script>
