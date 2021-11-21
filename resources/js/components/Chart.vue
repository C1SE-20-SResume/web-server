<template>
    <div>
        <BarChart v-bind="barChartProps" />
    </div>
</template>

<script>
// import ref
import { computed } from "vue";
import { Chart, registerables } from "chart.js";
import { BarChart, useBarChart } from "vue-chart-3";

Chart.register(...registerables);
export default {
    props: ["jobs", "applied", "listUser"],
    data() {
        const chartData = computed(() => ({
            labels: ["Test"],
            datasets: [
                {
                    label: ["Applied"],
                    data: [this.applied.count],
                    backgroundColor: ["#77CEFF"],
                },
                {
                    label: ["Jobs"],
                    data: [this.jobs.count],
                    backgroundColor: ["#0079AF"],
                },
            ],
        }));

        const { barChartProps, barChartRef } = useBarChart({
            chartData,
        });
        return {
            barChartProps,
            barChartRef,
        };
    },
    components: {
        BarChart,
    },
    mounted() {},
};
</script>
