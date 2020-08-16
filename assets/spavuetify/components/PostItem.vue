<template>

    <article class="post">
        <header>
            <span>{{ translation.authorName }}</span>
        </header>
        <h2>
            <router-link :to="{
                name: 'post',
                params: { slug: translation.slug }
            }">
                {{ translation.title }}
            </router-link>
        </h2>
    </article>

</template>

<script>
    import i18n from './../plugins/i18n';

    export default {
        name: 'PostItem',
        props: ['post'],
        data(){
            return {
            }
        },
        computed: {
            translation(){
                if(!this.post){
                    return {}
                }
                return this.post.translation[i18n.locale];
            }
        }
    };
</script>