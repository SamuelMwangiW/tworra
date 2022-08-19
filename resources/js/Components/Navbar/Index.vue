<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import NavbarItem from './Item.vue'
import TweetButton from './TweetButton.vue'
import Me from './Me.vue'
import { HomeIcon } from '@heroicons/vue/solid'
import {
    HashtagIcon,
    BellIcon,
    MailIcon,
    BookmarkIcon,
    ViewListIcon,
    LogoutIcon,
    UserIcon,
    DotsCircleHorizontalIcon,
} from '@heroicons/vue/outline'

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
                <NavbarItem :icon="MailIcon" name="Messages" :active="false"/>
                <NavbarItem :icon="BookmarkIcon" name="Bookmarks" :active="false"/>
<!--                <NavbarItem :icon="ViewListIcon" name="Lists" :active="false"/>-->
                <NavbarItem
                    :icon="UserIcon"
                    name="Profile"
                    :active="false"
                    :href="route('profile.show')"
                />
                <NavbarItem
                    :icon="LogoutIcon"
                    name="Logout"
                    :active="false"
                    :href="route('logout')"
                    :post="true"
                />
                <NavbarItem :icon="DotsCircleHorizontalIcon" name="More" :active="false"/>
            </div>
            <TweetButton/>
        </div>
        <Me/>
    </nav>
</template>
