<script setup>
import {ViewBoardsIcon} from '@heroicons/vue/solid'
import Avatar from '@/Components/Avatar.vue'
import TextBox from './TextBox.vue'
import Actions from './Actions.vue'
import {useForm} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'
import {floor, min} from 'lodash'
import Spinner from '@/Components/Publisher/Spinner.vue'

const form = useForm({
    'message': ''
})
const messageIsInvalid = computed(() => {
    return form.message.length === 0 || form.message.length > 320
})
const messageProgress = computed(() => {
    const length = floor((form.message.length / 32) * 10)

    return min([100,length])
})
const postTweet = ()=> form.post('tweets',{
    onSuccess:()=>form.reset()
});
</script>

<template>
    <section class="px-4 pt-4 pb-2 grid grid-cols-[auto,1fr] gap-4 ">
        <Avatar
            :src="$page.props.auth.user.profile_photo_url"
            alt="Profile"
        />
        <form :action="route('tweets.create')" method="post" @submit.prevent="postTweet" class="space-y-2 w-full">
            <TextBox v-model="form.message"/>
            <div class="flex items-center justify-between gap-4">
                <div
                    class="hover:bg-sky-100 p-2 rounded-full transition-colors duration-500 ease-out cursor-pointer mobile:hidden">
                    <ViewBoardsIcon class="w-5 h-5 text-sky-500"/>
                </div>
                <Actions/>
                <spinner :percent="messageProgress" class="w-8 h-8" v-if="form.message"/>
                <button
                    :disabled="messageIsInvalid"
                    class="bg-sky-500 hover:bg-sky-400 hover-transition px-5 py-2 text-white font-bold rounded-full w-full mobile:w-auto disabled:opacity-25">
                    Tweet
                </button>
            </div>
        </form>
    </section>
</template>
