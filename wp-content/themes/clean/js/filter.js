(function ($){
    $(document).ready(function (){
        $(document).on('click', '.filter-tags', function (e){
            e.preventDefault();

            let category = $(this).data('category');

            $.ajax({
                url: wpAjax.ajaxUrl,
                data: { action: 'filter', category: category},
                type: 'post',
                success: function (result){
                    $('.card-section').html(result);
                },
                error: function(result){
                    console.warn(result)
                }
            })
        })
    })
})(jQuery)