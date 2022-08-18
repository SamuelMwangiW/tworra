<script setup>
import tweets from "@/Data/posts.js"
import Tweet from "./Tweet/Index.vue"
</script>

<template>
    <section>
        <Tweet v-for="tweet in tweets" :key="tweet.id" :post="tweet" />
    </section>
</template>
