import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

const messages = {
    'en': {
        welcomeMsg: 'Welcome',
        about: 'About',
        edit: 'Edit',
        delete: 'Delete',
        title:'Title',
        slug: 'Slug',
        authorName: 'Author name',
        postText: 'Post Text'
    },
    'de': {
        welcomeMsg: 'Willkommen',
        about: 'Über',
        edit: 'Bearbeiten',
        delete: 'Löschen',
        title: 'Titel',
        slug: 'Slug',
        authorName: 'Author name',
        postText: 'Post text'
    }
};

const i18n = new VueI18n({
    locale: 'en',
    fallbackLocale: 'de',
    messages,
});

export default i18n;