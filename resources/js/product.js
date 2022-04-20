'use strict'

// 商品削除の確認アラート
function clickDelete() {
    if(!window.confirm('本当に削除しますか？')) {
        window.alert('キャンセルしました。');
        return false;
    }
    document.deleteform.submit();
}
// 商品情報一覧表示
function showAllProduct() {
    $.ajax({
        url: "showlist",
        success: function(data) {
            $.each(data, function(key, value) {
                $('#showAllProduct').append("<tr><td>" + value.id + "</td><td>" + value.img_path + "</td><td>" + value.product_name + "</td><td>" + value.price + "</td><td>" + value.stock + "</td><td>" + value.company_id + "</td></tr>");
            })
            console.log("通信失敗")
            console.log(data);
        },

        error: function() {
            console.log("通信失敗");
            console.log(data);
        }
    })
}
// 商品情報一覧を表示
showAllProduct();
