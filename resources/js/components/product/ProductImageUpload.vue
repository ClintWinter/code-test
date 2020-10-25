<template>
    <div>
        <h1 class="text-2xl font-bold mb-8">Upload Image for <span class="text-blue-800 font-black">{{ product.name }}</span></h1>

        <div class="mb-8">
            <div class="flex flex-nowrap items-center">
                <label class="w-64 font-bold" for="image">Image</label>
                <input class="p-2 flex-grow border border-gray-300" type="file" name="image" />
            </div>
            <div class="text-red-600 font-bold text-right" v-if="errors.image">{{ errors.image }}</div>
        </div>

        <div class="flex justify-end">
            <button class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-1" type="button" @click="uploadImage">Save Image</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product'],

    data() {
        return {
            errors: [],
        }
    },

    methods: {
        uploadImage() {
            var formData = new FormData();
            formData.append('image', document.querySelector('input[name="image"]').files[0]);

            axios.post('/product-image/'+this.product.id, formData).then(response => {
                this.$emit('show-product', response.data.product);
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        },
    }
}
</script>
