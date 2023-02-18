    $(function () {
        var color_attributes = $('body').find('.color_attributes input');

        $(document).on('change','.color_attributes input', function (event) {
            event.preventDefault();
            chooseAttributeTypeColor($(this));
        });

    function chooseAttributeTypeColor($this)
    {
        var color_id = $('input[name=color_id]').val();
        var currAttrIid = $this.parents('.color_attributes').find('input[name=id_color]').val();
        // change select and refresh it and recalculate summ after changing image of color
        $('#select_id_' + currAttrIid).val($this.val());
        $('#select_id_' + currAttrIid).change();
        var currColId = color_id;
        if ($('#select_id_' + color_id).length > 0) {
            currColId = $('#select_id_' + color_id).val();//need for save images gallery
        } else {
            color_id = currAttrIid;
            currColId = $this.val();
        }
        //show black border around chosen color
        $this.parents('.color_attributes').find('label').removeClass('active');
        $this.parent().addClass('active');

        displayAttributesImages(color_id, currColId);
    }
});
