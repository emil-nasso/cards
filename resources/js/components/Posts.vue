<template>
    <div>
        <div v-for="category in categories" v-bind:key="category.id" class="pb-8">
            <h2 class="text-2xl">{{ category.name }}</h2>
            <div class="border rounded mb-4" v-for="post in category.posts" v-bind:key="post.id">
                <div class="text-lg font-bold">{{ post.title }}</div>
                <img class="rounded" v-if="post.image" :src="post.image.custom_properties.url"/>
                <div class="" v-html="post.body"/>
                <div>
                    <ul>
                        <li v-for="attachment in post.attachments" v-bind:key="attachment.id">
                            <a :href="attachment.url" class="text-blue-500 underline">{{ attachment.label }}</a>
                        </li>
                    </ul>
                </div>
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
            console.log(this.categories);
        }
    }
</script>
