<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Head } from "@inertiajs/vue3";
import { ref } from 'vue';

defineProps({
    products: Object,
});

</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        </div>
        </div>
    </AuthenticatedLayout>
</template>
