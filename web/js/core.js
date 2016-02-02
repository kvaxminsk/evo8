var App = {};
App.getCsrf = function () {
    return $('meta[name="csrf-token"]').attr('content');
}



var test = function (a, b) {
    console.log(arguments);
    console.log(this);
    return a + b;
}
test(1, 2);
$(document).ready(function () {
    $('#logout').click(function () {
        
    });
    
});
