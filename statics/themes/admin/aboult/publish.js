$(function(){

    var publish = {
        init: function(){
            this.getDom();
            this.publishAboult();
            this.uploadPic();
        },

        getDom: function(){
            this.subBtn = $('#sub');
            this.desc = $('#desc');

            this.cover = $('#img-val');
            this.coverBtn = $('#img');
            this.coverTip = $('#img-cover');

            this.thumb = $('#thumb-val');
            this.thumbBtn = $('#thumb');
            this.thumbTip = $('#thumb-cover');

            this.form = $('form[name=aboult]');
        },

        checkParams: function(){
            var me =this;

            var desc = $.trim(me.desc.val()),
                cover = $.trim(me.cover.val()),
                thumb = $.trim(me.thumb.val());

            if(!cover){
                alert('请上传资质图');
                return false;
            }

            if(!thumb){
                alert('请上传资质缩略图');
                return false;
            }
        },

        postPic: function(obj, size){
            var me = this,
                objBtn = obj,
                objTip = obj + '-cover',
                obj = obj + '-val';

            $(objBtn).unbind().bind('change', function(){
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
                    url: '/upload/img?size=' + size,
                    type: 'POST',
                    data: fd,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            return false;
                        }
                        else{
                            $(obj).val(json.data.link);
                            $(objTip).text(fileinfo+' 上传成功');
                        }
                    },
                    beforeSend: function () {
                        if(rep != null) {
                            rep.abort();
                        }
                        $(objTip).text('');
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype:"multipart/form-data",
                });
            });
        },

        uploadPic: function(){
            var me = this;

            me.postPic('#img', '360*514');
            me.postPic('#thumb', '127*137');
        },

        publishAboult: function(){
            var me = this;

            me.subBtn.unbind().bind('click', function(){
                if(false === me.checkParams()){
                    return false;
                }

                data = me.form.serialize();
                var action = me.subBtn.data('type');
                var id = me.subBtn.data('id');
                
                $.post('/aboult/insert?action='+action+'&id='+id, data, function(json){
                    if(json.code == 200){
                        window.location = '/aboult/index';
                    }
                    else{
                        alert(json.msg);
                        return false;
                    }
                });
            });
            
        }
    };

    publish.init();

})