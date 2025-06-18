<script setup>
import {Link} from '@inertiajs/vue3'
import Avatar from '@/Components/Avatar.vue'
import TweetHeading from './Heading.vue'
import TweetActions from './Actions.vue'

defineProps({
    post: {type: Object, required: true}
});

</script>

<template>
    <div
        class="border-t-[0.5px] dark:border-slate-600 px-4 pt-3 pb-2 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors duration-500 ease-out">
        <div class="grid grid-cols-[auto_1fr] gap-3">
            <Link :href="route('show-user-profile',{user:post.user.username})">
                <Avatar :src="post.user.profilePhotoUrl" :alt="post.user.username"/>
            </Link>
            <div>
                <TweetHeading
                    :id="post.id"
                    :name='post.user.name'
                    :username='post.user.username'
                    :time='post.time'
                />
                <Link :href="route('tweet.show',{user:post.user.username,tweet:post.id})">
                    {{ post.message }}
                </Link>
                <TweetActions
                    :replies='post.replies'
                    :retweets='post.retweets'
                    :likes='post.likes'
                    :liked='post.liked'
                    :retweeted='post.retweeted'
                    :tweet-id="post.id"
                />
            </div>
        </div>
    </div>
</template>
