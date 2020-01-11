<template>
    <div>
        <div v-for="category in categories" v-bind:key="category.id" class="pb-8">
            <h2 class="text-2xl">{{ category.name }}</h2>
            <div class="border rounded mb-4" v-for="post in category.posts" v-bind:key="post.id">
                <div class="text-lg font-bold">{{ post.title }}</div>
                <div class="" v-html="post.body"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            categories: {
                type: Array,
                required: true
            }
        },
        mounted() {
            console.log(this.posts);
        }
    }
</script>
