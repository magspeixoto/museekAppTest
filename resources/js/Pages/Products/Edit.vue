<template>
    <AppLayout>
        <div class="flex justify-center">
            <div class="block justify-center items-center mt-20 mb-0 col-span-2">
                <Link class="p-5 bg-orange-300 rounded" :href="`/product/index`">Back</Link>
                <form @submit.prevent="update" class="flex-column justify-center items-center">
                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                        <input v-model="form.name" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.name" class="input-error">{{ form.errors.name }}</div>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product Image</label>
                        <div v-if="imagePreview">
                            <img :src="imagePreview" alt="Product Image" class="w-48 h-48 object-cover mb-3" />
                        </div>
                        <input @change="onFileChange" type="file"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.image" class="input-error">{{ form.errors.image }}</div>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product Price</label>
                        <input v-model="form.price" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.price" class="input-error">{{ form.errors.price }}</div>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product Description</label>
                        <input v-model="form.description" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.description" class="input-error">{{ form.errors.description }}</div>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900" for="category">Choose
                            Category</label>
                        <select class="input w-96 border border-gray-600 rounded" id="category" v-model="form.category">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                            <div v-if="form.errors.category" class="input-error">{{ form.errors.category }}</div>
                        </select>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900" for="brand">Choose Brand</label>
                        <select class="input w-96 border border-gray-600 rounded items-center" id="brand"
                            v-model="form.brand">
                            <option class="border border-gray-600 rounded" v-for="brand in brands" :key="brand.id"
                                :value="brand.id">
                                {{ brand.name }}
                            </option>
                            <div v-if="form.errors.brand"
                                class="input-error mt-5 ml-5 px-5 py-3 w-96 border border-gray-600 rounded">
                                {{ form.errors.brand }}
                            </div>
                        </select>
                    </div>

                    <div class="flex justify-center mb-10">
                        <button type="submit"
                            class="btn-primary px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
  
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    product: Object,
    imageUrl: String,
    categories: Array,
    brands: Array,
});

const form = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
    category: props.product.category,
    brand: props.product.brand,
    image: null,
});

const imagePreview = ref(props.imageUrl); // Use the passed imageUrl prop

let image = null;

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        image = null;
        imagePreview.value = props.imageUrl; // Reset to original image if the file is invalid
    }
};

const update = () => {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('price', form.price);
    formData.append('description', form.description);
    formData.append('category', form.category);
    formData.append('brand', form.brand);
    // First, update product data without image
    form.put(route('product.update', { product: props.product.id }), {
        onSuccess: () => {
            // If image is selected, upload it separately
            if (image) {
                uploadImage();
            } else {
                form.reset('image');
            }
        },
        onError: (errors) => {
            form.setErrors(errors);
        },
    });
};

const uploadImage = () => {
    const formData = new FormData();
    formData.append('image', image);
    Inertia.post(route('product.uploadImage', { product: props.product.id }), formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        }
    });
};
</script>
  