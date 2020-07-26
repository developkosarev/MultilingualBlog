<script>
import Vue from 'vue';
import appLanguages from './../../plugins/appLanguages';

export default {
	namespaced: true,
	state: {
		itemsBlog: [],
        itemsLoaded: false
	},
	getters: {
		items(state) {
			return state.itemsBlog;
		},
        itemsLoaded(state){
            return state.itemsLoaded;
        },
        getItemById: (state) => (id) => {
            return state.itemsBlog.find(element => {
                return element.id == id;
            })
        },
        getItemBySlug: (state) => (slug) => {
            return state.itemsBlog.find(element => {

                let res = null;
                appLanguages.forEach(entry => {
                    if (element.translation[entry.flag].slug == slug){
                        res = element;
                    }
                })

                if (res !== null ){
                    return element;
                }
            })
        }
    },
	mutations: {
		setItems(state, data){
			state.itemsBlog = data
            state.itemsLoaded = true;

        },
        addItem(state, post) {
            state.itemsBlog.unshift(post);
        },
        updateItem(state, post) {
            const index = state.itemsBlog.findIndex(element => element.id == post.id)

            if (index > -1){
                Vue.set(state.itemsBlog, index, post);
            }
        },
        deleteItem(state, post){
            const index = state.itemsBlog.indexOf(post);

            if (index > -1){
                state.itemsBlog.splice(index, 1);
            }
        }
	},
	actions: {
		loadItems(store, params){
            if(!store.state.itemsLoaded) {

                return new Promise((resolve, reject) => {
                    Vue.apiService.getBlog()
                        .then((response) => {
                            store.commit('setItems', response);
                            resolve(response);
                        }).catch(error => {
                            reject(error);
                    });
                });
            }
		},
        loadPostSlug(store, slug){
            const post = store.getters.getItemBySlug(slug);

            if (post) {
                return post;
            } else {
                return new Promise((resolve, reject) => {
                    Vue.apiService.getPostSlug(slug)
                        .then((response) => {
                            resolve(response);
                        }).catch(error => {
                            reject(error);
                    });
                });
            }
        },
        loadPost(store, id){
            const post = store.getters.getItemById(id);
            if (post) {
                return post;
            } else {
                return new Promise((resolve, reject) => {
                    Vue.apiService.getPost(id)
                        .then((response) => {
                            resolve(response);
                        }).catch(error => {
                        reject(error);
                    });
                });
            }
        },
        addPost(store, post){
            return new Promise((resolve, reject) => {
                Vue.apiService.addPost(post)
                    .then((response) => {
                        post.id = response.id;
                        store.commit('addItem', post);
                        resolve(response);
                    }).catch(error => {
                        reject(error);
                    });

            });
        },
        updatePost(store, post){
            return new Promise((resolve, reject) => {
                Vue.apiService.updatePost(post)
                    .then((response) => {
                        store.commit('updateItem', post);
                        resolve(response);
                    }).catch(error => {
                        reject(error);
                    });

            });
        },
        deletePost(store, post){
            return new Promise((resolve, reject) => {
                Vue.apiService.deletePost(post.id)
                    .then((response) => {
                        store.commit('deleteItem', post);
                        resolve(response);
                    }).catch(error => {
                        reject(error);
                    });

            });
        }
        /*
        async removePost(store, post){
            try {
                let response = await Vue.apiService.deletePost(post.id);
                store.commit("removeItem", post);

                return response;
            } catch(error) {
                throw error.response
            }
        }*/
	}
}
</script>