$(document).ready(function() {
    $('.summernote').summernote({
        height: 150
    });
});


var app = new Vue({

    el: '#app-layout',

    data: {
        mails:null,
        tab:null,
        sortBy:'date',
        perPage:10,
        page:1,
    },
    computed:{
      tabIcon:function() {
          if(this.tab=='inbox')
              return 'inbox';
          else if(this.tab=='sent')
              return 'send';
          else if(this.tab=='trash')
              return 'trash';
          return '-';
      }  
    },
    methods: {

        getInbox: function (tab) {

            if(tab!=null)
             app.tab=tab;

            console.log('get inbox '+app.tab);
            app.mails=null;

            $.ajax({
                url:'/inbox/'+app.tab+'?sort='+app.sortBy+'&per_page='+app.perPage+'&page='+app.page,
                success: function (r) {
                    console.log('inbox loaded');
                    app.mails=r;
                }
            })
        },
        
        setSort: function (sortBy) {
            app.sortBy=sortBy;
            app.getInbox();
        },

        setPerPage: function (p) {
            app.perPage=p;
            app.page=1;
            app.getInbox();
        },
        
        nextPage:function (p) {
            app.page++;
            app.getInbox();
        },    
        
        prevPage:function (p) {
            app.page--;
            if(app.page<1)
                app.page=1;
            app.getInbox();
        },
        
        
        

    }


});