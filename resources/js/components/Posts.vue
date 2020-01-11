<template>
    <div>
        <div class="border rounded" v-for="post in posts" v-bind:key="post.id">
            <div class="text-lg font-bold">{{ post.title }}</div>
            <div class="" v-html="post.body"/>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            posts: {
                type: Array,
                required: true
            }
        },
        mounted() {
            console.log(this.posts);
        }
    }
</script>
