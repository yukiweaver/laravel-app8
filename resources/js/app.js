import './bootstrap'
import Vue from 'vue'
import Test from './components/Test'
import Expense from './components/Expense'
import gv from './mixins/globalValiables' // 共通function

// mixinで共通functionをthis.でcallできる
Vue.mixin(gv);

const app = new Vue({
    el: '#app',
    components: {
        Expense,
    }
});