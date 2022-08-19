<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import Avatar from '@/Components/Avatar.vue'
import TweetHeading from './Heading.vue'
import TweetActions from './Actions.vue'

defineProps({
    post: {type: Object, required: true}
})
</script>

<template>
    <div
        class="border-t-[0.5px] dark:border-slate-600 px-4 pt-3 pb-2 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors duration-500 ease-out">
        <div class="grid grid-cols-[auto,1fr] gap-3">
            <Link :href="route('show-user-profile',{user:post.user.username})">
                <Avatar :src="post.user.profilePhotoUrl" :alt="post.user.username"/>
            </Link>
            <div>
                <TweetHeading :name='post.user.name' :username='post.user.username' :time='post.time'/>
                <p>{{ post.message }}</p>
                <TweetActions
                    :replies='post.replies'
                    :retweets='post.retweets'
                    :likes='post.likes'
                    :liked='post.liked'
                    :tweet-id="post.id"
                />
            </div>
        </div>
    </div>
</template>
