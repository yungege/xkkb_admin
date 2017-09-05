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
            this.category = $('#category');
            this.title = $('#title');
            this.desc = $('#desc');
            this.cover = $('#cover-val');
            this.coverBtn = $('#cover');
            this.coverTip = $('#pic-cover');
            this.form = $('form[name=news]');

            this.en_title = $('#en_title');
            this.en_desc = $('#en_desc');
        },

        initUe: function(){
            this.ue = UE.getEditor('editor');
            this.en_ue = UE.getEditor('en_editor');
        },

        checkParams: function(){
            var me =this;

            var category = $.trim(me.category.val()),
                title = $.trim(me.title.val()),
                desc = $.trim(me.desc.val()),
                cover = $.trim(me.cover.val()),
                en_title = $.trim(me.en_title.val()),
                en_desc = $.trim(me.en_desc.val());

            if(category != 9 && category != 10){
                alert('请选择分类');
                return false;
            }

            if(title.length < 6 || title.length > 50){
                alert('标题字数必须是6-50字');
                return false;
            }

            if(desc.length < 20 || desc.length > 200){
                alert('摘要字数必须是20-200字');
                return false;
            }

            if(!en_title || !en_desc){
                alert('请输入英文信息');
                return false;
            }

            if(!cover){
                alert('请上传封面图');
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
                    url: '/upload/img?size=260*240',
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
                    alert('请输入新闻内容.');return false;
                }

                data = me.form.serialize();
                var action = me.subBtn.data('type');
                var id = me.subBtn.data('id');
                // console.log('/news/insert?action='+action);return;
                $.post('/news/insert?action='+action+'&id='+id, data, function(json){
                    if(json.code == 200){
                        var cat = me.subBtn.data('cat');
                        window.location = '/news/'+cat;
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