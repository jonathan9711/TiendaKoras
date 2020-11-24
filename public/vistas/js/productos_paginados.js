$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page =$(this).attr('href').split('page=')[1];
    $.ajax({
        url: '/productos',
        data: {page: page},
        type: 'GET',
        datatype: 'json',
        success: function(data){
            $('.productosPaginate').html(data);
        }
    });
});