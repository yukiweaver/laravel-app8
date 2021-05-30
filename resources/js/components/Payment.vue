<template>
    <div>
        <div class="btn-group btn-group-toggle" ref="payment" data-toggle="buttons">
            <label @click="handleClick" class="btn btn-secondary active" data-id="expense">
                <input type="radio" name="options" autocomplete="off" checked> 支出
            </label>
            <label @click="handleClick" class="btn btn-secondary" data-id="income">
                <input type="radio" name="options" autocomplete="off"> 収入
            </label>
        </div>
        <component 
        :is="currentView"
        :expense-category-list="expenseCategoryList"
        :income-category-list="incomeCategoryList"
        :img-path="imgPath"
        :store-path="storePath"
        ></component>
    </div>
</template>

<script>
import Expense from './Expense';
import Income from './Income';
export default {
    components: {
        Expense,
        Income,
    },
    props: {
        expenseCategoryList: {
            type: Array,
            default: [],
            required: true
        },
        incomeCategoryList: {
            type: Array,
            default: [],
            required: true
        },
        imgPath: {
            type: String,
            default: '',
            required: true
        },
        storePath: {
            type: String,
            default: '',
            required: true
        }
    },
    data() {
        return {
            currentView: 'expense',
        }
    },
    methods: {
        handleClick(e) {
            this.currentView = e.currentTarget.getAttribute('data-id');
        }
    }
}
</script>

<style>

</style>