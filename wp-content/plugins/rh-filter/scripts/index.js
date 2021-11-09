jQuery( document ).ready(function( $ ) {
   $('input[type=\'checkbox\']').on('change', function() {
      if (this.checked) {
         $('input[type=\'checkbox\']').prop('checked', false)
         $(this).prop('checked', true)
         let value = $(this).val()
         let data = {
            action: 'shop_filter',
            filter: value
         }
         $.post(myajax.url, data, function (res) {
            console.log('Получено с сервера - ' + res)
         })
      }
   })
});



