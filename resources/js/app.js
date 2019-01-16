
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
const notification = $("#User-notification");
const display = $("#message-display");

///////////////////////////////
const memeberDisplay = $("#showMemberList");
var counter = 1;
//////////////////////////////

$('#btn_send').click(function(){
    const message = $('#msgArea').val();
    const attachment = $('#attachment').val();
    console.log(attachment);
    console.log(message);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'post',
        url: id+'/send',
        data: {message: message,
                attachment: attachment,},
        success:function(data){

            console.log(data.attachment);
            $('#msgArea').val(" ");
        }
    })
});

/////////////////////////////////////////////////////////////////////////////////////
$(window).on('load', function() {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id +'/read',
        success:function(result){
            var output = " ";
            for(var i in result.data)
            {
                if (result.data[i].attachment != null) {
                    output += "<div class='alert alert-primary' role='alert'><p class='alert-heading'>" +
                        "<img src='/storage/"+result.data[i].sender.photo+"' class='user-icon'>" + result.data[i].sender.fullName + "</p>" +
                        "<p class='mb-0'>" + result.data[i].message + "   " + "<a href=''>" + result.data[i].attachment.attachment + "</a>" +
                        "</p></div><br>";
                } else {
                    output += "<div class='alert alert-primary' role='alert'>" +
                        "<p class='alert-heading'><img src='/storage/"+result.data[i].sender.photo +"' class='user-icon'>" + result.data[i].sender.fullName + "</p>" +
                        "<p class='mb-0'>" + result.data[i].message + "</p></div><br>";
                }
            }
            display.html(output);
        }
    });

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id +'/members',
        success:function(data){
            console.log(data);
            var output = "";
            for(var i in data){
                output += "<tr class='table-active'><td ><strong>"+ counter++ +"</strong></td>"+
                    "<td>"+data[i].fullName +"</td></tr>";
            }
            memeberDisplay.html(output);
        }
    });
});

// const name = $("#userName").val();
// $(window).on('load', function() {
//     $.ajax({
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         type: "GET",
//         url: id +'/read',
//         success:function(result){
//             var output = " ";
//             for(var i in result.data)
//             {
//                 if (result.data[i].attachment != null) {
//                     if(result.data[i].sender.fullName === name){
//                         output += "<div class='alert alert-primary' role='alert'> <p class='alert-heading sender'>" + result.data[i].sender.fullName + "</p>" +
//                             "<p class='mb-0 sender'>" + result.data[i].message + "   " + "<a href='' class='sender'>" + result.data[i].attachment.attachment + "</a>" +
//                             "</p></div><br>";
//                     }else {
//                         output += "<div class='alert alert-primary' role='alert'> <p class='alert-heading'>" + result.data[i].sender.fullName + "</p>" +
//                             "<p class='mb-0'>" + result.data[i].message + "   " + "<a href=''>" + result.data[i].attachment.attachment + "</a>" +
//                             "</p></div><br>";
//                     }
//                 } else {
//                     if(result.data[i].sender.fullName === name) {
//                         output += "<div class='alert alert-primary' role='alert'> <p class='alert-heading sender'>" + result.data[i].sender.fullName + "</p>" +
//                             "<p class='mb-0 sender'>" + result.data[i].message + "</p></div><br>";
//                     }else{
//                         output += "<div class='alert alert-primary' role='alert'> <p class='alert-heading'>" + result.data[i].sender.fullName + "</p>" +
//                             "<p class='mb-0'>" + result.data[i].message + "</p></div><br>";
//                     }
//                 }
//             }
//             display.html(output);
//         }
//     });
// });
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

window.Echo.private('conversation.'+id)
    .listen('MessageSent', event => {
        console.log(event);
        if(event.sent === 1){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "GET",
                url: id +'/read',
                success:function(result){
                    var output = " ";
                    for(var i in result.data)
                    {
                        if (result.data[i].attachment != null) {
                            output += "<div class='alert alert-primary' role='alert'>" +
                                "<p class='alert-heading'>" +
                                "<img src='/storage/"+result.data[i].sender.photo+"' class='user-icon'> " + result.data[i].sender.fullName + "</p>" +
                                "<p class='mb-0'>" + result.data[i].message + "  " +
                                "<a href='#'>" + result.data[i].attachment.attachment + "</a></p></div><br>";
                        } else {
                            output += "<div class='alert alert-primary' role='alert'>" +
                                "<p class='alert-heading'>" +
                                "<img src='/storage/"+result.data[i].sender.photo+"' class='user-icon'>" + result.data[i].sender.fullName + "</p>" +
                                "<p class='mb-0'>" + result.data[i].message + "</p></div><br>";
                        }
                    }
                    display.html(output);
                }
            });
        }
    }).listen('UserNotification', event => {
        console.log(event);
        if(event.status === 'left'){
            const body =event.fullName +"  has left the conversation!!"
            $("#User-notification").html(body);
        }else{
            const body =event.fullName +"  has joined the conversation!!"
            $("#User-notification").html(body);
        }
        // $('#User-notification').delay(5000).fadeOut('slow');
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "GET",
            url: id +'/members',
            success:function(data){
                console.log(data);
                var output = "";
                for(var i in data){
                    output += "<tr class='table-active'><td ><strong>"+ counter++ +"</strong></td>"+
                        "<td>"+data[i].fullName +"</td></tr>";
                }
                memeberDisplay.html(output);
            }
        });
    });

$("#DeleteUser").click(function(){
    const choice = confirm("Are you sure u want to delete this account");
    if(choice == true){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'get',
            url: 'profile/delete',
            success:function(data){
                alert("User deleted successfully")
            }
        })
    }
});










