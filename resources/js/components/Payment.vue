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
        :initial-payment-date="initialPaymentDate"
        :initial-memo="initialMemo"
        :initial-amount="initialAmount"
        :initial-category-id="initialCategoryId"
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
        },
        initialPaymentDate: {
            type: String,
            default: '',
        },
        initialMemo: {
            type: String,
            default: '',
        },
        initialAmount: {
            type: Number,
            default: null,
        },
        initialCategoryId: {
            type: Number,
            default: null,
        }
    },
    data() {
        return {
            // TODO:編集時、表示させるのはexpenseとincomeでデフォルトを切り分ける処理にする
            currentView: 'expense',
            amount: this.initialAmount,
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