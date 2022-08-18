<script setup>
import Tweet from "./Tweet/Index.vue"

defineProps({
    tweets: Array
})
</script>

<template>
    <section>
        <Tweet v-for="tweet in tweets" :key="tweet.id" :post="tweet" />
    </section>
</template>
