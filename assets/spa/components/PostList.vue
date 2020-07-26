<template>
    <div class="container-fluid">
        <h1>Blog</h1>

        <div v-if="!loaded" class="col">
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <template v-else>
            <b-alert variant="danger" :show="error !== null" dismissible @dismissed="error = null">
                {{ error }}
            </b-alert>

            <post-item v-for="post in blog"
                 :key="post.id"
                 :post="post"
            >
            </post-item>

        </template>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import {mapMutations} from 'vuex';
    import postItem from './PostItem.vue';

    export default {
        name: 'PostList',
        components: {
            postItem
        },
        created(){
            this.fetchData();
        },
        data(){
            return {
                totalCount: 0,
                totalPages: 0,
                currentPage: 1,
                pageSize: 1,
                error: null
            }
        },
        computed: {
            ...mapGetters({
                blog:    'blog/items',
                loaded:  'blog/itemsLoaded',
            })
        },
        methods:{
            fetchData() {
                this.$store
                    .dispatch('blog/loadItems')
                    .then((response ) => {
                        //this.totalCount = response.data.totalCount;
                        //this.totalPages = response.data.totalPages;
                        //this.pageSize = response.data.pageSize;
                        this.error = null;
                    })
                    .catch(error => {

                        if (error === undefined) {
                            this.error = 'Could not fetch blog';
                        } else {
                            this.error = error.data.error;
                        }
                    });
            }
        }
    };
</script>