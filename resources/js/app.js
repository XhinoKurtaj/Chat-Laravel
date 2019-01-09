
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

const id=$("#convId").val();
$('#btn_send').click(function(){
    const message = $('#msgArea').val();
    console.log(message);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'post',
        url: id+'/send',
        data: {message: message},
        success:function(data){
            $('#msgArea').val(' ');
        }
    })
});
var display = $("#msgField");
window.Echo.private('conversation.'+id)
    .listen('MessageSent', event => {
        if(event.sent === 1){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: id +'/read',
                success:function(result){
                    var output = " ";
                    for(var i in result)
                    {
                        output += "<h6><strong>"+result[i].sender.fullName+"</strong></h6>"+
                            "<p>"+result[i].message+"</p><br>";
                    }
                    display.html(output);
                }
            });
        }
    });

// window.Echo.private('conversation.'+id)
//     .listen('conversationMessages', event => {
//         event.messages.forEach(function (element) {
//             console.log(element);
//             console.log(element.sender.fullName);
//             console.log(element.message);
//         });
//     });



$("#DeleteUser").click(function(){
    const choice = confirm("Are you sure u want to delete this account");
    if(choice == true){
        debugger;
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'get',
            url: 'profile/delete',
            success:function(data){
            }
        })
    }
});




