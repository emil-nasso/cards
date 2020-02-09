<template>
    <nav>
        <div class="flex items-center justify-between flex-wrap bg-green-700 px-6">
            <a href="/" class="flex items-center flex-shrink-0 text-white mr-6">
                <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
                <span class="font-semibold text-xl tracking-tight">🌱.ninja🧟.se</span>
            </a>
            <div class="block lg:hidden">
                <button v-on:click="isExpanded = !isExpanded" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>

            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto lg:visible" v-bind:class="{ hidden: !isExpanded }">
                <div class="text-sm lg:flex-grow">
                    <a  v-for="category in categories"
                        v-bind:key="category.id"
                        v-bind:href="'#' + category.slug"
                        v-bind:class="{ 'bg-green-500' : category.id == expandedCategoryId}"
                        class="block pb-6 pt-4 mt-4 lg:inline-block lg:mt-2 rounded-t text-teal-200 hover:text-white px-2 "
                        v-on:click="expandedCategoryId = null"
                        v-on:mouseover="expandedCategoryId = category.id"
                    >
                        {{ category.name }}
                    </a>
                </div>
                <!-- <div>
                <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Download</a>
                </div> -->
            </div>
        </div>
        <div
            v-if="expandedCategory"
            class="flex items-center flex-wrap bg-green-500 p-6"
            v-on:mouseover="expandedCategoryId = expandedCategory.id"
            v-on:mouseleave="expandedCategoryId = null"
        >
            <a v-for="post in expandedCategory.posts"
               v-bind:key="post.id"
               v-bind:href="'#' + post.slug"
               class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4"
               v-on:click="expandedCategoryId = null"
            >
                {{ post.menu_label }}
            </a>
        </div>
    </nav>
</template>

<script>
    export default {
        data: function () {
            return {
                isExpanded: false,
                expandedCategoryId: null,
            }
        },
        props: {
            categories: {
                type: Array,
                required: true
            }
        },
        computed: {
            expandedCategory: function () {
                return this.categoryById(this.expandedCategoryId);
            }
        },
        mounted() {
            console.log(this.categories);
        },
        methods: {
            categoryById: function(categoryId) {
                if (categoryId == null) {
                    return null;
                }
                let category = this.categories.filter(category => category.id == categoryId);
                return category[0] ? category[0] : null;
            }
        }
    }
</script>
