<template>

    <div class="card m-1 p-1 bg-light">
        {{ translation.title }}

        <div class="card-text bg-white p-1">
            {{post.id}} {{ translation.authorName }}

            <button class="btn btn-dark btn-sm float-right mr-1"
                    v-on:click="onDeletePost()"
            >
                {{ $t('delete') }}
            </button>

            <button class="btn btn-dark btn-sm float-right mr-1"
                    v-on:click="onEditPost()"
            >
                {{ $t('edit') }}
            </button>
        </div>

    </div>
</template>

<script>
    import i18n from './../../plugins/i18n';
    import {mapMutations} from 'vuex';

    export default {
        name: 'PostEditItem',
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
        },
        methods:{
            onEditPost(){
                this.$router.push(`/dashboard/edit/${this.post.id}`);
            },
            onDeletePost(){
                this.$store
                    .dispatch('blog/deletePost', this.post)
                    .then((response) => {

                    })
                    .catch(error => {

                    });

            }
        }
    };
</script>