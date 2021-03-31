<template>

    <v-card>
        <v-card-title>
            <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
            ></v-text-field>
            <v-spacer></v-spacer>
        </v-card-title>

        <v-data-table
                item-key="name"
                :headers="headers"
                :items="product"
                :items-per-page="5"
                :options.sync="options"
                :server-items-length="totalCount"
                :loading="loading"
                loading-text="Loading... Please wait"
                class="elevation-1"
                :footer-props="{
                  showFirstLastPage: true,
                  firstIcon: 'mdi-arrow-collapse-left',
                  lastIcon: 'mdi-arrow-collapse-right',
                  prevIcon: 'mdi-minus',
                  nextIcon: 'mdi-plus'
                }"
        ></v-data-table>
    </v-card>

</template>

<script>
    import {mapGetters} from 'vuex';
    import {mapMutations} from 'vuex';
    import { VDataTable, VCard, VCardTitle, VSpacer, VTextField } from 'vuetify/lib'

    export default {
        name: 'ProductList',
        components: { VDataTable, VCard, VCardTitle, VSpacer, VTextField},
        data () {
            return {
                headers: [
                    {
                        text: 'id',
                        align: 'start',
                        sortable: false,
                        value: 'id',
                    },
                    { text: 'Name', value: 'name' }
                ],
                search: '',
                totalCount: 0,
                options: {},
                loading: false,
                error: null,
            }
        },
        computed: {
            ...mapGetters({
                product: 'product/items'
            })
        },
        watch: {
            options: {
                handler () {
                    this.fetchData();
                },
                deep: true,
            },
        },
        methods:{
            fetchData() {
                const { sortBy, sortDesc, page, itemsPerPage } = this.options;

                const params = {
                    page: page,
                    pageSize: itemsPerPage
                };
                this.loading = true;

                this.$store
                    .dispatch('product/loadItems', params)
                    .then((response ) => {
                        console.log(response);
                        this.loading = false;
                        this.totalCount = response.totalCount;
                        this.pageSize = response.pageSize;
                        //this.error = null;
                    })
                    .catch(error => {
                        this.loading = false;
                        //if (error === undefined) {
                        //    this.error = 'Could not fetch blog';
                        //} else {
                        //    this.error = error.data.error;
                        //}
                    });
            }
        }
    }
</script>