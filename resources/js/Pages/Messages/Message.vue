<script setup>
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    message: Object,
    to: Object
})
const page = usePage();
</script>

<template>
    <div
        class="flex items-start max-w-lg pt-3 space-x-3"
        :class="message.to === page.props.auth.user.id && 'self-end'"
    >
        <img
            :src="`/images/users/user${message.from}.jpg`"
            class="w-12 h-12 ml-3 rounded-full"
            :class="message.to === page.props.auth.user.id && 'order-2'"
        />
        <div class="flex-1 order-1">
            <div
                class="px-4 py-4 rounded-md lg:px-6 lg:pb-6"
                :class="message.to === page.props.auth.user.id
                    ? 'bg-indigo-400 text-white'
                    : 'bg-gray-200'"
            >
                <p class="block text-sm">{{ message.body }}</p>
            </div>
        </div>
    </div>
</template>
