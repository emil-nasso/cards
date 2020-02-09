<template>
    <div class="">
        <div v-for="category in categories" v-bind:key="category.id" class="pt-2 py-4 max-w-5xl">
            <h2 class="text-4xl font-bold">{{ category.name }}</h2>
            <div
                v-for="post in category.posts"
                v-bind:key="post.id"
            >
                <!-- Sroll target -->
                <div :id="post.slug+'-scroll'" class="py-2"/>
                <!-- Post -->
                <div 
                    class="border-l-8 border-white px-4 rounded flex flex-col md:flex-row"
                    :class="{'border-green-700': post.slug == currentSlug}"
                    v-on:click="$emit('transition-to', post.slug)"
                >
                    <div v-if="post.image" class="md:w-1/4 md:h-auto h-32 bg-cover bg-no-repeat bg-center mr-4 rounded"
                        v-bind:style="bgStyle(post)"
                    />
                    <div class="md:w-3/4">
                        <div>
                            <span class="text-2xl">{{ post.title }}</span>
                            <a class="group text-md text-gray-500" :href="'#' + post.slug" v-on:click="$emit('transition-to', post.slug, true)">
                                <span class="text-gray-700 group-hover:underline">#</span><span class="group-hover:underline">{{ post.slug }}</span>
                            </a>
                        </div>
                        <p class="text-gray-700 text-base" v-html="post.body"></p>
                        <div class="text-sm text-gray-600" v-for="attachment in post.attachments" v-bind:key="attachment.id">
                            <span class="italic">{{ attachment.description }}</span> - <a :href="attachment.url" class="text-gray-400 underline">{{ attachment.label }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {};
        },
        props: {
            categories: {
                type: Array,
                required: true
            },
            currentSlug: {
                type: String
            }
        },
        methods: {
            bgStyle: function(post) {
                return 'background-image: url(\'' + post.image.custom_properties.url + '\')';
            }
        }
    }
</script>
