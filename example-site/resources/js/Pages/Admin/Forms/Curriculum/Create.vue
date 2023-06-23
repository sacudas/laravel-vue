<script setup>
import AuthenticatedLayout from "@/Pages/Admin/Layouts/AuthLayout.vue";
import InputError from '@/Components/InputError.vue';
import { useForm, Head } from "@inertiajs/vue3";


const props = defineProps({
    sections: {
        type: Object,
    },
    tracks: {
        type: Object,
    },
    curriculum_exits: {
        type: Object,
    },
    countries: {
        type: Object
    },
    employment_status: {
        type: Object,
        default(rawProps){
            if(rawProps.employment_status){
                return rawProps.employment_status;
            }
            return [
                {
                    id:1,
                    name: 'Local'
                },
                {
                    id: 2,
                    name: 'Abroad'
                }
            ];
        }
    }
});

const form = useForm({
    lrn: '',
    name: '',
    email: '',
    section:  '',
    track: '',
    curriculum_exit: '',
    emmersion_company: '',
    employment_status: 1,
    address: '',

});


const createCurriculum = () => {
    console.log('Create form');
    form.post(route('curriculums.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            console.log(form.errors);
        },
    });
};
</script>
<template>
    <Head title="Create Curriculum" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <main>
            <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                <!-- Breadcrumb Start -->
                <div
                    class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
                >
                    <h2
                        class="text-title-md2 font-bold text-black dark:text-white"
                    >
                        Form Layout
                    </h2>

                    <nav>
                        <ol class="flex items-center gap-2">
                            <li>
                                <a class="font-medium" href="index.html"
                                    >Dashboard /</a
                                >
                            </li>
                            <li class="font-medium text-primary">
                                Form Layout
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- Breadcrumb End -->

                <!-- ====== Form Layout Section Start -->
                <div class="grid grid-cols-1 gap-9">
                    <div class="flex flex-col gap-9">
                        <!-- Contact Form -->
                        <div
                            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
                        >
                            <div
                                class="border-b border-stroke py-4 px-6.5 dark:border-strokedark"
                            >
                                <h3
                                    class="font-semibold text-black dark:text-white"
                                >
                                    Curriculum Form
                                </h3>
                            </div>
                            <form @submit.prevent="createCurriculum">
                               
                                   
                                <div class="p-6.5">
                                    <div
                                        class="mb-4.5 flex flex-col gap-6 xl:flex-row"
                                    >
                                        <div class="w-full">
                                            <label
                                                class="mb-2.5 block text-black dark:text-white"
                                            >
                                             LRN
                                               <span class="text-meta-1">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                placeholder=""
                                                v-model="form.lrn"
                                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                            />
                                            <InputError class="mt-2 text-meta-1" :message="form.errors.lrn" />
                                        </div>

                                    </div>

                                    <div
                                        class="mb-4.5 flex flex-col gap-6 xl:flex-row"
                                    >
                                        <div class="w-full">
                                            <label
                                                class="mb-2.5 block text-black dark:text-white"
                                            >
                                               Name (Last, Given, MI)
                                               <span class="text-meta-1">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                placeholder="Enter your first name"
                                                v-model="form.name"
                                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                            />
                                            <InputError class="mt-2 text-meta-1" :message="form.errors.name" />
                                        </div>

                                    </div>

                                    <div class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                            Email
                                            <span class="text-meta-1">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            v-model="form.email"
                                            placeholder="Enter your email address"
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                        />
                                        <InputError class="mt-2 text-meta-1" :message="form.errors.email" />
                                    </div>

                                    <div class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                            Section
                                            <span class="text-meta-1">*</span>
                                        </label>
                                        <div
                                            class="relative z-20 bg-transparent dark:bg-form-input"
                                        >




                                            <select
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                v-model="form.section"
                                                >
                                                <option value="">
                                                   Type your section
                                                </option>
                                                <option v-for="section in sections" :key="section.id"  :value="section.id" >{{  section.name }}</option>


                                            </select>
                                            <span
                                                class="absolute top-1/2 right-4 z-30 -translate-y-1/2"
                                            >
                                                <svg
                                                    class="fill-current"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                </svg>
                                            </span>
                                            <InputError class="mt-2 text-meta-1" :message="form.errors.section" />
                                        </div>

                                    </div>

                                    <div class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                        Senior High School track
                                        <span class="text-meta-1">*</span>
                                        </label>
                                        <div
                                            class="relative z-20 bg-transparent dark:bg-form-input"
                                        >




                                            <select
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                v-model="form.track"
                                                >

                                                <option v-for="track in tracks" :key="track.id" :value="track.id" >{{  track.name }}</option>


                                            </select>
                                            <span
                                                class="absolute top-1/2 right-4 z-30 -translate-y-1/2"
                                            >
                                                <svg
                                                    class="fill-current"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                </svg>
                                            </span>
                                        </div>
                                        <InputError class="mt-2 text-meta-1" :message="form.errors.track" />
                                    </div>


                                    <div class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                        Curriculum Exit
                                        <span class="text-meta-1">*</span>
                                        </label>
                                        <div
                                            class="relative z-20 bg-transparent dark:bg-form-input"
                                        >
                                            <select
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                v-model="form.curriculum_exit"
                                                >

                                                <option v-for="curriculum_exit in curriculum_exits" :key="curriculum_exit.id" :value="curriculum_exit.id" >{{  curriculum_exit.name }}</option>


                                            </select>
                                            <span
                                                class="absolute top-1/2 right-4 z-30 -translate-y-1/2"
                                            >
                                                <svg
                                                    class="fill-current"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                </svg>
                                            </span>
                                        </div>
                                        <InputError class="mt-2 text-meta-1" :message="form.errors.curriculum_exit" />
                                    </div>

                                    <div class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                            Emmersion Company
                                           
                                        </label>
                                        <input
                                            type="text"
                                            v-model="form.emmersion_company"
                                            placeholder=""
                                            class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                        />
                                    </div>

                                    <div class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                        Employment Status
                                        </label>
                                        <div
                                            class="relative z-20 bg-transparent dark:bg-form-input"
                                        >




                                            <select
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                v-model="form.employment_status"
                                                >

                                                <option v-for="employment_type in employment_status" :key="employment_type.id" :value="employment_type.id" >{{  employment_type.name }}</option>


                                            </select>
                                            <span
                                                class="absolute top-1/2 right-4 z-30 -translate-y-1/2"
                                            >
                                                <svg
                                                    class="fill-current"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >

                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div v-if="form.employment_status == 1" class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                        Name of company for local employment
                                        <span class="text-meta-1">*</span>
                                        </label>
                                        <div
                                            class="relative z-20 bg-transparent dark:bg-form-input"
                                        >




                                        <input
                                                type="text"
                                                placeholder="Enter your first name"
                                                v-model="form.address"
                                                class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                            />
                                            <InputError class="mt-2 text-meta-1" :message="form.errors.address" />
                                        </div>
                                    </div>

                                    <div v-if="form.employment_status == 2" class="mb-4.5">
                                        <label
                                            class="mb-2.5 block text-black dark:text-white"
                                        >
                                        Name of the Country
                                        <span class="text-meta-1">*</span>
                                        </label>
                                        <div
                                            class="relative z-20 bg-transparent dark:bg-form-input"
                                        >



                                        <select
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                v-model="form.address"
                                                >

                                                <option v-for="country in countries" :key="country.id" :value="country.official_name" >{{  country.official_name }}</option>


                                        </select>
                                        <InputError class="mt-2 text-meta-1" :message="form.errors.address" />
                                    </div>
                                    </div>




                                    <button
                                        class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- ====== Form Layout Section End -->
            </div>
        </main>
    </AuthenticatedLayout>
</template>
