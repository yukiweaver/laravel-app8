<template>
    <div>
        <div>
            <save-amount-chart
            :save-amounts-chart="saveAmountChart">
            </save-amount-chart>
        </div>
        <div>
            <save-amount-data
            :save-amounts-data="saveAmountData">
            </save-amount-data>
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
        saveAmounts: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            //
        }
    },
    computed: {
        /**
         * グラフ表示用データを返す
         */
        saveAmountChart() {
            if (!this.saveAmounts.length) {
                return {
                    'labels': [],
                    'data': [],
                }
            } else {
                return {
                    'labels': this.saveAmounts.labels,
                    'data': this.saveAmounts.data,
                }
            }
        },
        /**
         * 一覧表示用データを返す
         */
        saveAmountData() {
            if (!this.saveAmounts.length) {
                return []
            } else {
                this.saveAmounts.save_amounts;
            }
        }
    }
}
</script>

<style>

</style>