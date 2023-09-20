import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function delete_alert(e){
    if(!window.confirm('1件を削除します')){
        window.alert('キャンセルされました');
        return false;
    }
    document.deleteform.submit();
}