'use strict'

// 商品削除の確認アラート
function clickDelete() {
    if(!window.confirm('本当に削除しますか？')) {
        window.alert('キャンセルしました。');
        return false;
    }
    document.deleteform.submit();
}
