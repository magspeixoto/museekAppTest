<template>
<AppLayout>
    <div class="brand__create">
        <form @submit.prevent="form.post('/brand')">
            <div class="flex-column justify-center items-center mt-60 mb-80">
                <div class="col-span-2">
                    <label class="label">Create Brand Name</label>
                    <input v-model="form.name" type="text" class="input mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.name" class="input-error">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="col-span-6">
                    <button type="submit" class="btn-primary ml-5 px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Create Brand</button>
                </div>
            </div>
        </form>
    </div>
</AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
import {
        useForm
    } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
    })

    

</script>
