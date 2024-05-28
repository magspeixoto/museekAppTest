<template>
    <AppLayout>
        <div class="mt-20 mx-80">
            <!-- Header with product information -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ product.name }}</h1>
                <p class="text-2xl font-semibold text-gray-700 mt-2">{{ product.price }} €</p>
                <p class="text-md text-gray-500 mt-2">{{ product.description }}</p>
                <div class="flex mt-4 space-x-4">
                    <span class="text-sm font-medium text-gray-900">Marca: {{ product.brand.name }}</span>
                    <span class="text-sm font-medium text-gray-900">Categoria: {{ product.category.name }}</span>
                </div>
                <p class="text-sm font-medium text-gray-900 mt-2">Criado em: {{ new
                    Date(product.created_at).toLocaleDateString() }}</p>


                <PrimaryButton @click="contacting = true" :disabled="form.processing" type="submit"
                    class="mt-5 text-sm w-auto font-medium bg-gray-900 text-white p-2 flex items-center">
                    <i class="fas fa-envelope mr-2"></i>
                    <span>Entre em contacto</span>
                </PrimaryButton>
            </div>
            <!-- Product Image and Details -->
            <div class="flex justify-center mb-10">
                <div class="group relative">
                    <div
                        class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-500 lg:aspect-none group-hover:opacity-75 lg:h-80">
                        <img :src="getImageUrl(product.main_image)" class="h-full w-full object-cover object-center">
                    </div>
                </div>
            </div>
            <!-- Modal for Contact Form -->
            <Modal :show="contacting" :closeable="true" @close="contacting = null; flash.contacted = null;">
                <div class="bg-gray-50 shadow-2xl p-8 text-center font-bold">
                    <div class="p-8" v-if="flash.contacted">
                        <p class="text-sm m-5"> 👍 Obrigado pelo contacto, entratemos em contacto em breve!</p>
                    </div>
                    <div class="bg-gray-50 p-8" v-else>
                        <p class="text-gray-600 text-center">Envie-nos o seu concacto para registar a sua encomenda</p>
                        <form class="flex flex-col items-center p-16" @submit.prevent="submitForm">
                            <TextInput class="px-5 py-3 w-96 border border-gray-600 rounded" type="name" name="name"
                                placeholder="Seu nome" v-model="form.name"></TextInput>
                            <InputError :message="form.errors.name"></InputError>
                            <TextInput class="mt-5 px-5 py-3 w-96 border border-gray-600 rounded" type="email" name="email"
                                placeholder="Seu email" v-model="form.email"></TextInput>
                            <InputError :message="form.errors.email"></InputError>
                            <PrimaryButton :disabled="form.processing" type="submit"
                                class="px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">
                                <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span>
                                <span class="" v-show="!form.processing">Entrar em contacto!</span>
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </Modal>
        </div>
    </AppLayout>
</template>

<script setup>
import {
    defineProps,
    ref
} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import {
    useForm
} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { router } from '@inertiajs/vue3';


const props = defineProps({
    product: Object,
    flash: Object
});

const contact = {
    message: null
};

const contacting = ref(false)

const form = useForm({
    name: '',
    email: '',
    product_id: props.product.id
});

const submitForm = () => {
    router.post('/contact', form, {
        onSuccess: () => {            
            form.reset();
        }
    });
};

const getImageUrl = (image) => {
    if (image && image.imageURL) {
        return `/storage/${image.imageURL}`;
    }
    return '';
};

</script>
