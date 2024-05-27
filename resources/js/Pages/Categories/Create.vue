<template>
    <AppLayout>
        <div class="flex justify-center">
            <div class="block justify-center items-center mt-20 mb-0 col-span-2">
                <Link class="p-5 bg-orange-300 rounded" :href="`/product/index`">Back</Link>
                <form @submit.prevent="form.post('/category')" class="flex-column justify-center items-center">
                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Nova categoria</label>
                        <input v-model="form.name" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.name" class="input-error">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="btn-primary mb-80 px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Criar
                            categoria</button>
                    </div>
                </form>
            </div>
        </div>        
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {
    useForm, usePage
} from '@inertiajs/vue3';

const form = useForm({
    name: '',
});

</script>