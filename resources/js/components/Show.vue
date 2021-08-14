<template>
    <div>
        <calendar
        :base-date="baseDate"
        :start-date="startDate"
        :end-date="endDate"
        :show-path="showPath"
        :initial-payments="paymentData"
        :payment-expense-type="paymentExpenseType"
        :payment-income-type="paymentIncomeType"
        @payment-data="paymentData = $event"
        >
        </calendar>
        <payment-data
        :initial-payments="paymentData"
        :categories="categories"
        :expense-category-list="expenseCategoryList"
        :income-category-list="incomeCategoryList"
        :img-path="imgPath"
        :update-path="updatePath"
        :show-path="showPath"
        >
        </payment-data>
    </div>
</template>

<script>
import Calendar from './Calendar';
import PaymentData from './PaymentData.vue';
export default {
    name: 'Show',
    components: {
        Calendar,
        PaymentData,
    },
    props: {
        payments: {
            type: Object,
            default: [],
        },
        categories: {
            type: Array,
            default: [],
        },
        baseDate: {
            type: String,
            default: '',
        },
        startDate: {
            type: String,
            default: '',
        },
        endDate: {
            type: String,
            default: '',
        },
        showPath: {
            type: String,
            default: '',
        },
        paymentExpenseType: {
            type: Number,
            default: 0,
        },
        paymentIncomeType: {
            type: Number,
            default: 0,
        },
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
        updatePath: {
            type: String,
            default: '',
        }
    },
    data() {
        return {
            paymentData: this.payments,
        }
    }
}
</script>

<style>

</style>