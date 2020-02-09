<template>
    <nav>
        <ul>
            <li v-for="category in categories" v-bind:key="category.id" class="pt-2">
                <a class="text-lg font-bold" v-on:click="expandedCategoryId = category.id">
                    {{ category.name }}
                </a>
                <ul>
                    <li v-for="post in category.posts" v-bind:key="post.id">
                        <a
                            v-bind:href="'#' + post.slug"
                            class="border-l-4 pl-4 border-white"
                            v-on:click="$emit('transition-to', post.slug, true)"
                            v-bind:class="{'border-green-700': currentSlug == post.slug}"
                        >
                            {{ post.menu_label }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
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
            },
            currentSlug: {
                type: String
            }
        },
        computed: {
            expandedCategory: function () {
                return this.categoryById(this.expandedCategoryId);
            }
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
