<template>
    <div>
        <h1>Reset User Password</h1>
        <form @submit.prevent="submit">
            <input v-model="form.email" type="email" placeholder="User Email" required>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: ''
});

const submit = () => {
    form.post(route('admin.password.email'));
};
</script>