<template>
    <table class="table">
        <tbody>
            <tr v-for="(item, index) in saveAmountList" :key="index">
                <td>
                    {{ item.month_text }}
                </td>
                <td>
                    {{ item.total_save_amount }}円
                    <p>前月比：{{ item.save_amount }}円</p>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        saveAmountData: {
            type: Array,
            default: [],
        }
    },
    data() {
        return {
            //
        }
    },
    computed: {
        saveAmountList() {
            let saveAmountList = this.saveAmountData;

            // 年月で降順にソート
            saveAmountList.sort(function(a, b) {
                if (a.month_text > b.month_text) return -1;
                if (a.month_text < b.month_text) return 1;
                return 0;
            });

            return saveAmountList;
        }
    }
}
</script>

<style>

</style>