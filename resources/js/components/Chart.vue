<template>
    <Vue3ChartJs
        :id="jobChart.id"
        :type="jobChart.type"
        :data="jobChart.data"
        :options="jobChart.options"
        @after-render="afterRenderLogic"
    >
    </Vue3ChartJs>
</template>

<script>
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
export default {
    props: {
        alljob: {
            type: Object,
            required: true,
        },
        allapplied: {
            type: Object,
            required: true,
        },
    },
    data() {
        const jobChart = {
            id: "jobChart",
            type: "bar",
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {},
            },
            data: {
                labels: ["Chart follow job and aplly"],
                datasets: [
                    {
                        label: ["Job"],
                        backgroundColor: ["#1abc9c"],
                        data: [this.alljob.count],
                    },
                    {
                        label: "Aplly",
                        backgroundColor: ["#f1c40f"],
                        data: [this.allapplied.count],
                    },
                ],
            },
        };

        const afterRenderLogic = (event) => {};
        return {
            jobChart: jobChart,
            afterRenderLogic: afterRenderLogic,
        };
    },
    name: "Chart",
    mounted() {},
    components: {
        Vue3ChartJs,
    },
};
</script>
