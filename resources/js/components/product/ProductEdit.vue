<template>
    <div>
        <h1 class="text-2xl font-bold mb-8">Edit Product</h1>

        <div class="mb-8">
            <div class="flex flex-nowrap">
                <label class="w-64 font-bold" for="name">Name</label>
                <input class="p-2 flex-grow border border-gray-300" type="text" name="name" placeholder="Name" v-model="formData.name">
            </div>
            <div class="text-red-600 font-bold text-right" v-if="errors.name">{{ errors.name[0] }}</div>
        </div>

        <div class="mb-8">
            <div class="flex flex-nowrap items-center">
                <label class="w-64 font-bold" for="price">Price</label>
                <input class="p-2 flex-grow border border-gray-300" type="number" step=".01" name="price" placeholder="Price" v-model="formData.price">
            </div>
            <div class="text-red-600 font-bold text-right" v-if="errors.price">{{ errors.price[0] }}</div>
        </div>

        <div class="mb-8">
            <div class="flex flex-nowrap items-center">
                <label class="w-64 font-bold" for="description">Description</label>
                <textarea class="p-2 flex-grow border border-gray-300" rows="5" type="text" name="description" placeholder="Description" v-model="formData.description"></textarea>
            </div>
            <div class="text-red-600 font-bold text-right" v-if="errors.description">{{ errors.description[0] }}</div>
        </div>

        <div class="mb-8">
            <div class="flex flex-nowrap items-center">
                <label class="w-64 font-bold" for="image">Image</label>
                <p v-show="hasImage" class="p-2 flex-grow border border-gray-300">{{ this.imageName }} <span class="cursor-pointer text-blue-500 hover:underline" @click="removeImage">Remove</span></p>
                <input v-show="! hasImage" class="p-2 flex-grow border border-gray-300" type="file" name="image" @change="setImage" />
            </div>
        </div>

        <div class="flex justify-end">
            <button class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-1" type="button" @click="editProduct">Save Changes</button>
        </div>
    </div>
</template>

<script>
export default {

    props: ['product'],

    data() {
        return {
            formData: {
                name: this.product.name,
                description: this.product.description,
                price: this.product.price/100,
            },
            hasImage: this.product.image_name ? true : false,
            imageName: this.product.image_name,
            errors: [],
        }
    },

    methods: {
        editProduct() {
            var formData = new FormData();
            formData.append('name', this.formData.name);
            formData.append('description', this.formData.description);
            formData.append('price', this.formData.price);
            formData.append('remove_image', ! this.hasImage);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);

            axios.post('/product/'+this.product.id, formData).then(response => {
                this.$emit('show-product', response.data.product);
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        },

        removeImage() {
            this.hasImage = false;
        },

        setImage() {
            this.hasImage = true;
            this.imageName = document.querySelector('input[name="image"]').files[0].name;
        }
    }
}
</script>
