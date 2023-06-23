
<script setup>

//import moment from 'moment';

import Checkbox from '@/Components/Checkbox.vue';
import { computed, reactive } from 'vue';

const props = defineProps({
    dataRole: {
        type: Object,
        default: []
    },
    dataPermissions: Object,
    modelValue: Object
});
const form = reactive({
    checked: props.dataRole.permissions,
});

const emit = defineEmits(['update:dataRole']);

</script>
<template>

    <div>


        <div class="grid grid-cols-4 gap-4">

            <div
                v-for="permission in dataPermissions"
                :key="permission.id"
                class="flex gap-x-6 py-5"
            >
            <input
                type="checkbox"
                :value="permission"
                v-model="form.checked"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            />
            </div>
        </div>
    </div>
</template>
