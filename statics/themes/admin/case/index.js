$(function(){
    var publish = {
        init: function(){
            this.getDom();
            this.initUe();
            this.publishNews();
            this.postPic();
        },

        getDom: function(){
            this.subBtn = $('#sub');
            
            this.title = $('#title');
            this.en_title = $('#en_title');
            this.cover = $('#cover-val');
            this.coverBtn = $('#cover');
            this.coverTip = $('#cover-tip');
            this.form = $('form[name=case]');
        },

        initUe: function(){
            this.ue = UE.getEditor('editor');
            this.en_ue = UE.getEditor('en_editor');
        },

        checkParams: function(){
            var me =this;

            var title = $.trim(me.title.val()),
                cover = $.trim(me.cover.val()),
                en_title = $.trim(me.en_title.val());

            if(title.length < 4 || title.length > 30){
                alert('标题字数必须是4-30字');
                return false;
            }

            if(!en_title){
                alert('请输入英文标题');
                return false;
            }

            if(!cover){
                alert('请上传展示图');
                return false;
            }
        },

        postPic: function(){
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
                if(file[0].size > 2097152){
                    alert("文件大小不能2M");
                    return false;
                }
                var fd = new FormData();
                fd.append('file', file[0]);

                var rep = null;

                var that = $(this);
                rep = $.ajax({
                    url: '/upload/img?size=380*350',
                    type: 'POST',
                    data: fd,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            return false;
                        }
                        else{
                            me.cover.val(json.data.link);
                            me.coverTip.text(fileinfo+' 上传成功');
                        }
                    },
                    beforeSend: function () {
                        if(rep != null) {
                            rep.abort();
                        }
                        me.coverTip.text('');
                    },
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype:"multipart/form-data",
                });
            });
        },

        publishNews: function(){
            var me = this;

            me.subBtn.unbind().bind('click', function(){
                if(false === me.checkParams()){
                    return false;
                }

                var news = me.ue.getContent(),
                    en_news = me.en_ue.getContent();
                if(!news || !en_news){
                    alert('请输入方案内容.');
                    return false;
                }

                data = me.form.serialize();
                var action = me.subBtn.data('type');
                var id = me.subBtn.data('id');
                
                $.post('/case/insert?action='+action+'&id='+id, data, function(json){
                    if(json.code == 200){
                        window.location = '/case/index';
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