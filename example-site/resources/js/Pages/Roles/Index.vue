<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateRole from "./Partials/UpdateRole.vue"
import CreateRole from "./Partials/CreateRole.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, Head } from "@inertiajs/vue3";
import { ref } from 'vue';

defineProps({
    roles: Object,
    permissions: Object,
});


const form = useForm({
    name: "",
    email: "",
});

const open = ref(false);
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pl-6 pr-6 pb-6">

                <ul role="list" class="divide-y divide-gray-100">
                    <li>
                        <div>
                            <PrimaryButton @click="open = !open"> + </PrimaryButton>
                        </div>
                        <div v-show="open">
                            <CreateRole :permissions="permissions"></CreateRole>
                        </div>
                    </li>
                    <li
                        v-for="role in roles"
                        :key="role.id"
                        class="block justify-between gap-x-6 py-5"
                    >

                    <UpdateRole :role="role" :permissions="permissions">
                    </UpdateRole>
                    </li>
                </ul>
                </div>
            </div>

        </div>
        </div>
    </AuthenticatedLayout>
</template>
