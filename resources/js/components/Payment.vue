<template>
    <div>
        <div class="btn-group btn-group-toggle" ref="payment" data-toggle="buttons">
            <label @click="handleClick" :class="[addExpenseActiveClass, 'btn', 'btn-secondary']" data-id="expense">
                <input type="radio" name="options" autocomplete="off" checked> 支出
            </label>
            <label @click="handleClick" :class="[addIncomeActiveClass, 'btn', 'btn-secondary']" data-id="income">
                <input type="radio" name="options" autocomplete="off"> 収入
            </label>
        </div>
        <component
        :is="currentView"
        :expense-category-list="expenseCategoryList"
        :income-category-list="incomeCategoryList"
        :img-path="imgPath"
        :store-path="storePath"
        :update-path="updatePath"
        :initial-payment-date="initialPaymentDate"
        :initial-memo="initialMemo"
        :initial-amount="initialAmount"
        :initial-category-id="initialCategoryId"
        :initial-payment-id="initialPaymentId"
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
        },
        updatePath: {
            type: String,
            default: '',
        },
        showPath: {
            type: String,
            default: '',
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
        },
        initialPaymentType: {
            type: Number,
            default: 1,
        },
        initialPaymentId: {
            type: Number,
            default: null,
        },
    },
    data() {
        return {
            currentView: (this.initialPaymentType == 1) ? 'expense' : 'income',
        }
    },
    methods: {
        handleClick(e) {
            this.currentView = e.currentTarget.getAttribute('data-id');
        }
    },
    computed: {
        addExpenseActiveClass() {
            if (this.currentView == 'expense') {
                return 'active';
            }
        },
        addIncomeActiveClass() {
            if (this.currentView == 'income') {
                return 'active';
            }
        }
    }
}
</script>

<style>

</style>