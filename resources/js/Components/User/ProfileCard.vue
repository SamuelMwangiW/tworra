<script setup>
import {LocationMarkerIcon, LinkIcon, CalendarIcon} from '@heroicons/vue/outline'
import {Link} from '@inertiajs/inertia-vue3'

const props = defineProps({
    user: Object
})
</script>

<template>
    <div class="shrink-0 mt-8">
        <div class="p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="">
                    <img :src="user.data.profilePhotoUrl"
                         alt=""
                         class="shrink-0 h-32 w-32 mb-3 rounded-full object-cover"
                    />
                    <h4 class="text-lg font-semibold">
                        {{ user.data.name }}
                    </h4>
                    <h5 class="text-gray-600">{{ `@${user.data.username}` }}</h5>
                </div>

                <div class="" v-if="user.data.id !== $page.props.auth.user.id">
                    <Link
                        :href="route('follow.destroy',user.data.username)"
                        method="DELETE"
                        v-if="user.data.following"
                        class="px-4 py-2 rounded-full border border-gray-500 hover:bg-rose-500 dark:hover:bg-neutral-600">
                        Unfollow
                    </Link>
                    <Link
                        :href="route('follow.create',user.data.username)"
                        method="POST"
                        v-if="!user.data.following"
                        class="px-4 py-2 rounded-full border border-gray-500 hover:bg-rose-500 dark:hover:bg-neutral-600">
                        Follow
                    </Link>
                </div>

                <div class="" v-else>
                    <Link
                        :href="route('profile.show')"
                        class="text-blue-500 rounded-full border border-blue-500 h-10 px-4 py-2 font-bold hover:bg-gray-100"
                    >Edit Profile
                    </Link>
                </div>
            </div>

            <div class="mb-3 leading-tight text-gray-700 dark:text-neutral-200">
                <p>{{ user.data.description }}</p>
            </div>
            <div class="my-3 grid grid-cols-3 overflow-hidden items-center space-x-4">
                <span class="text-sm tracking-tight text-gray-600 flex gap-1">
                    <LocationMarkerIcon class="w-5"/>
                    <span class="truncate" :title="user.data.location">{{ user.data.location }}</span>
                </span>
                <span class="text-sm tracking-tight text-gray-600 flex gap-1">
                    <LinkIcon class="w-5"/>
                    <a :href="user.data.url" :title="user.data.url" class="truncate">{{ user.data.url }}</a>
                </span>
                <span class="text-sm tracking-tight text-gray-600 flex gap-1">
                    <CalendarIcon class="w-5"/>
                    <span class="truncate" :title="user.data.joined">{{ user.data.joined }}</span>
                </span>
            </div>

            <div class="flex mb-3 text-xs tracking-tight">
                <div class="mr-4">
                    <Link :href="route('following',{user:user.data.username})" class="hover:underline font-bold">
                        {{ user.data.following_count }} <span class="text-gray-500">Following</span>
                    </Link>
                </div>
                <div>
                    <Link :href="route('followers',{user:user.data.username})" class="hover:underline font-bold">
                        {{ user.data.followers_count }} <span class="text-gray-500">Followers</span>
                    </Link>
                </div>
            </div>

            <div class="flex items-center">
                <div class="flex flex-row-reverse ml-1 mr-3 shrink-0">
                    <img src="https://placekitten.com/300/300"
                         alt="" class="w-6 h-6 -ml-2 mt-1 border border-white rounded-full object-cover">
                    <img src="https://placekitten.com/301/301"
                         alt="" class="w-6 h-6 -ml-2 mt-1 border border-white rounded-full object-cover">
                    <img src="https://placekitten.com/302/302"
                         alt="" class="w-6 h-6 -ml-2 mt-1 border border-white rounded-full object-cover">
                </div>
                <div class="leading-tight">
                    <a href="#" class="text-xs tracking-tight text-gray-500 hover:underline">
                        Followed by Bill Gates, Elon Musk, and 28 others you follow
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
