<template>
    <div class="w-full">
        <vego-top-menu class="fixed left-0 right-0" :categories="categories"></vego-top-menu>
        <div class="flex pt-16 h-screen">
            <div class="overflow-auto pl-4 pr-8">
                <vego-sidebar :categories="categories" :currentSlug="currentSlug" v-on:transition-to="transitionTo"></vego-sidebar>
            </div>
            <main class="flex-1 overflow-auto px-4">
                <vego-posts :categories="categories" :currentSlug="currentSlug" v-on:transition-to="transitionTo"></vego-posts>
            </main>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            let hash = location.hash.substr(1)
            return {
                currentSlug: hash,
            }
        },
        mounted: function () {
            if (this.currentSlug != "") {
                this.scroll()
            }
        },
        methods: {
            transitionTo: function(slug, scroll) {
                this.currentSlug = slug
                location.hash = slug
                if (scroll) {
                    this.scroll()
                }
            },
            scroll: function() {
                if (this.currentSlug != "") {
                    document.getElementById(this.currentSlug+"-scroll").scrollIntoView();
                }
            }
        },
        props: {
            categories: {
                type: Array,
                required: true
            }
        }
    }
</script>
