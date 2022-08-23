<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import NavbarItem from './Item.vue'
import TweetButton from './TweetButton.vue'
import Me from './Me.vue'
import { HomeIcon } from '@heroicons/vue/24/solid'
import {
    HashtagIcon,
    BellIcon,
    EnvelopeIcon,
    BookmarkIcon,
    ArrowRightOnRectangleIcon,
    UserIcon,
    EllipsisHorizontalCircleIcon,
} from '@heroicons/vue/24/outline'

</script>

<template>
    <nav class="flex-col gap-5 px-2 py-4 min-h-screen justify-between items-center hidden tablet:flex">
        <div class="flex flex-col gap-5 items-center desktop:items-stretch w-full">
            <div class="px-4">
                <ApplicationLogo class="h-7"/>
            </div>
            <div class="space-y-3">
                <NavbarItem
                    :icon="HomeIcon"
                    name="Home"
                    :active="true"
                    :href="route('timeline')"
                />
                <NavbarItem :icon="HashtagIcon" name="Explore" :active="false"/>
                <NavbarItem :icon="BellIcon" name="Notifications" :active="false"/>
                <NavbarItem :icon="EnvelopeIcon" name="Messages" :active="false"/>
                <NavbarItem :icon="BookmarkIcon" name="Bookmarks" :active="false"/>
                <NavbarItem
                    :icon="UserIcon"
                    name="Profile"
                    :active="false"
                    :href="route('profile.show')"
                />
                <NavbarItem
                    :icon="ArrowRightOnRectangleIcon"
                    name="Logout"
                    :active="false"
                    :href="route('logout')"
                    :post="true"
                />
                <NavbarItem :icon="EllipsisHorizontalCircleIcon" name="More" :active="false"/>
            </div>
            <TweetButton/>
        </div>
        <Me/>
    </nav>
</template>
