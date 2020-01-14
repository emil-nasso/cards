<template>
    <div>
        <div v-for="category in categories" v-bind:key="category.id" class="pb-8 mx-2">
            <h2 class="text-2xl">{{ category.name }}</h2>
            <div class="flex flex-wrap -mx-2">
                <div class="mb-4 w-full px-2 lg:w-1/2 lg:flex" v-for="post in category.posts" v-bind:key="post.id">
                    <div v-if="post.image" class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                        v-bind:style="bgStyle(post)"/>
                    <div v-bind:class="{ 'lg:border-l-0 lg:rounded-b-none' : post.image, 'border-t rounded': !post.image }" class="w-full border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <div class="flex justify-between">
                                <div class="text-gray-900 font-bold text-xl mb-2">{{ post.title }}</div>
                                <a class="group" :href="'#' + post.slug" :id="post.slug">
                                    <span class="text-gray-600 group-hover:text-gray-800 group-hover:underline">#</span><span class="text-gray-500 group-hover:text-gray-800 group-hover:underline">{{ post.slug }}</span>
                                </a>
                            </div>
                            <p class="text-gray-700 text-base" v-html="post.body"></p>
                        </div>
                        <div>
                            <div class="text-sm text-gray-600" v-for="attachment in post.attachments" v-bind:key="attachment.id">
                                <span class="italic">{{ attachment.description }}</span> - <a :href="attachment.url" class="text-gray-400 underline">{{ attachment.label }}</a>
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
        },
        methods: {
            bgStyle: function(post) {
                return 'background-image: url(\'' + post.image.custom_properties.url + '\')';
            }
        }
    }
</script>
