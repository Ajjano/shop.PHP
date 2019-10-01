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
                                    <button data-cart="${item.id}" class="btn btn-primary">Add to cart</button>
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
});