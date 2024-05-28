<template>
    <AppLayout>
        <div class="flex justify-center">
            <div class="justify-center items-center col-span-2">
                <Link class="p-5 bg-orange-300 rounded" :href="`/manage/product`">Voltar</Link>
                <form @submit.prevent="form.post('/product')" class="flex-column justify-center items-center">
                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Nome do produto</label>
                        <input v-model="form.name" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.name" class="text-red-500">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Imagem do produto</label>
                        <input @change="onFileChange" type="file"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="imagePreview" class="mt-3">
                            <img :src="imagePreview" alt="Image Preview" class="w-48 h-48 object-cover" />
                        </div>
                        <div v-if="form.errors.image" class="text-red-500">{{ form.errors.image }}</div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Preço</label>
                        <input v-model="form.price" type="number"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.price" class="text-red-500">
                            {{ form.errors.price }}
                        </div>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Descrição </label>
                        <input v-model="form.description" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.description" class="text-red-500">
                            {{ form.errors.description }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900" for="category">Categoria</label>
                        <select class="input w-96 border border-gray-600 rounded" id="category" v-model="form.category">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                            <div v-if="form.errors.category" class="input-error">
                                {{ form.errors.category }}
                            </div>
                        </select>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900" for="brand">Choose
                            Brand</label>
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
                    <div class="flex justify-center">
                        <button type="submit" class="btn-primary px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Criar produto</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: '',
    description: '',
    price: '',
    image: null,
    category: '',
    brand: '',
})

const props = defineProps({
    categories: Array,
    brands: Array,
});

const imagePreview = ref(null);

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        form.image = file;
        console.log('File selected:', file);
        // Create a preview URL for the selected image
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        form.image = null;
        imagePreview.value = null;
    }
};

const submitForm = () => {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('description', form.description);
    formData.append('price', form.price);
    formData.append('image', form.image);
    formData.append('category', form.category);
    formData.append('brand', form.brand);

    form.post('/products', formData);
};

// Exporte todas as variáveis e funções necessárias


</script>

<style scoped>
.image-preview img {
    max-width: 100%;
    height: auto;
}
</style>
