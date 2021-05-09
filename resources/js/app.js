import './bootstrap'
import Vue from 'vue'
import Test from './components/Test'
import Expense from './components/Expense'

const app = new Vue({
    el: '#app',
    components: {
        Expense,
    }
});