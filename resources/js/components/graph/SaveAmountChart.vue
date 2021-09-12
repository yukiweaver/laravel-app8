<script>
import { Bar } from 'vue-chartjs';
export default {
    extends: Bar,
    data() {
        return {
            data: {
                labels: [1, 2, 3, 4, 5, 6, 7],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 45],
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