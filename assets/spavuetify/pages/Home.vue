<template>
    <div>
        <v-app-bar
                color="deep-purple accent-4"
                dense
                dark
        >
            <template v-slot:extension>
                <v-tabs align-with-title>
                    <v-tab>Tab 1</v-tab>
                    <v-tab>Tab 2</v-tab>
                    <v-tab>Tab 3</v-tab>
                </v-tabs>
            </template>

            <v-app-bar-nav-icon></v-app-bar-nav-icon>

            <!--
            <v-toolbar-title>Page title</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-menu
                    left
                    bottom
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                            icon
                            v-bind="attrs"
                            v-on="on"
                    >
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item
                            v-for="n in 5"
                            :key="n"
                            @click="() => {}"
                    >
                        <v-list-item-title>Option {{ n }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>

            -->
        </v-app-bar>

        <div class="row col">
            <h1>Welcome</h1>
        </div>

        <div class="row col">
            <p>This is the homepage of our Vue.js application.</p>
        </div>
    </div>
</template>

<script>
    import {VAppBar, VAppBarNavIcon, VToolbar, VToolbarTitle, VSpacer, VBtn, VIcon, VMenu, VList, VListItem, VTabs, VTab } from 'vuetify/lib'

    export default {
        name: "Home",
        components: { VAppBar, VAppBarNavIcon, VToolbar, VToolbarTitle, VSpacer, VBtn, VIcon, VMenu, VList, VListItem, VTabs, VTab },
        data() {
            return {
            }
        },
    };
</script>