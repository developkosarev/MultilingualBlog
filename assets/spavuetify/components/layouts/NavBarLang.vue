<template>
    <b-nav-item-dropdown v-bind:text="currentLocaleTitle" right>

        <b-dropdown-item v-for="entry in languages"
                         :key="entry.flag"
                         v-on:click.native="onClick(entry.language)"
                         href="#">
            {{entry.title}}
        </b-dropdown-item>
    </b-nav-item-dropdown>

</template>

<script>
    import i18n from './../../plugins/i18n';
    import appLanguages from './../../plugins/appLanguages';

    export default {
        name: 'NavBarLang',
        computed: {
            languages(){
                return appLanguages
            },
            currentLocaleTitle(){
                return i18n.locale.toUpperCase();
            },
        },
        methods: {
            onClick(locale){
                i18n.locale = locale;
            },
        }
    }
</script>