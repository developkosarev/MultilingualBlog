<template>
    <div>
        <h2>Post</h2>

        <div v-if="!postLoaded" class="col">
            <div class="alert alert-dark">
                Loading...
            </div>
        </div>
        <template v-else>

            <div v-if="post !== null" class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ translation.title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ translation.authorName }}</h6>
                    <div class="card-text" v-html='translation.postText'></div>
                </div>
            </div>

            <template v-else>
                <div class="alert alert-dark">
                    Post not found
                </div>
            </template>

        </template>

    </div>
</template>

<script>
    import i18n from './../plugins/i18n';
    import {mapGetters} from 'vuex';

    export default {
        name: 'PostShow',
        created() {
            this.fetchData(this.$route.params.slug);
        },
        beforeRouteUpdate (to, from, next) {
            this.fetchData(to.params.slug);
            next()
        },
        data(){
            return {
                post: null,
                postLoaded: false
            }
        },
        computed: {
            translation(){
                if(!this.post){
                    return {}
                }
                return this.post.translation[i18n.locale]; //post.translation[currentLocale].title
            }
        },
        methods: {
            fetchData(slug) {
                this.post = null;
                this.postLoaded = false;

                this.$store
                    .dispatch('blog/loadPostSlug', slug)
                    .then((response ) => {
                        this.post = response;
                    })
                    .catch(error => {
                        //this.$router.push('/notFound');
                    })
                    .finally(() => {
                        this.postLoaded = true;
                    });
            }
        }
    };
</script>