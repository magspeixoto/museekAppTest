<template>
    <AppLayout>
        <div class="mt-20 mx-80 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <div class="group relative">
                <div
                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-500 lg:aspect-none group-hover:opacity-75 lg:h-80">
                    <img :src="product.image" class="h-full w-full object-cover object-center">
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href="#">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ product.name }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p>
                        <p class="text-sm font-medium text-gray-900">Brand: {{ product.brand.name }}</p>
                        <p class="text-sm font-medium text-gray-900">Category: {{ product.category.name }}</p>
                    </div>
                    <p class="text-sm font-medium text-gray-900">{{ product.price }}$</p>
                </div>
            </div>
        </div>
        <button class="ml-80 mb-20 justify-center items-center text-sm font-medium bg-gray-900 text-white p-2"
            @click="contacting = true">
            Get in Touch to Buy
        </button>
        <Modal :show="contacting" :closeable="true" @close="contacting = null">
            <div class="bg-gray-50 shadow-2xl p-8 text-center font-bold">
                <div class="bg-green-400 shadow-2xl p-8" v-if="$page.props.flash.contacted">
                    <p class="text-8xl m-5"> 👍 Thank you for your message, I'll get back to you soon!</p>
                </div>
                <div class="bg-gray-50 shadow-2xl p-8" v-else>
                    <p class="text-gray-600 text-center">Send us your contact to register your order</p>
                    <form class="flex flex-col items-center p-16" @submit.prevent="submitForm">
                        <TextInput class="px-5 py-3 w-96 border border-gray-600 rounded" type="name" name="name"
                            placeholder="Your name" v-model="form.name"></TextInput>
                        <InputError :message="form.errors.name"></InputError>

                        <!-- <jet-input-error :message="form.errors.name"/> -->
                        <TextInput class="mt-5 px-5 py-3 w-96 border border-gray-600 rounded" type="email" name="email"
                            placeholder="Your email" v-model="form.email">
                        </TextInput>
                        <InputError :message="form.errors.email"></InputError>
                        <PrimaryButton :disabled="form.processing" type="submit"
                            class="px-5 py-3 mt-5 w-96 bg-orange-300 justify-center" href="`/contact`">
                            <span class="animate-spin mr-1" v-show="form.processing">&#9696;</span>
                            <span class="" v-show="!form.processing">Get in Touch!</span>
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </Modal>
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
    import {
        useForm
    } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import { router } from '@inertiajs/vue3';


    const props = defineProps({
        product: Object,
    });

    console.log(props.product)
    
    const contacting = ref(false)

    const form = useForm({
        name: '',
        email: '',
        product_id: props.product.id // Inclua o ID do produto nos dados do formulário
    });

    const submitForm = () => {
  router.post('/contact', form, {
    onSuccess: () => {
      alert('Contact successful, emails sent.');
    }
  });
};

</script>
