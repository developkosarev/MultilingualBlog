<template>
    <div>
        <div class="row col">
            <h1>Chart</h1>
        </div>

        <PlanetChart/>

        <div class="row col">
            <p>Page chart</p>
        </div>
    </div>
</template>

<script>
import PlanetChart from './../components/chart/PlanetChart.vue'

export default {
    name: "Chart",
    components: {
        PlanetChart
    },
    data() {
        return {
        }
    },
};
</script>