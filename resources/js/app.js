import './bootstrap'
import Vue from 'vue'
import Test from './components/Test'
import Payment from './components/Payment'
import Show from './components/Show'
import Graph from './components/graph/Graph'
import gv from './mixins/globalValiables' // 共通function

// mixinで共通functionをthis.でcallできる
Vue.mixin(gv);

const app = new Vue({
    el: '#app',
    components: {
        Payment,
        Show,
        Graph,
    }
});