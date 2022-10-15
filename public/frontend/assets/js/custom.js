(function($){
    $(document).ready(function(){


        // product filtering system by laravel
        // $(document).on('change', '#sort', function(){
        //     this.form.submit();
        //     // alert()
        // });


        // product filtering system by ajax
        $(document).on('change', '#sort', function(){
            const sort = $(this).val();
            const url = $('#url').val();
            const fabric = get_filter('fabric');
            const sleeve = get_filter('sleeve');

            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });
        });


        // filter by fabrics , sleeve 
        $(document).on('click', '.fabric', function(){
            const sort = $('#sort option:selected').val();
            const url = $('#url').val();
            const fabric = get_filter(this);
            const sleeve = get_filter('sleeve');
            
            // console.log(this);

            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });


        });


        // filter by fabric, sleeve 
        $(document).on('click', '.sleeve', function(){
            const sort = $('#sort option:selected').val();
            const url = $('#url').val();
            const fabric = get_filter('fabric');
            const sleeve = get_filter('sleeve');
            
            
            // console.log(this);

            $.ajax({
                url : url,
                type : 'get',
                data : {sort, url, fabric, sleeve},
                success : function (data){
                    $('.filter_products').html(data);
                }
            });


        });

        // function for filtering 
        function get_filter(cls_name){
            let filterArr = [];
            // console.log(`.${cls_name}:checked`);

            $('.'+cls_name+':checked').each(function(){
                filterArr.push($(this).val());
                // alert($(this).val());
            });

            return filterArr;
            // console.log(filterArr);
        }



    });
})(jQuery);