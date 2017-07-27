$(function(){

    var publish = {
        init: function(){
            this.getDom();
            this.initUe();
            this.publishNews();
        },

        getDom: function(){
            this.subBtn = $('#sub');
        },

        initUe: function(){
            this.ue = UE.getEditor('editor');
        },

        publishNews: function(){
            var me = this;

            me.subBtn.unbind().bind('click', function(){
                var news = me.ue.getContent();
                console.log(news);
            });
            
        }
    };

    publish.init();

})