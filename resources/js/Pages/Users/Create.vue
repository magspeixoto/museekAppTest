<template>
<AppLayout>
    <div class="brand__create">
        <form @submit.prevent="form.post('/user')">
            <div class="flex-column justify-center items-center mt-20 mb-80 items-center">
                <div class="col-span-2 flex justify-center mb-2 mt-2 items-center">
                    <label class="label">Create User Name</label>
                    <input v-model="form.name" type="text" class="input-error ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.name" class="input-error">
                        {{ form.errors.name }}
                    </div>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2 items-center">
                    <label class="label">Create Email </label>
                    <input v-model="form.email" type="text" class="input-error ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.email" class="input-error">
                        {{ form.errors.email }}
                    </div>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2 items-center">
                    <label class="label">Create Password</label>
                    <input v-model="form.password" type="text" class="input-error ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 roundeds" />
                    <div v-if="form.errors.password" class="input-error">
                        {{ form.errors.password }}
                    </div>
                </div>
                

                <div class="col-span-2 flex justify-center mb-2 mt-2 items-center">
                    <button type="submit" class="btn-primary ml-5 px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Create User</button>
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
        email: '',
        password: '',
    })

    

</script>