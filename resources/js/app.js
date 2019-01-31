
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
    console.log("clicked");
    const member = $("#search-text").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'get',
        url: id+'/add',
        data: {member: member},
        success: function(data){
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
        }
    }).listen('UserNotification', event => {
        if(event.status === 'left'){
            const body =event.fullName +"  has left the conversation!!";
            $("#User-notification").html(body);
        }else{
            const body =event.fullName +"  has joined the conversation!!";
            $("#User-notification").html(body);
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
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id +'/read',
        success:function(result){
            buildUp(result);
        }
    });
}

function getMembers(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: id +'/members',
        success:function(data){
            var output = "";
            for(var i in data){
                output += "<tr class='table-active'><td ><strong>"+ counter++ +"</strong></td>"+
                    "<td>"+data[i].fullName +"</td></tr>";
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

function buildUp(result){
    const data = result.data;
    var output = " ";
    data.forEach(function(element) {

        var form =  build(element.sender.photo,element.sender.fullName,element.message,element.attachment,element.id);
        output += form;
    });
    display.html(output);
}

function build(photo,name,message,attachment = null, messageId) {
    var userData = "<img src='/storage/" + photo + "' class='user-icon'>" + name + "</p>";
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
    var html = "<div class='alert alert-primary' role='alert'>" +
        "<p class='alert-heading show'><span class='deleteMessage'><a href='"+id+"/message/"+messageId+"'class='btn btn-sm btn-outline-danger delMsg'>Delete</a></span>"
        + userData + messageBody + download + attach + "</a></p></div><br>";
    return html;
}

$(".show").click(function(){
    debugger;
    $(".deleteMessage").css("display","show")
});

