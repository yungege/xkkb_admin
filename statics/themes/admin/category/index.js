$(function(){

    var category = {
        init: function(){
            this.getDom();
            this.delCate();
            this.addCate();
            this.removeArea();
            this.showArea();
            this.editCate();
        },

        getDom: function(){
            this.addBtn = $('.cate-add');
            this.delBtn = $('.cate-del');
            this.editBtn = $('.cate-edit');
            this.areaDiv = $('.fix-div');
            this.subBtn = $('#sub');
            this.title = $('#cate_name');
            this.entitle = $('#en_cate_name');
            this.pid = $('#pid');
            this.level = $('#level');
            this.cate_type = $('#cate_type');
            this.removeBtn = $('.glyphicon-remove');
            this.form = $('form[name=cate]');

            this.editAreaDiv = $('.edit-fix-div');
            this.subBtnEdit = $('#edit_sub');
            this.titleEdit = $('#edit_cate_name');
            this.enTitleEdit = $('#edit_en_cate_name');
            this.idEdit = $('#edit_id');
            this.levelEdit = $('#edit_level');
            this.typeEdit = $('#edit_cate_type');
            this.sortEdit = $('#edit_cate_sort');
            this.formEdit = $('form[name=edit-cate]');
        },

        removeArea: function(){
            var me = this;

            me.removeBtn.unbind().bind('click', function(){
                me.areaDiv.fadeOut(200);
                me.title.val('');
                me.pid.val('');
                me.level.val('');
                me.cate_type.val('');

                me.editAreaDiv.fadeOut(200);
                me.idEdit.val(''); 
                me.levelEdit.val('');
                me.sortEdit.val('');
                me.titleEdit.val('');
                me.typeEdit.val('');
            });
        },

        delCate: function(){
            var me = this;

            me.delBtn.unbind().bind('click', function(){
                if(!confirm('您确定要删除该分类？')) return false;

                var id = $(this).data('id');
                $.post('/category/delete?id=' + id, function(json){
                    if(json.code == 200){
                        window.location.reload();
                    }
                    else{
                        alert('删除失败.');
                        return false;
                    }
                });
            })
        },

        showArea: function(){
            var me = this;

            me.addBtn.unbind().bind('click', function(){
                var pid = $(this).data('pid'),
                    level = $(this).data('level'),
                    ctype = $(this).data('type');

                if(level != 1) return false;

                me.areaDiv.fadeIn(200);
                me.pid.val(pid);
                me.level.val(level);
                me.cate_type.val(ctype);
            });

            me.editBtn.unbind().bind('click', function(){
                var id = $(this).data('id'),
                    level = $(this).data('level'),
                    cate_type = $(this).data('type'),
                    sort = $(this).data('sort'),
                    name = $(this).data('name'),
                    enName = $(this).data('en-name');

                me.editAreaDiv.fadeIn(200);
                me.idEdit.val(id); 
                me.levelEdit.val(level);
                me.sortEdit.val(sort);
                me.titleEdit.val(name);
                me.enTitleEdit.val(enName);
                me.typeEdit.val(cate_type);
                me.sortEdit.attr('disabled', false);

                if(level != 1){
                    me.sortEdit.attr('disabled', true);
                    me.sortEdit.val('');
                }
            });
        },

        addCate: function(){
            var me = this;

            me.subBtn.unbind().bind('click', function(){
                var title = $.trim(me.title.val()),
                    pid = parseInt($.trim(me.pid.val())),
                    level = parseInt($.trim(me.level.val())),
                    entitle = $.trim(me.entitle.val());
                    ctype = parseInt($.trim(me.cate_type.val()));

                if(title.length > 16 || title < 2){
                    alert('分类名称必须在2-16字之间.');
                    return false;
                }

                if(!/\w{2,50}/.test(entitle)){
                    alert('分类名称必须在2-50字母之间.');
                    return false;
                }

                if(isNaN(pid) || level != 1 || isNaN(ctype)){
                    alert('排序必须是非负整数.');
                    return false;
                }

                $.post('/category/add', me.form.serialize(), function(json){
                    if(json.code == 200){
                        window.location.reload();
                    }
                    else{
                        alert('添加失败.');
                        return false;
                    }
                });
                
            });
        },

        editCate: function(){
            var me = this;
            me.subBtnEdit.unbind().bind('click', function(){
                $.post('/category/edit', me.formEdit.serialize(), function(json){
                    if(json.code == 200){
                        window.location.reload();
                    }
                    else{
                        alert('修改失败.');
                        return false;
                    }
                });
                
            });
        },
    };

    category.init();
})