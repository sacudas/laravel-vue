<script setup>
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
        type: [Array, Object],
    },
});

const form = useForm({
    name: props.role.name,
    permissions: props.role.permissions.map((a) => a.id),
    role: props.role.id
});

const open = ref(false);
const roleName = ref(null);

const updateRole = () => {
    console.log('post form', props.role.id);
    form.put(route('roles.update', {'role' : props.role.id }), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                console.log(form.errors)
                roleName.value.focus();
            }
        },
    });
};
</script>

<template>
    <form @submit.prevent="updateRole">
        <div>
            <div class="block">
                <div class="ml-2 text-sm" @click="open = !open">
                    <label
                        class="font-medium blocktext-gray-900 dark:text-gray-300"
                        >{{ role.name }}</label
                    >
                    <p
                        id="helper-checkbox-text"
                        class="text-xs font-normal block text-gray-500 dark:text-gray-300"
                    >
                        {{ role.guard_name }}
                    </p>
                </div>
            </div>
            <div class="block">
                <div class="ml-2 text-sm" v-show="open">
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
                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing"
                            >Update</PrimaryButton
                        >

                        <Transition
                            enter-from-class="opacity-0"
                            leave-to-class="opacity-0"
                            class="transition ease-in-out"
                        >
                            <p
                                v-if="form.recentlySuccessful"
                                class="text-sm text-gray-600"
                            >
                                Saved.
                            </p>
                        </Transition>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
