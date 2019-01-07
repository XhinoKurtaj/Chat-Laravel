
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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('message-list', require('./components/message-list.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

const id=$("#convId").val();
var display = $("#msgField");
var output = "";

// window.Echo.private('conversation.'+id)
//     .listen('conversationMessages', event => {
//         event.messages.forEach(function (element) {
//             console.log(element);
//             console.log(element.sender.fullName);
//             console.log(element.message);
//         });
//
//     });


// const message = $("#message_text").val();
// const test = $('#testroute').val();
// $('#get').click(function(){
//     axios.get(id+'/read').then(console.log("work"));
// });





