<script>
import { Pie } from 'vue-chartjs';
export default {
    extends: Pie,
    props: {
        initialExpenses: {
            type: Array,
            default: [],
        },
        categoryColors: {
            type: Object,
            default: [],
        },
    },
    data () {
        return {
            data: {
                labels: [],
                datasets: [{
                    label: 'My First Dataset',
                    data: [],
                    backgroundColor: [],
                    hoverOffset: 4,
                    borderAlign: 'center',
                    borderWidth: 1,
                }]
            },
            options: {
                animation: {
                    animateRotate: true,
                }
            },
            colors: this.categoryColors,
        }
    },
    created() {
        this.setChartData(this.initialExpenses);
    },
    watch: {
        // propsのinitialExpensesの値が変動した時に実行される
        initialExpenses: function(newValue) {
            this.setChartData(newValue);
            this.renderChart(this.data, this.options)
        }
    },
    methods: {
        setChartData(expenses) {
            if (expenses.length) {
                let totalAmounts = [];
                let categoryNames = [];
                let backgroundColors = [];
                for(let val of this.initialExpenses) {
                    totalAmounts.push(val.total_amount);
                    categoryNames.push(val.name);
                    backgroundColors.push(this.colors[val.name]);
                }
                this.data.labels = categoryNames;
                this.data.datasets[0].data = totalAmounts;
                this.data.datasets[0].backgroundColor = backgroundColors;
            } else {
                this.data.labels = [];
                this.data.datasets[0].data = [];
                this.data.datasets[0].backgroundColor = [];
            }
        }
    },
    mounted () {
        this.renderChart(this.data, this.options)
    },
}
</script>

<style>

</style>