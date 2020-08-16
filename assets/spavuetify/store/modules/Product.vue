<script>
import Vue from 'vue';
import appLanguages from './../../plugins/appLanguages';

export default {
	namespaced: true,
	state: {
		itemsProduct: [],
        itemsLoaded: false
	},
	getters: {
		items(state) {
			return state.itemsProduct;
		},
        itemsLoaded(state){
            return state.itemsLoaded;
        }
    },
	mutations: {
		setItems(state, data){
			state.itemsProduct = data
            state.itemsLoaded = true;
        },
        clearLoaded(state){
            state.itemsLoaded = false;
        }
	},
	actions: {
		loadItems(store, params){
            store.commit('clearLoaded');

            return new Promise((resolve, reject) => {
                Vue.apiService.getProduct(params.page, params.pageSize)
                    .then((response) => {
                        store.commit('setItems', response.results);
                        resolve(response);
                    }).catch(error => {
                        reject(error);
                });
            });
		}
	}
}
</script>