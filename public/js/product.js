'use strict'

const { values } = require("lodash");

function clickDetail() {
    $(document).on('click', '#detail', function() {
        var product_id = $(this).closest('tr').children("td")[0].innerText;
        window.location.href = "/tutorial/public/product/showdetail/" + product_id;
    });
}

function hide() {
    $(document).on('click', '#delete', function() {
        var target = $(this).closest('tr');
        var delete_confirm = confirm('商品削除しちゃう？');

        if(delete_confirm == true) {
            target.hide();
        } else {

        };
    });
}
