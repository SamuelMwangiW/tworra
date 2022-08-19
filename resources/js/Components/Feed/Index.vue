<script setup>
import {computed, onBeforeUnmount, onMounted, ref, watch} from 'vue'
import {debounce} from 'lodash'
import Tweet from "./Tweet/Index.vue"

const props = defineProps({
    tweets: Object
})
const userTweets = ref(null)
const noNextPage = computed(() => userTweets.value.links.next === null)
userTweets.value = props.tweets;

const getScrollPosition = debounce(() => {
    const pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight
    if (pixelsFromBottom > 200) {
        return
    }
    if (!userTweets.value.links.next) {
        return
    }
    axios.get(userTweets.value.links.next)
        .then(function (response) {
            userTweets.value = {
                data: [...userTweets.value.data, ...response.data.data],
                links: response.data.links,
            }
        })
}, 100)
watch(() => props.tweets, (newTweets, oldValue) => userTweets.value = newTweets)
onMounted(() => window.addEventListener('scroll', getScrollPosition))
onBeforeUnmount(() => window.removeEventListener('scroll', getScrollPosition))
</script>

<template>
    <section>
        <Tweet v-for="tweet in userTweets.data" :key="tweet.id" :post="tweet" />
        <p class="text-center pt-4 font-semibold tracking-tight" v-if="noNextPage">No more tweets...</p>
    </section>
</template>
