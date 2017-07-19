$(function() {
    var addBanner = {
        init: function (){
            this.getDom();
            this.uploadImg();
            this.postData();

        },

        getDom: function(){
            this.form = $('form[name=add-banner]');
            this.imgBtn = $("#img-btn");
            this.imgShow = $("#pic-show img");
            this.imgHid = $("#img");
            this.color = $("#meau_color");
            this.url = $('#url');
            this.sort = $('#sort');
            this.subBtn = $('#sub');
        },

        postData: function(){
            var me =this;

            me.subBtn.unbind().bind('click', function(){
                var pic = $.trim(me.imgHid.val());
                var colorVal = $.trim(me.color.val());
                var urlVal = $.trim(me.url.val());
                var sort = parseInt($.trim(me.sort.val()));
                var urlPreg = /(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/g;
                if(!pic || 
                    !colorVal || 
                    !urlVal.match(urlPreg) || 
                    typeof(sort) == 'undefiend' || 
                    !sort
                ){
                    alert('请检查您填入的各项参数是否有误.');
                    return false;
                }

                var formdata = me.form.serialize();
                $.post('/banner/insert', formdata, function(json){
                    if(json.code == 200){
                        window.location = '/banner/index';
                    }
                    else{
                        alert(json.msg);
                        return false;
                    }
                });
            });
        },

        uploadImg: function(){
            var me = this;

            me.imgBtn.unbind().bind('change', function(){
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

                $.ajax({
                    url: '/upload/img',
                    type: 'POST',
                    data: fd,
                    success: function(json){
                        if(json.code != 200){
                            alert(json.msg);
                            return false;
                        }
                        else{
                            me.imgShow.attr('src', json.data.url);
                            me.imgHid.val(json.data.url);
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

    addBanner.init();
})