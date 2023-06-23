<script setup>
import { computed } from 'vue';
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from '@/Components/InputError.vue';
import { ref } from "vue";

const props = defineProps({
    role: {
        type: Object,
    },
    permissions: {
        type: Object,
    },
});

const form = useForm({
    name: '',
    permissions:  [],

});

const roleName = ref(null);

const createRole = () => {
    console.log('Create form');
    form.post(route('roles.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                roleName.value.focus();
            }
        },
    });
};
</script>

<template>
    <div class="py-4">
        <form @submit.prevent="createRole">

        <div>
            <InputLabel for="role_name" value="Role Name" />
            <TextInput
                id="role_name"
                ref="roleName"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
            />
            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="grid grid-cols-4 gap-4">
            <div
                v-for="permission in permissions"
                :key="permission.id"
                class="flex gap-x-6 py-5"
            >
                <input
                    type="checkbox"
                    :value="permission.id"
                    v-model="form.permissions"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                />
                {{ permission.name }}
            </div>
            <InputError class="mt-2" :message="form.errors.permissions" />
        </div>
        <div>

            </div>
        <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </div>
</template>
