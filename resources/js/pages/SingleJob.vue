<template>
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2
                class="
                    my-6
                    text-2xl
                    font-semibold
                    text-gray-700
                    dark:text-gray-200
                    capitalize
                "
            >
                Job Tile: {{ data.job_title }}
            </h2>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="grid gap-6 mb-8 md:grid-cols-3">
                    <div
                        class="
                            min-w-0
                            p-4
                            bg-white
                            rounded-lg
                            shadow-xs
                            dark:bg-gray-800
                        "
                    >
                        <h4
                            class="
                                mb-4
                                font-semibold
                                text-gray-600
                                dark:text-gray-300
                            "
                        >
                            Job Description
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ data.job_descrip }}
                        </p>
                    </div>
                    <div
                        class="
                            min-w-0
                            p-4
                            text-white
                            bg-purple-600
                            rounded-lg
                            shadow-xs
                        "
                    >
                        <h4 class="mb-4 font-semibold">Job Require</h4>
                        <p>
                            {{ data.job_require }}
                        </p>
                    </div>
                    <div
                        class="
                            min-w-0
                            p-4
                            bg-white
                            rounded-lg
                            shadow-xs
                            dark:bg-gray-800
                        "
                    >
                        <h4
                            class="
                                mb-4
                                font-semibold
                                text-gray-600
                                dark:text-gray-300
                            "
                        >
                            Job Benefits
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ data.job_benefit }}
                        </p>
                    </div>
                </div>
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <!-- card -->
                    <div
                        class="
                            flex
                            items-center
                            p-4
                            bg-white
                            rounded-lg
                            shadow-xs
                            dark:bg-gray-800
                        "
                    >
                        <div
                            class="
                                p-3
                                mr-4
                                text-orange-500
                                bg-orange-100
                                rounded-full
                                dark:text-orange-100 dark:bg-orange-500
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="
                                    mb-2
                                    text-sm
                                    font-medium
                                    text-gray-600
                                    dark:text-gray-400
                                "
                            >
                                Job Location
                            </p>
                            <p
                                class="
                                    text-lg
                                    font-semibold
                                    text-gray-700
                                    dark:text-gray-200
                                "
                            >
                                {{ data.job_place }}
                            </p>
                        </div>
                    </div>
                    <!-- card -->
                    <div
                        class="
                            flex
                            items-center
                            p-4
                            bg-white
                            rounded-lg
                            shadow-xs
                            dark:bg-gray-800
                        "
                    >
                        <div
                            class="
                                p-3
                                mr-4
                                text-green-500
                                bg-green-100
                                rounded-full
                                dark:text-green-100 dark:bg-green-500
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="
                                    mb-2
                                    text-sm
                                    font-medium
                                    text-gray-600
                                    dark:text-gray-400
                                "
                            >
                                Job Salary
                            </p>
                            <p
                                class="
                                    text-lg
                                    font-semibold
                                    text-gray-700
                                    dark:text-gray-200
                                "
                            >
                                $ {{ data.salary }}
                            </p>
                        </div>
                    </div>
                    <!-- card -->
                    <div
                        class="
                            flex
                            items-center
                            p-4
                            bg-white
                            rounded-lg
                            shadow-xs
                            dark:bg-gray-800
                        "
                    >
                        <div
                            class="
                                p-3
                                mr-4
                                text-blue-500
                                bg-blue-100
                                rounded-full
                                dark:text-blue-100 dark:bg-blue-500
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="
                                    mb-2
                                    text-sm
                                    font-medium
                                    text-gray-600
                                    dark:text-gray-400
                                "
                            >
                                Require Score
                            </p>
                            <p
                                class="
                                    text-lg
                                    font-semibold
                                    text-gray-700
                                    dark:text-gray-200
                                "
                            >
                                <!-- format number to float -->
                                {{
                                    new Intl.NumberFormat("en-US", {
                                        style: "decimal",
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }).format(data.require_score)
                                }}
                            </p>
                        </div>
                    </div>
                    <!-- card -->
                    <div
                        class="
                            flex
                            items-center
                            p-4
                            bg-white
                            rounded-lg
                            shadow-xs
                            dark:bg-gray-800
                        "
                    >
                        <div
                            class="
                                p-3
                                mr-4
                                text-teal-500
                                bg-teal-100
                                rounded-full
                                dark:text-teal-100 dark:bg-teal-500
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"
                                />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="
                                    mb-2
                                    text-sm
                                    font-medium
                                    text-gray-600
                                    dark:text-gray-400
                                "
                            >
                                Number Apply
                            </p>
                            <p
                                class="
                                    text-lg
                                    font-semibold
                                    text-gray-700
                                    dark:text-gray-200
                                "
                            >
                                {{ data.number_apply }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            job: {},
            data: {},
        };
    },
    async mounted() {
        this.job = await this.$store.dispatch(
            "job/getJobById",
            this.$route.params.id
        );
        this.data = this.job.data;
    },
};
</script>
