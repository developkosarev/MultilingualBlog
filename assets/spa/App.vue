<template>
    <div id="app">
        <nav-bar></nav-bar>
        <router-view/>
    </div>
</template>

<script>
    import navBar from './components/layouts/NavBar.vue';

    export default {
        name: 'App',
        components: {
            navBar
        },
        data() {
            return {
                title: 'Blog'
            }
        }
    }
</script>