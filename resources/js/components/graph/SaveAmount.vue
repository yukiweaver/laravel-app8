<template>
    <div>
        <div>
            <save-amount-chart
            :save-amount-chart="saveAmountChart">
            </save-amount-chart>
        </div>
        <div>
            <save-amount-data
            :save-amount-data="saveAmountData">
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
            if (this.isEmptyObject(this.saveAmounts)) {
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
            if (this.isEmptyObject(this.saveAmounts)) {
                return [];
            } else {
                return this.saveAmounts.save_amounts;
            }
        }
    }
}
</script>

<style>

</style>