<template>
    <div class="container-fluid">
        <h1>Blogs</h1>

        <div v-if="!itemsLoaded" class="col">
            <div class="alert alert-success">
                Load...
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
    import i18n from './../plugins/i18n';
    import {mapGetters} from 'vuex';
    import {mapMutations} from 'vuex';
    import postItem from './PostItem.vue';

    export default {
        name: 'Blog',
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
                itemsLoaded: false,
                error: null
            }
        },
        computed: {
            ...mapGetters({
                blog:    'blog/items'
            }),
            currentLocale(){
                return i18n.locale;
            },
        },
        methods:{
            fetchData() {
                this.itemsLoaded = false;

                this.$store
                    .dispatch('blog/loadItems')
                    .then((response ) => {
                        //this.totalCount = response.data.totalCount;
                        //this.totalPages = response.data.totalPages;
                        //this.pageSize = response.data.pageSize;
                        this.itemsLoaded = true;
                        this.error = null;
                    })
                    .catch(error => {
                        this.itemsLoaded = true;
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