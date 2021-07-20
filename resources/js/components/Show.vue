<template>
    <div>
        <calendar
        :monthly-start-date="monthlyStartDate"
        >
        </calendar>
        <payment-data></payment-data>
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
        monthlyStartDate: {
            type: Number,
            default: 1,
        }
    }
}
</script>

<style>

</style>