<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { ref } from 'vue'
import Message from "@/Pages/Messages/Message.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const props = defineProps({
    users: Array,
    messages: Array,
    to: Object,
    errors: Object
})

const loading = ref(false);
const page = usePage();

const form = useForm({
    body: '',
    to: props.to.id
})
const store = () => form.post(route('message.store'))
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="h-full py-12">
            <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col bg-white rounded-md h-full">

                    <div class="flex items-center justify-between px-4 py-3 lg:px-6">
                        <div class="relative flex items-center space-x-2">
                            <div class="relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ to.id !== undefined ? to.name : 'Select a user to chat with' }}
                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div v-for="user in users">
                                            <DropdownLink :href="route('dashboard', {'user': user.id})">{{ user.name }}</DropdownLink>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                    <div class="flex grow flex-col px-4 pb-8 space-y-4 border-t border-gray-200 lg:px-6">
                        <div class="flex min-h-0 grow basis-0 flex-col space-y-4 overflow-y-auto">
                            <Message
                                v-for="message in messages"
                                :message="message"
                            />
                        </div>

                        <div class="flex items-center pt-3">
                            <img
                                :src="`/images/users/user${page.props.auth.user.id}.jpg`"
                                class="w-12 h-12 mr-3 rounded-full"
                                :alt="page.props.auth.user.name"
                            />
                            <div class="flex-1">
                                <form @submit.prevent="store">
                                    <TextInput
                                        v-model="form.body"
                                        type="text"
                                        class="w-full px-4 py-3 text-sm placeholder-gray-400 border border-gray-200 rounded-md"
                                        placeholder="Send a message"
                                        :disabled="loading === true && to !== null"

                                    />
                                    <span v-if="errors" class="mt-2 text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                        {{ errors.body }}
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
