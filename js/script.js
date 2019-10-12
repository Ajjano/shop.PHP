$('document').ready(()=>{
   $('#sel_category').on('change', ()=>{
       let category_id=$(event.target).val();
      $.ajax({
          type:'POST',
          url:'pages/ajax.php',
          data:{'category_id':category_id},
          success:function (data) {
              let categories=JSON.parse(data);
              console.log(categories);
              let html='';
            categories.forEach(function(item) {
                html += `
                 <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading">${item.item_name}</div>
                            <div class="panel-body" style="height: 200px">
                                <img src="${item.image_path}" alt="pict" class="center-block" style="max-width:100%;margin: 0 auto;max-height: 100%;">

                            </div>
                            <div class="panel-footer clearfix">
                                <div class="pull-left">${item.price_sale}</div>
                                <div class="pull-right">
                                    <button data-cart="${item.id}"  class="btn btn-primary btn_to_cart">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 `;
            });
            $('.catalog').html(html);
             },
          error:function (data) {
              alert(':('+data.statusText);
          }
      });
   });

   $('.btn_to_cart').on('click', (event)=>{
       event.preventDefault();
      console.log($(event.target).data('cart'));
      alert('Item was added to the cart');
      let date=new Date(new Date().getTime()+60*1000*30);
      document.cookie=$(event.target).data('cart')+'=ok; path=/;expires='+date.toUTCString();
   });
   function removeCookies() {
       let cookies_array=document.cookie.split(';');
       cookies_array.forEach((cookie_item)=>{
           if(cookie_item.indexOf('cart')===1){
               let cook=cookie_item.split('=');
               let date=new Date(new Date().getTime()-6000000);
               document.cookie='cart_'+cook[0]+'=ok; path=/;expires='+date.toUTCString();
               console.log(cookie_item);
               document.location.reload();
           }
       })
   }
   function removeCookie(name) {

       let date=new Date(new Date().getTime()-6000000);
       document.cookie='cart_'+name+'=ok; path=/;expires='+date.toUTCString();
       document.location.reload();
   }

   $('.glyphicon').on('click', (event)=>{
       removeCookie($(event.target).data('target'));
   })

    $('.btn_buy').on('click',(event)=>{
        console.log(document.cookie.split(';'));
        let id = $(event.target).data('user_id');
        let data_array = [];
        let cookies_array=document.cookie.split(';');
        cookies_array.forEach((_cookies)=>{
            if(_cookies.indexOf('cart') === 1) {
                let cook = _cookies.split('=');
                let id = cook[0].split('_');
                data_array.push(id[1]);
                removeCookie($(event.target).data('target'));
            }
        });

    })

    $(document).on('click', '.center-block', ()=>{
        let item_id = $(event.target).data('item_id');
        $('.modal').removeClass('hide');
        $('.modal').addClass('show');
        $.ajax({
            type:'POST',
            url: 'pages/ajax_modal.php',
            data: {'item_id': item_id },
            success: function(data){
                console.log(data);
                if(data){
                    $('.item_info').html(data);
                }
            }
        });
    });

    $(document).on('click', '#btn_close', (event)=>{
        event.preventDefault();
        $('.modal').removeClass('show');
        $('.modal').addClass('hide');
    });
});