<template>
    <div>
        <h1>Page not found</h1>
        <router-link :to="{name: 'root'}">
            Start from main page
        </router-link>
        <div>Some text</div>
    </div>
</template>

<script>
    export default {
        name: 'NotFound',
        data(){
            return {
            }
        }
    }
</script>