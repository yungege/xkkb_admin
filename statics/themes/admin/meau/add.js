$(function(){
    var picUploader = {
        init: function (){
            this.getDom();
            this.uploadImg();
        },

        getDom: function (){
            this.picPicker = $('.img-pick-input');
        },

        uploadImg: function (){
            me = this;

            me.picPicker.unbind().bind('change', function(){
                var fileinfo = $(this).val();
                var nextTr = $(this).attr('data-next');
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
                if(file[0].size > 2097152){
                    alert("文件大小不能2M");
                    return false;
                }
                var fd = new FormData();
                fd.append('file', file[0]);

                var rep = null;

                var that = $(this);
                rep = $.ajax({
                    url: '/upload/img',
                    type: 'POST',
                    data: fd,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            return false;
                        }
                        else{
                            that.parent().css({'background-image':'url("'+json.data.url+'")'});
                            that.parent().next().val(json.data.url);
                            if(nextTr){
                                $('.'+nextTr).fadeIn(800);
                            }
                        }
                    },
                    beforeSend: function () {
                        if(rep != null) {
                            rep.abort();
                        }
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype:"multipart/form-data",
                });
            });
        },

    };

    var postData = {
        init: function (){
            this.getDom();
            this.postData();
        },

        getDom: function (){
            this.subBtn = $('#sub');
            this.form = $('form[name=add-meau]');
        },

        postData: function (){
            var me = this;
            var rep = null;
            me.subBtn.unbind().bind('click', function(){
                var formData = me.form.serialize();
                rep = $.ajax({
                    url: '/meau/insert',
                    type: 'POST',
                    data: formData,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            return false;
                        }
                        else{
                            
                        }
                    },
                    beforeSend: function () {
                        if(rep != null) {
                            rep.abort();
                        }
                    },
                    cache: false
                });

            })
        },
    };

    picUploader.init();
    postData.init();
})