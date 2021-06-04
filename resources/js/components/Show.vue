<template>
    <calendar
    :monthly-start-date="monthlyStartDate"
    >
    </calendar>
</template>

<script>
import Calendar from './Calendar';
export default {
    name: 'Show',
    components: {
        Calendar
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