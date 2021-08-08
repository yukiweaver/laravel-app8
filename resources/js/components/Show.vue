<template>
    <div>
        <calendar
        :base-date="baseDate"
        :start-date="startDate"
        :end-date="endDate"
        :show-path="showPath"
        >
        </calendar>
        <payment-data
        :payments="payments"
        :categories="categories"
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
    }
}
</script>

<style>

</style>