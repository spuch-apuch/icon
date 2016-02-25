function initAjaxForm(selector, cont){
    $(document).on('afterValidate', selector + '-form', function(){
        tiny.update("relative");
    });
    $(document).on('beforeSubmit', selector + '-form', function (){
        var self = $(this);
        $.ajax({
            type:'post',
            url:self.attr('action'),
            data:self.serialize(),
            success:function(r){
                if (r.indexOf('success|') > -1) {
                    var params = r.split("|");
                    if (params[1] == 'back-menu') {
                        $('.back-menu')[0].click();
                        $('#preview-preload').fadeIn(200);
                        document.getElementById('preview').contentWindow.location.reload();
                    } else {
                        document.location = params[1];
                    }
                } else {
                    $(cont).html(r);
                    initPlugins();
                }
            }
        });
        return false;
    });
    initPlugins();
}
function initDrop(){
    var target,
        dropCounter = 0,
        dropPlace = '.upload-input .drop-hover',
        deletePreview = '.upload-input .glyphicon-remove-sign';

    $('.upload-input').fileupload({
        maxFileSize: 1000000, // 1 MB
        url: '/profile/default/upload',
        dataType: 'json',
        dropZone: false,
        add: function(e, data) {
            data.formData = {
                'inputName' : data.paramName,
                'uploadType': $('input[type="file"][name="' + data.paramName + '"]').attr('data-uploadType'),
            };
            target = $(e.target);
            target.find('.cont').append('<div class="loading"><div class="loaded" style="top:0;"></div><div class="filename">' + data.files[0].name + '</div></div>');
            target.find('.control-label').addClass('v-hidden');
            target.find('.help-block-error').empty();
            data.submit();
        },
        done: function (e, data){
            target.find('.loading').remove();
            target.find('.control-label').removeClass('v-hidden');
            if (data.result.status == 'success') {
                target.removeClass('has-error');
                target.find('.help-block-error').empty();
                $('.photosList').addClass('placed');
                var cont = target.find('.cont');
                img = $('<div>',{'class':'img of-hidden bg1d'}).appendTo(cont);
                img.append($('<img>',{"Src":data.result.url, "class":"w100pc"}));
                img.after($('<a>',{'data-filename':data.result.filename, 'class':'glyphicon glyphicon-remove-sign', 'href':'javascript:;'}));
                target.find('input[type="hidden"]').val(data.result.url);
            } else {
                target.addClass('has-error');
                target.find('.help-block-error').html(data.result.error);
            }
        },
        progressall: function (e, data){
            var progress = 100 - parseInt(data.loaded / data.total * 100, 10);
            target.find('.loaded').css('top', progress + '%');
        },
        fail: function (e, data){
            target.find('.loading').remove();
            target.find('.control-label').removeClass('v-hidden');
            target.find('.help-block-error').text('Ошибка при загрузке файла, пожалуйста попробуйте позже.');
            target.addClass('has-error');
        }
    }).prop('disabled', !$.support.fileInput).addClass($.support.fileInput ? undefined : 'disabled');

    if (!isBindEvent(dropPlace, 'drop')) {
        $(document).bind('drop', function(e){
            e.preventDefault();
            $(dropPlace).removeClass('drop-hover');
            $('.upload-input .caption').text('Загрузить');
            dropCounter = 0;
        });
        $(document).bind('dragenter', function(e){
            e.preventDefault();
            dropCounter++;
            if (!$('.upload-input .control-label').hasClass('drop-hover')) {
                $('.upload-input .control-label').addClass('drop-hover');
                $('.upload-input .caption').html("Перетащите файл<br/>в выделенную область");
            }
        });
        $(document).bind('dragleave', function(e){
            dropCounter--;
            if (dropCounter === 0) {
                $('.upload-input .control-label').removeClass('drop-hover');
                $('.upload-input .caption').text('Загрузить');
            }
        });
        $(document).on('drop', dropPlace, function(e){
            var self = $(this),
                files = e.originalEvent.dataTransfer.files;
            if (files.length) {
                e.preventDefault();
                e.stopPropagation();
                self.closest('.upload-input').fileupload('add', {files: files});
            }
            $(dropPlace).removeClass('drop-hover');
            $('.upload-input .caption').text('Загрузить');
        });
    }

    if (!isBindEvent(deletePreview, 'click')) {
        $(document).on('click', deletePreview, function(e) {
            var self = $(this);
            if(self.hasClass('uploaded')){
                var ajaxPar = {url: ths.attr('href')};
            }else{
                var ajaxPar = {
                    url: '/profile/default/delete-temp/',
                    data:{file: self.attr('data-filename')}
                }
            }
            ajaxPar.success = function(r){
                if (r == 'success') {
                    self.siblings('.img').remove();
                    self.remove();
                }
            }
            $.ajax(ajaxPar);
            e.preventDefault();
        });
    }
    console.log('Fileupload init');
}
$(document).ready(function(){
    $(document).on('click', '.window-link', function(){
        var self = $(this),
            target = self.attr('data-target');
        $(target).load(self.attr('href'), function(){
            var form = target.split("-modal");
            if ($(form[0] + '-form').length) {
                initAjaxForm(form[0], form[0] + '-modal');
            }
        });
    });
    $(document).on('change', 'input[type="radio"]', function(){
        var params = $(this).closest('form').serialize(),
            preview = $('#preview');
        $('#preview-preload').fadeIn(200, function(){
            preview.attr('src', preview.attr('data-src') + '?' + params);
        });


    });
    $(document).on('change', 'input.change-addon', function(){
        var $self = $(this),
            $addon = $($self.closest('.btn-group').attr('data-addon')).find('span');
        $addon.text($self.parent().text());
        $addon.removeClass().addClass($self.val());
    });
});