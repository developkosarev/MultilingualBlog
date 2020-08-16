import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import blog from './modules/Blog'
import product from './modules/Product'

export default new Vuex.Store({
    modules:{
        blog,
        product
    }
})
