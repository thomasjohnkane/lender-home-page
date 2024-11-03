<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {format, formatRelative, subDays} from "date-fns";

defineProps({
    posts: Array,
    followers: Array,
    following: Array
})


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                        <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <div class="p-6 text-2xl text-gray-900">
                                    Blog Posts
                                    <span class="block text-sm text-gray-400">Articles you have written</span>
                                </div>
                            </div>
                            <div class="ml-4 mt-2 flex-shrink-0">
                                <PrimaryButton>
                                    <Link :href="'/posts/create'" :class="'uppercase'">
                                        Write
                                    </Link>
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div v-for="post in posts">
                            <div class="bg-white py-6 sm:py-10 border-b border-gray-100">
                                <div class="mx-auto lg:px-12">
                                    <div class="mx-auto max-w-7xl">
                                        <div class="">
                                            <article class="flex max-w-xl flex-col items-start justify-between">
                                                <div class="group relative">
                                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                                        <a href="#">
                                                            <span class="absolute inset-0"></span>
                                                            {{ post.name }} 0
                                                        </a>
                                                    </h3>
                                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                                        {{ post.body }}
                                                    </p>
                                                    <div class="flex items-center gap-x-4 text-xs pt-2">
                                                        <time datetime="{{ format(post.created_at, 'dd MM, yyyy') }}" class="text-gray-400">Published {{ formatRelative(subDays(post.created_at, 3), post.created_at) }}</time>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                        <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <div class="p-6 text-2xl text-gray-900">
                                    Followers
                                    <span class="block text-sm text-gray-400">People who watch you</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-12">
                        <ul role="list" class="divide-y divide-gray-100">
                            <li class="flex justify-between gap-x-6 py-5" v-for="user in followers">
                                <div class="flex min-w-0 gap-x-4">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ user.name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ user.email }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm leading-6 text-gray-900">Block (coming soon)</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                        <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <div class="p-6 text-2xl text-gray-900">
                                    Following
                                    <span class="block text-sm text-gray-400">People you watch</span>
                                </div>
                            </div>

                            <div class="ml-4 mt-2 flex-shrink-0">
                                <PrimaryButton>
                                    <Link :href="'/users'" :class="'uppercase'">
                                        Search
                                    </Link>
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                    <div class="px-6">
                        <ul role="list" class="divide-y divide-gray-100">
                            <li class="flex justify-between gap-x-6 py-5" v-for="user in following">
                                <div class="flex min-w-0 gap-x-4">
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ user.name }}</p>
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ user.email }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <SecondaryButton>
                                        <Link :href="'/users/unfollow/' + user.id" :class="'uppercase'">
                                            Unfollow
                                        </Link>
                                    </SecondaryButton>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
