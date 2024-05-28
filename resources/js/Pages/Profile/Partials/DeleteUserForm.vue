<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            Eliminar Conta
        </template>

        <template #description>
            Eliminar a sua conta permanentemente.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Uma vez que a sua conta for eliminada, todos os seus recursos e dados serão permanentemente eliminados. Antes de eliminar a sua conta, por favor, descarregue quaisquer dados ou informações que deseje reter.
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmUserDeletion">
                    Eliminar Conta
                </DangerButton>
            </div>

            <!-- Modal de Confirmação para Eliminar Conta -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Eliminar Conta
                </template>

                <template #content>
                    Tem a certeza de que deseja eliminar a sua conta? Uma vez que a sua conta for eliminada, todos os seus recursos e dados serão permanentemente eliminados. Por favor, insira a sua palavra-passe para confirmar que deseja eliminar a sua conta permanentemente.

                    <div class="mt-4">
                        <TextInput
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="Palavra-passe"
                            autocomplete="current-password"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancelar
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Eliminar Conta
                    </DangerButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>

