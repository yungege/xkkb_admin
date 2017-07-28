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
            var me = this;

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
                            that.parent().css({'background-image':'url("'+json.data.link+'")'});
                            that.parent().next().val(json.data.link);
                            if(nextTr){
                                $('.'+nextTr).fadeIn(500);
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
                var meau = $.trim($('#meau').val());
                var url = $.trim($('#url').val());
                var sort = parseInt($.trim($('#sort').val()));
                var option = $.trim($(this).attr('data-option'));
                var id = $.trim($(this).attr('data-id'));

                if(!meau){
                    alert('请输入菜单名称.')
                    return false;
                }
                if(meau.length > 6){
                    alert('菜单名称不能超过6个字.')
                    return false;
                }
                if(!url || !url.match(/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/g))
                {
                    alert('请输入合法的URL.')
                    return false;
                }
                if(isNaN(sort) || sort < 1 || sort > 8){
                    alert('排序只能是1-8之间的数字.')
                    return false;
                }

                var formData = me.form.serialize();
                var url = typeof(option) != 'undefined' ? '/meau/insert?option='+option : '/meau/insert';
                if(id) url += '&id=' + id;
                rep = $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            return false;
                        }
                        else{
                            window.location = '/meau/index';
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