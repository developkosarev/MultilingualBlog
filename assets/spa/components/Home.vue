<template>
    <div>
        <div class="row col">
            <h1>{{ $t('welcomeMsg') }}</h1>
        </div>

        <div class="row col">
            <p>This1 is the homepage of our Vue.js application.</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {
            }
        },
    };
</script>