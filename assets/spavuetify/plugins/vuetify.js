import Vue from 'vue'
import Vuetify, { VApp, VLayout } from 'vuetify/lib'
//import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.min.css'

Vue.use(Vuetify, {
    components: { VApp, VLayout },
})

const opts = {}

export default new Vuetify(opts)