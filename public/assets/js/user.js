$(function(){
    $('.page.page-user.page-form').each(function(){

    var $this = $(this);
        var $checkbox = $this.find('checkbox');

        $checkbox.on('change', function(){
            var $this = $(this);

            var type = $this.data('type');

            var select= $this.find('select');

            if($checkbox.is(':checked')){
                $checkbox.removeClass('d-none');
            } else{

                $checkbox.addClass('d-none');
            }
        console.log();    
        })
    })
})
