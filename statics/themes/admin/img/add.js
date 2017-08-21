$(function(){
    var addImg = {
        init: function(){
            this.getDom();
            this.postImg();
            this.postData();
        },
        getDom: function(){
            this.form       = $('form[name=img]');
            this.subBtn     = $('#sub');
            this.coverBtn   = $('#img');
            this.cover      = $('#img-val');
            this.coverTip   = $('#img-show');

        },
        postImg: function(){
            var me = this;

            me.coverBtn.unbind().bind('change', function(){
                var fileinfo = $(this).val();
                
                if (fileinfo == "") {
                    alert("请选择上传图片！");
                    return false;
                }
                //判断上传文件的后缀名
                var strExtension = fileinfo.substr(fileinfo.lastIndexOf('.') + 1).toLowerCase();
                if (strExtension != 'jpg' && strExtension != 'jpeg'
                && strExtension != 'png' && strExtension != 'bmp') {
                    alert("只支持[JPG、PNG、BMP]文件");
                    return false;
                }
                
                var file = $(this).get(0).files;
                if(file[0].size > 1048576){
                    alert("文件大小不能1M");
                    return false;
                }
                var fd = new FormData();
                fd.append('file', file[0]);

                var rep = null;

                var that = $(this);
                rep = $.ajax({
                    url: '/upload/img?size=264*315',
                    type: 'POST',
                    data: fd,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            me.coverTip.attr('src', '');
                            return false;
                        }
                        else{
                            me.cover.val(json.data.link);
                            me.coverTip.attr('src', json.data.link);
                            $(this).val('');
                        }
                    },
                    beforeSend: function () {
                        if(rep != null) {
                            rep.abort();
                        }
                        me.coverTip.attr('src', '');
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype:"multipart/form-data",
                });
            });
        },
        postData: function(){
            var me = this;

            me.subBtn.unbind().bind('click', function(){
                var data = me.form.serialize();

                $.post('/img/insert', data, function(json){
                    if(json.code == 200){
                        window.location.reload();
                    }
                    else{
                        alert(json.msg);
                        return false;
                    }
                })
            });
            
        },
    };

    addImg.init();
})