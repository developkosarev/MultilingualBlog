<template>
    <div class="container-fluid">
        <h1>Blog4</h1>

        <div v-if="!loaded && error == null" class="col">
            <div class="alert alert-dark">
                Load...
            </div>
        </div>
        <template v-else>
            <b-alert variant="danger" :show="error !== null" dismissible @dismissed="error = null">
                {{ error }}
            </b-alert>

            <router-link to="/dashboard/create" class="btn-sm btn-dark">
                Create post
            </router-link>

            <post-edit-item v-for="post in blog"
                 :key="post.id"
                 :post="post"
            >
            </post-edit-item>

        </template>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import postEditItem from './PostEditItem.vue';

    export default {
        name: 'PostListEdit',
        components: {
            postEditItem
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
                loaded:  'blog/itemsLoaded'
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
                        //this.$router.push('/notFound');

                        this.error = error.message;
                    });
            }
        }
    };
</script>