/**
 */
$(document).ajaxError(function(event,xhr,options,exc){
    var message = xhr.responseJSON ? xhr.responseJSON.message : '操作失败';
    $.modal.error(message);
});
$(function () {
    $(".fancybox").fancybox({
        prevEffect	: 'none',
        nextEffect	: 'none',
        helpers	: {
            title	: {
                type: 'float'
            },
            buttons	: {},
            thumbs	: {
                width	: 50,
                height	: 50
            }
        }
    });
    $('[data-toggle=popover]').popover();
    $('[data-toggle=tooltip]').tooltip();
    $("a[target='_blank']").on('click', function () {
        if ($(this).attr('no-iframe')) {
            return true;
        }
        if (parent != window) {
            parent.admin_tab(this);
            return false;
        }
    });


    $(".tooltips").on('click', function () {
        
        if (!$("#sidebar").hasClass('in')) {
            $("#main-content").css('margin-left', '210px');
            window.localStorage.setItem('cols', 0);
        } else {
            $("#main-content").css('margin-left', '0px');
            window.localStorage.setItem('cols', 1);
        }
    });

});
String.prototype.addQueryParams = function(params) {
    var split = '?';
    if (this.indexOf('?') > -1) {
        split = '&';
    }

    var queryParams = '';
    for(var i in params) {
        queryParams += i + '=' + params[i] + '&';
    }
    queryParams = queryParams.substr(0, queryParams.length -1)
    return this + split + queryParams;
}