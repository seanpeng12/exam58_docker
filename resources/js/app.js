/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('example-component', require('./components/Post.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#newapp',
    // 此處為數據綁定(content)
    // 條件判斷(content_1)
    // lst=渲染
    // lst2=對象渲染
    data: {
        content: 'hello vue',
        content_1: false,
        type: 'b',

        lst: [{
            text: '台北'
        }, 0, {
            text: '桃園'
        }, {
            text: '新竹'
        }],
        lst2: {
            // index ,key , value
            firstname: 'name',
            listname: '彭',
            age: 50
        }
    },

});
