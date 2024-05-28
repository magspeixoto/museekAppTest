<template>
    <AppLayout>

        <div class="flex justify-center mt-10 pl-96 pr-96">
            <FormSection @submitted="form.post('/category')">
                <template #title>
                    Nova categoria
                </template>

                <template #description>
                    Define a categoria para os teus instrumentos. 
                    Aparecerá publicamente como um novo item na barra de navegação.
                </template>
                <template #form>
                    <div class="col-span-12 w-auto">
                        <InputLabel for="name" value="Nome" />
                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                            autocomplete="name" />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="flex justify-between">
                        <PrimaryButton class="col-span-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Guardar
                        </PrimaryButton>

                        <SecondaryButton class="col-span-2 ml-5" @click.prevent="navigateToManageCategory">
                            Voltar
                        </SecondaryButton>
                    </div>
                    
                </template>             
            </FormSection>
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {
    useForm, usePage, router
} from '@inertiajs/vue3';

const form = useForm({
    name: '',
});

const navigateToManageCategory = () => {
  router.visit('/manage/category');
};

</script>