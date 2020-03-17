/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import CKEditor from '@ckeditor/ckeditor5-vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('article-component', require('./components/ArticleTableComponent').default);
Vue.component('title-component', require('./components/TitleComponent').default);
Vue.component('wysiwyg', require('./components/Wysiwyg').default);
Vue.component('user-edit-component', require('./components/UserEditComponent').default);
Vue.component('role-edit-component', require('./components/RoleEditComponent').default);
Vue.use(CKEditor);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
