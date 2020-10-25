<template>
    <div>
        <div class="flex">
            <!-- left -->
            <div>
                <div class="h-64 w-64 bg-center bg-cover" v-if="activeProduct.imagePath" :style="'background-image:url('+activeProduct.imagePath+')'"></div>
                <div v-else class="h-64 w-64 border border-gray-400 bg-gray-300 flex justify-center items-center">No Image</div>
                <div v-if="user.is_admin" class="flex justify-end space-x-4">
                    <a :href="'/product-image/'+activeProduct.product.id+'/edit'" class="text-blue-500 hover:underline">Upload Image</a>
                    <a :href="'/product/'+activeProduct.product.id+'/edit'" class="text-blue-500 hover:underline">Edit</a>
                    <span @click="deleteProduct" class="text-blue-500 hover:underline cursor-pointer">Delete</span>
                </div>
            </div>

            <!-- right -->
            <div class="px-4 flex-grow">
                <div class="flex justify-between">
                    <h2 class="font-bold text-2xl mb-2">{{ activeProduct.product.name }}</h2>
                    <button v-if="user.is_subscribed && ! activeProduct.isRegistered" class="bg-blue-500 text-white uppercase font-bold px-4 py-1" @click="registerProduct">Register</button>
                    <button v-else-if="user.is_subscribed && activeProduct.isRegistered" class="bg-red-500 text-white uppercase font-bold px-4 py-1" @click="unregisterProduct">Unregister</button>
                </div>
                <div class="text-lg font-light text-gray-600 mb-8">${{ activeProduct.product.price/100 }}</div>
                <p class="text-lg leading-normal">{{ activeProduct.product.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        activeProduct: Object,
        user: Object,
    },

    methods: {
        deleteProduct() {
            axios.delete('/product/'+this.activeProduct.product.id).then(response => {
                this.$emit('all-products');
            });
        },

        registerProduct() {
            axios.post('/user/product/'+this.activeProduct.product.id).then(response => {
                this.activeProduct.isRegistered = true;
            });
        },

        unregisterProduct() {
            axios.delete('/user/product/'+this.activeProduct.product.id).then(response => {
                this.activeProduct.isRegistered = false;
            });
        },
    }
}
</script>
