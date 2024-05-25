
<template>
    <AppLayout>
        <div class="mt-10 mx-60">
            <div class="flex pt-5 flex-wrap gap-4">
                <div class="flex flex-col border p-10">
                    <h1>Name: {{ user.name }}</h1>
                    <h1>Email: {{ user.email }}</h1>
                    <br>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import {
        defineProps
    } from 'vue';

    defineProps({
        user: Object,
    })

</script>
