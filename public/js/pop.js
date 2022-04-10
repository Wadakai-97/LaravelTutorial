'use strict'

// 削除確認アラート
function clickDelete() {
    if(!window.confirm('本当に削除しますか？')) {
        window.alert('キャンセルしました。');
        return false;
    }
    document.deleteform.submit();
}
