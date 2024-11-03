<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {reactive} from "vue";

const user = reactive({
    user_id: null,
})

function submit() {
    router.post('/users/follow', user)
}

defineProps({
    users: Array
});
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="pb-12">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                        >
                            <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                                <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                                    <div class="ml-4 mt-2">
                                        <div class="p-6 text-2xl text-gray-900">
                                            Users
                                            <span class="block text-sm text-gray-400">Here are all of the authors on the app</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-12">
                                <ul role="list" class="divide-y divide-gray-100">
                                    <li class="flex justify-between gap-x-6 py-5" v-for="user in users">
                                        <div class="flex min-w-0 gap-x-4">
                                            <div class="min-w-0 flex-auto">
                                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ user.name }}</p>
                                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ user.email }}</p>
                                            </div>
                                        </div>
                                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                            <PrimaryButton>
                                                <Link :href="'/users/follow/' + user.id" :class="'uppercase'">
                                                    Follow
                                                </Link>
                                            </PrimaryButton>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
