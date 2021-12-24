<script>
import { Bar } from 'vue-chartjs';
export default {
    extends: Bar,
    props: {
        saveAmountsChart: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            data: {
                labels: this.saveAmountsChart.labels ? this.saveAmountsChart.labels : [],
                datasets: [{
                    label: '総貯金額',
                    data: this.saveAmountsChart.data ? this.saveAmountsChart.data : [],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)',
                        'rgb(54, 162, 235)'
                    ],
                    borderWidth: 1,
                }],
            },
            options: {
                responsive: true,
                scales: {
                    // X軸
                    xAxes: [{
                        display: true,
                        // X軸グリッド非表示
                        gridLines: {
                            display:false
                        }
                    }],
                    // Y軸
                    yAxes: [{
                        display: true,
                        position: 'left',
                        ticks: {
                            // 0から始まる
                            beginAtZero: true,
                        },
                    }]
                }
            },
        }
    },
    mounted () {
        this.renderChart(this.data, this.options)
    }
}
</script>

<style>

</style>