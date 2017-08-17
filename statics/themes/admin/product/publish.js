$(function(){

    var publish = {
        init: function(){
            this.getDom();
            this.uploadPic();
            this.initUe();
            this.publishPro();
        },

        getDom: function(){
            this.subBtn = $('#sub');
            this.form = $('form[name=add]');
            
            this.cover1     = $('#pro_cover_pic');
            this.cover1Btn  = $('#pro_cover_pic_val');
            this.cover1Tip  = $('#pro_cover_pic_tip');

            this.cover2     = $('#pro_cover_pic_2');
            this.cover2Btn  = $('#pro_cover_pic_2_val');
            this.cover2Tip  = $('#pro_cover_pic_2_tip');

            this.cover3     = $('#pro_tec_params');
            this.cover3Btn  = $('#pro_tec_params_val');
            this.cover3Tip  = $('#pro_tec_params_tip');

            //英文图片信息
            this.en_cover1     = $('#en_pro_cover_pic');
            this.en_cover1Btn  = $('#en_pro_cover_pic_val');
            this.en_cover1Tip  = $('#en_pro_cover_pic_tip');

            this.en_cover2     = $('#en_pro_cover_pic_2');
            this.en_cover2Btn  = $('#en_pro_cover_pic_2_val');
            this.en_cover2Tip  = $('#en_pro_cover_pic_2_tip');

            this.en_cover3     = $('#en_pro_tec_params');
            this.en_cover3Btn  = $('#en_pro_tec_params_val');
            this.en_cover3Tip  = $('#en_pro_tec_params_tip');            
        },

        initUe: function(){
            this.ue = UE.getEditor('editor');
            this.en_ue = UE.getEditor('en_editor');
        },

        postPic: function(obj, size){
            var me = this,
                objBtn = obj + '_val',
                objTip = obj + '_tip';

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
                if(file[0].size > 2097152){
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
                            $(objBtn).val('');
                            $(obj).val('');
                            $(objTip).text('');
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

            me.postPic('#pro_cover_pic', '600*190');
            me.postPic('#pro_cover_pic_2', '600*190');
            me.postPic('#pro_tec_params', '');

            // 英文图片
            me.postPic('#en_pro_cover_pic', '600*190');
            me.postPic('#en_pro_cover_pic_2', '600*190');
            me.postPic('#en_pro_tec_params', '');
        },

        publishPro: function(){
            var me = this;

            me.subBtn.unbind().bind('click', function(){
                data = me.form.serialize();
                // var action = me.subBtn.data('type');
                // var id = me.subBtn.data('id');
                var op = 'add',
                    ty = $(this).attr('data-action'),
                    id = $(this).attr('data-id');
                if(ty && ty == 'update'){
                    op = 'update';
                }

                $.post('/product/insert?type='+op+'&id='+id, data, function(json){
                    if(json.code == 200){
                        window.location.reload();
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