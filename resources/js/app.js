
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../public/js/vendor/dropzone');

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
const display = $("#message-display");
const attachmentList = $("#attachment-list");
const memeberDisplay = $("#showMemberList");
const displayAlerts = $("#alerts");

var counter = 1;

$('#form').on('submit',function(event){
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'post',
        url: id+'/send',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formData,
    });
    $("#form")[0].reset();
});

$("#add-member").click(function(){
    const member = $("#search-text").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'get',
        url: id+'/add',
        data: {member: member},
        dataType: "json",
        success: function(response){
            var alert = "<div class='alert alert-light' role='alert' tabindex='0'>" +
                "<p class='alert-heading '>"+response+ "</p></div><br>";
            displayAlerts.html(alert);
            $("#search-text").val('');
            setTimeout(function(){
                displayAlerts.html(' ');
            }, 3000);
        }
    });
});

$(window).on('load', function() {
    getMessages();
    getMembers();
    getAttachment();
});

window.Echo.private('conversation.'+id)
    .listen('MessageSent', event => {
        if(event.sent === 1){
            getMessages();
            getAttachment();
        }
    }).listen('UserNotification', event => {
        if(event.status === 'left'){
            const statusLeft = "has left the conversation!!";
            var body = memberNotification(event.fullName,statusLeft);
            display.append(body);
        }else{
            const statusJoined = "has joined the conversation!!";
            var body = memberNotification(event.fullName,statusJoined);
            display.append(body);
        }
        getMembers();
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

//Functions
function getMessages(){
    $('#textResponse').stop().animate({
        scrollTop: $('#textResponse').get(0).scrollHeight
    }, 2000);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id +'/read',
        success:function(result){
            buildUp(result);
        }
    });
}

function memberNotification(event,status)
{
    var body = "<div class='alert alert-success' role='alert' tabindex='0'>" +
        "<p class='alert-heading '>"+event +" "+ status + "</p></div><br>";
    return body
}

// alert-primary
function getMembers(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id +'/members',
        success:function(data){
            var output = "";
            for(var i in data){
                output += "<tr class='table-active'><td ><strong>"+ counter++ +"</strong></td>"+
                    "<td><a href='/users/"+data[i].id+"'>"+data[i].fullName +"</a></td></tr>";
            }
            memeberDisplay.html(output);
        }
    });
}

function getAttachment() {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id + '/attachment',
        success: function (result) {
            var output = "";
            for (var i in result) {
                output += "<li><a href='"+id+"/download/"+result[i].id+"'>" +result[i].attachment + "</a></li><hr>";
            }
            attachmentList.html(output);
        }
    });
}

// with paginate
// function buildUp(result){
//     const data = result.data;
//     var output = " ";
//     data.forEach(function(element) {
//
//         var form =  build(element.sender.photo,element.sender.fullName,element.message,element.attachment,element.id);
//         output += form;
//     });
//     display.html(output);
// }

function buildUp(result){
    var output = " ";
    result.forEach(function(element) {
        var form =  build(element.created_at, element.sender.photo,element.sender.fullName,element.message,element.attachment,element.id);
        output += form;
    });
    display.html(output);
}

function build(created,photo,name,message,attachment = null, messageId)
{
    var userData = "<img src='/storage/" + photo + "' class='user-icon'> &nbsp" + name + "</p>";
    var messageBody = "<p class='mb-0'>" + message ;
    if (attachment != null) {
        var download = "<hr><a href='" + id + "/download/" + attachment.id + "'>";
        var mimeType = attachment.attachment;
        if (mimeType.includes(".jpg") || mimeType.includes(".jpeg") || mimeType.includes(".png") || mimeType.includes(".gif")) {
            var attach = "<img src='/storage/" + mimeType + "' class='img-thumbnail'>";
        } else {
            var attach = attachment.attachment;
        }
    } else {
        download = "";
        attach = "";
    }
    var html = "<div class='alert alert-primary show-delete-btn' role='alert' tabindex='0'>" +
        "<p class='alert-heading '><span class='delete-message'><a href='"+id+"/messages/"+messageId+"'class='btn btn-sm btn-outline-danger'><i class='far fa-trash-alt'></i> " +
        "</a></span>" + userData + messageBody + download + attach + "</a><br><small>"+created+"</small></p></div><br>";
    return html;
}