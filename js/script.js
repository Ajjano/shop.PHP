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

    $('.btn_buy').on('click',()=>{
        console.log(document.cookie.split(';'));
        let cookies_array=document.cookie.split(';');
        cookies_array.each(()=>{

        })
    })
});