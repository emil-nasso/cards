<template>
    <div>
        <div v-for="category in categories" v-bind:key="category.id" class="pb-8 mx-2">
            <h2 class="text-2xl">{{ category.name }}</h2>
            <div class="flex flex-wrap -mx-2">
                <div class="mb-4 w-full px-2 lg:w-1/2 lg:flex" v-for="post in category.posts" v-bind:key="post.id">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                        style="background-image: url('https://via.placeholder.com/150')"/>
                    <!-- <img class="rounded" v-if="post.image" :src="post.image.custom_properties.url"/> -->
                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <div class="text-gray-900 font-bold text-xl mb-2">{{ post.title }}</div>
                            <p class="text-gray-700 text-base" v-html="post.body"></p>
                        </div>
                        <div class="flex items-center">
                            <div v-for="attachment in post.attachments" v-bind:key="attachment.id">
                                    <a :href="attachment.url" class="text-gray-400 text-sm underline">{{ attachment.label }}</a>
                            </div>
                        </div>
                    </div>
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
