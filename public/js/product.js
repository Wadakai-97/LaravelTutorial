'use strict'

// // 商品削除の確認アラート
// function clickDelete() {
//     if(!window.confirm('本当に削除しますか？')) {
//         window.alert('キャンセルしました。');
//         return false;
//     }
//     document.deleteform.submit();
// }
// // 商品情報一覧表示
// function showAllProduct() {
//     $.ajax({
//         url: "showlist",
//         type: "get",
//         success: function(data) {
//             $.each(data, function() {
//                 $('#showAllProduct').append("<tr><td>" + value.id + "</td><td>" + data.img_path + "</td><td>" + data.product_name + "</td><td>" + data.price + "</td><td>" + data.stock + "</td><td>" + data.company_id + "</td></tr>");
//             })
//         }
//     })
// }
// テストデータ
// $(function() {
//     url: 'product/showlist'
// }).done(function(data) {
//     alert('成功しました。')
// }).fail(function(data) {
// }).always(function(data) {
// });

jQuery(function() {
    jQuery('#sample').text('Hello World!');
})

$(function() {
    $('#sam').on('click', function() {
        alert("complete");
    })
})
