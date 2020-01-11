<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="post in posts" v-bind:key="post.id">
                    <div class="card-header">{{ post.title }}</div>
                    <div class="card-body" v-html="post.body"/>
                </div>
            </div>
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
