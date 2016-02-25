var initSelector = [];
function isBindEvent(selector, event){
    var allEvents = $._data(document, "events")[event];
    for (var i in allEvents) {
        if (allEvents[i].selector == selector) {
            return true;
        }
    }
    return false;
}
function initParams(selector) {
    var collapse = $('.collapse.params');
    if (collapse.length) {
        collapse.on('hidden.bs.collapse', function(e){
            $('a[href="#' + e.target.id + '"] .glyphicon').removeClass('glyphicon-minus-sign').addClass('glyphicon-plus-sign');
            tiny.update("relative");
        });
        collapse.on('shown.bs.collapse', function(e){
            $('a[href="#' + e.target.id + '"] .glyphicon').removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
            tiny.update("relative");
        });
    }
    if ($.inArray(selector, initSelector) == -1) {
        initSelector.push(selector);
        initAjaxForm(selector, '#panel .overview');
    } else {
        initPlugins();
    }
    if ($('.upload-input').length) {
        initDrop();
    }
}
$(document).ready(function(){
    $(document).bind('dragover', function(e){
        e.preventDefault();
    });
    $(document).on('click', '.profile-menu a, .back-menu', function(e){
        var self = $(this),
            overview = $('#panel .overview');
        overview.fadeOut(250, function(){
            overview.load(self.attr('href'), function(){
                overview.fadeIn(250);
                if (!self.hasClass('back-menu')) {
                    initParams(self.attr('data-selector'));
                }
                tiny.update('relative');
            });
        });
        e.preventDefault();
    });
    $('#preview').on('load', function(){
        $('#preview-preload').fadeOut(200);
    });
    $(document).on('click', '.dropdown.multi>.dropdown-toggle', function(){
        var $parent = $(this).parent(),
            hasClass = $parent.hasClass('open'),
            parentDropdown = $parent.parents('.dropdown.multi');
        $('.dropdown.multi').removeClass('open');
        if (parentDropdown.length) {
            parentDropdown.addClass('open');
        }
        if (hasClass) {
            $parent.removeClass('open');
        } else {
            $parent.addClass('open');
        }
    });
    $('body').on('click', function(e){
        var $dropdownMulti = $('.dropdown.multi');
        $dropdownMulti.each(function(){
            var $self = $(this);
            if (!$self.is(e.target) && !$self.has(e.target).length && $self.hasClass('open')) {
                $self.removeClass('open');
            }
        });
    });
});


/*
 $(document).ready(function(){
 $(document).on('click', '.profile-menu a', function(e){
 var self = $(this),
 w = self.width(),
 off = self.offset().top,
 lis = self.parent('li').siblings();
 self.addClass('active');
 self.find('.glyphicon:not(.glyphicon-question-sign)').removeClass().addClass('glyphicon glyphicon-remove');

 lis.fadeOut(300, function(){
 lis.css({'display':'block','visibility':'hidden'});
 $('.profile-menu').animate({'top':-off}, 300, function(){
 self.find('.glyphicon-question-sign').removeClass('hide');
 });
 });
 e.preventDefault();
 });
 });
*/