$(function(){
    $('.page.page-user.page-form').each(function(){

        var $self = $(this);

        // console.log('Ola');



        $self.find('.checkbox').on('change', function() {

            var $checkbox = $(this);

            var $this = $(this);

            var type = $this.data('type');

            var $select = $this.parents('.row').find(`.${type}`);

            if ($checkbox.is(':checked')) {

                $select.removeClass('d-none');

            } else {

                $select.addClass('d-none');
            }
        })
    })
})
