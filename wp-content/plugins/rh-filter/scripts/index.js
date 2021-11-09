jQuery( document ).ready(function( $ ) {
   $('#checkbox1').on('click', function() {
      $.ajax({
         type: 'POST',
         url: '/wp-admin/admin-ajax.php',
         dataType: 'html',
         data: {
            action: 'filter_projects',
            category: 'some category'
            // category: $(this).data('slug'),
         },
         success: function(res) {
            console.log('success')
         },
         error: function(err) {
            console.log(err)
         }
      })
   })
});



