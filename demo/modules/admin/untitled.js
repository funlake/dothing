jQuery(function(){
   var $ = jQuery;
   var subtotals = [0,0,0,0,0];
   var subSum = function(){
       var amount = 0;
       $.each(subtotals,function(_,v){
            amount += v;
       })
       return amount;
   }
   $.each(['1','2','3','4'],function(k,v){
       $('#staff'+v+'sjukrasjodur').addClass("validate['number']")
       $('#staff'+v+'sjukrasjodur').keyup(function(){

          var val = $(this).val().replace(/[^\d]/,'');
          val = (val * 1).toFixed(2);
          if(val != "" && val > 0){
             $('#staff'+v+'orlofssjodur').val((val*0.25/100).toFixed(2));
             $('#staff'+v+'starfsmenntasjodur').val((val*0.3/100).toFixed(2));
          }
          else{
            $('#staff'+v+'orlofssjodur').val(0);
            $('#staff'+v+'starfsmenntasjodur').val(0);
          }
          var subtotal = (($('#staff'+v+'orlofssjodur').val()*1 + $('#staff'+v+'starfsmenntasjodur').val()*1).toFixed(2))*1;
          subtotals[v] =  (val*1+subtotal).toFixed(2) * 1;
          $('#staff'+v+'total').val(subtotals[v]);
          $('#totalamount').val(subSum());        
       })
   })
});