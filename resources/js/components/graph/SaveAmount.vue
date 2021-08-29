<template>
    <div>
        <div>
            <save-amount-chart></save-amount-chart>
        </div>
        <div>
            <save-amount-data></save-amount-data>
        </div>
    </div>
</template>

<script>
import SaveAmountChart from './SaveAmountChart.vue';
import SaveAmountData from './SaveAmountData.vue';
export default {
    components: { 
        SaveAmountChart,
        SaveAmountData,
    },
    props: {
        //
    },
    data() {
        return {
            //
        }
    }
}
</script>

<style>

</style>