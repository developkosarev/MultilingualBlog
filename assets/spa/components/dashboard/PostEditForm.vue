<template>
    <div class="container">
        <h2>{{ editMode ? "Edit Post" : "Create Product" }}</h2>

        <div v-if="!postLoaded" class="alert alert-dark">
            Loading...
        </div>

        <template v-else>
            <b-alert variant="danger" :show="error !== null" dismissible @dismissed="error = null">
                {{ error }}
            </b-alert>

            <b-form v-if="post !== null" @submit.prevent="onSubmit" @reset="onReset">

                <b-form-group id="input-group-1" label="Author email address:" label-for="input-1">
                    <b-form-input
                            id="input-1"
                            v-model.trim="post.authorEmail"
                            type="email"
                            required
                            placeholder="Enter Author email"
                            @input="$v.post.authorEmail.$touch()"
                            @blur="$v.post.authorEmail.$touch()"
                            :state="post.authorEmail === null ? null : !$v.post.authorEmail.$error"
                    ></b-form-input>

                </b-form-group>

                <b-tabs content-class="mt-3">
                    <b-tab v-for="entry in languages"
                                     :key="entry.flag"
                                     :title="entry.title"
                    >
                        <b-form-group v-for="(field, index) in info"
                                      :key="field.name+entry.flag"
                                      :id="'input-group-'+field.name+'-'+entry.flag"
                                      :label="$t(field.name)"
                                      :label-for="'input-'+field.name+'-'+entry.flag"
                        >

                            <template v-if="field.editor">
                                <vue-editor
                                        v-model="post.translation[entry.flag][field.name]"
                                        :editorToolbar="customToolbar"
                                />
                            </template>
                            <template v-else>

                                <b-form-input
                                        :id="'input-'+field.name+'-'+entry.flag"
                                        v-model.trim="post.translation[entry.flag][field.name]"
                                        :placeholder="field.name"
                                        @input="$v.post.translation[entry.flag][field.name].$touch()"
                                        @blur="$v.post.translation[entry.flag][field.name].$touch()"
                                        :state="post.translation[entry.flag][field.name] === null ? null : !$v.post.translation[entry.flag][field.name].$error"

                                ></b-form-input>

                            </template>

                        </b-form-group>


                    </b-tab>
                </b-tabs>

                <b-button type="submit" variant="dark">
                    {{ editMode ? 'Save Changes' : 'Save new Post'}}
                </b-button>

                <router-link to="/dashboard"
                    class="btn btn-dark m-1">Cancel
                </router-link>
            </b-form>

            <template v-else>
                <div class="alert alert-dark">
                    Post not found
                </div>
            </template>

        </template>

    </div>
</template>

<script>
    import { required, minLength, maxLength } from 'vuelidate/lib/validators';
    import appLanguages from './../../plugins/appLanguages';
    import {VueEditor} from 'vue2-editor';
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'PostEditForm',
        components: {
            VueEditor
        },
        created() {
            if (this.editMode) {
                this.fetchData(this.$route.params.id);
            } else {
                let newPost = {
                    authorEmail: null,
                    translation: {}
                };

                appLanguages.forEach(entry => {
                    newPost.translation = { ...newPost.translation, [entry.flag]: {} }

                    let fields = {}
                    this.info.forEach(item => {
                        fields = { ...fields, [item.name]: null }
                    })
                    newPost.translation[entry.flag] = fields;
                })

                this.post = newPost;
                this.postLoaded = true
            }
        },
        beforeRouteUpdate (to, from, next) {
            this.fetchData(to.params.id);
            next()
        },
        data(){
            return {
                customToolbar: [["bold", "italic", "underline"], [{ list: "ordered" }, { list: "bullet" }], ["code-block"]],

                info: [
                    {
                        name: 'title',
                        editor: false,
                        validate: {
                            required,
                            minLength: minLength(1)
                        }
                    },
                    {
                        name: 'slug',
                        editor: false,
                        validate: {
                            required,
                            minLength: minLength(1)
                        }
                    },
                    {
                        name: 'authorName',
                        editor: false,
                        validate: {
                            required,
                            minLength: minLength(1)
                        }
                    },
                    {
                        name: 'postText',
                        editor: true,
                        validate: {
                            required,
                            minLength: minLength(1)
                        }
                    }
                ],

                post: null,
                postLoaded: false,

                error: null
            }
        },
        computed: {
            languages(){
                return appLanguages
            },
            editMode() {
                return this.$route.params['op'] == 'edit';
            },
        },
        validations() {
            let dynValidations = {
                post: {
                    authorEmail: {
                        required,
                        minLength: minLength(6)
                    },
                    translation: {}
                }
            };

            appLanguages.forEach(entry => {
                dynValidations.post.translation = { ...dynValidations.post.translation, [entry.flag]: {} }

                let fields = {}
                this.info.forEach(item => {
                    fields = { ...fields, [item.name]: item.validate }
                })
                dynValidations.post.translation[entry.flag] = fields;
            })

            return dynValidations
        },
        methods: {
            fetchData(id) {
                this.post = null;
                this.postLoaded = false;

                this.$store
                    .dispatch('blog/loadPost', id)
                    .then((response ) => {
                        this.post = response;
                        this.error = null;
                    })
                    .catch(error => {
                        this.error = error.message;
                    })
                    .finally(() => {
                        this.postLoaded = true;
                    });
            },

            onSubmit(){
                this.$v.$touch();
                if (!this.$v.$invalid) {

                    if (this.editMode) {
                        this.$store
                            .dispatch('blog/updatePost', this.post)
                            .then((response) => {

                            })
                            .catch(error => {
                                if (error === undefined) {
                                    this.error = 'Could not fetch post';
                                } else {
                                    console.log(error);
                                }
                            });
                    } else {
                        this.$store
                            .dispatch('blog/addPost', this.post)
                            .then((response) => {

                            })
                            .catch(error => {
                                //console.log(error);
                            });
                    }
                    this.$router.push("/dashboard");
                } else {
                    this.error = 'Values Required for All Fields';
                }
            },
            onReset(){

            }
        }
    };
</script>