<template>
    <b-navbar toggleable="md" type="dark" variant="dark">
        <b-navbar-brand to="/">Blog</b-navbar-brand>
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-collapse is-nav id="nav_collapse">

            <b-navbar-nav class="ml-auto" >
                <b-nav-item to="/">{{ $t('about') }}</b-nav-item>
                <b-nav-item to="/blog">Blog</b-nav-item>
                <b-nav-item to="/dashboard">Dashboard</b-nav-item>

                <nav-bar-lang></nav-bar-lang>
            </b-navbar-nav>

        </b-collapse>
    </b-navbar>
</template>

<script>
    import navBarLang from './NavBarLang.vue';

    export default {
        name: 'NavBar',
        components: {
            navBarLang
        },
        data(){
            return {}
        }
    }
</script>