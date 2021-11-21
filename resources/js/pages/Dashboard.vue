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
                "
            >
                Dashboard
            </h2>

            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
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
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
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
                            Total job
                        </p>
                        <p
                            class="
                                text-lg
                                font-semibold
                                text-gray-700
                                dark:text-gray-200
                            "
                        >
                            {{ jobs.count }}
                        </p>
                    </div>
                </div>
                <!-- Card -->
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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
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
                            Total Applied
                        </p>
                        <p
                            class="
                                text-lg
                                font-semibold
                                text-gray-700
                                dark:text-gray-200
                            "
                        >
                            {{ appliedJobs.count }}
                        </p>
                    </div>
                </div>
                <!-- Card -->
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
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                            ></path>
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
                            New sales
                        </p>
                        <p
                            class="
                                text-lg
                                font-semibold
                                text-gray-700
                                dark:text-gray-200
                            "
                        >
                            376
                        </p>
                    </div>
                </div>
                <!-- Card -->
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
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd"
                            ></path>
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
                            Pending contacts
                        </p>
                        <p
                            class="
                                text-lg
                                font-semibold
                                text-gray-700
                                dark:text-gray-200
                            "
                        >
                            35
                        </p>
                    </div>
                </div>
            </div>
            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="
                                    text-xs
                                    font-semibold
                                    tracking-wide
                                    text-left text-gray-500
                                    uppercase
                                    border-b
                                    dark:border-gray-700
                                    bg-gray-50
                                    dark:text-gray-400 dark:bg-gray-800
                                "
                            >
                                <th class="px-4 py-3">Company Name</th>
                                <th class="px-4 py-3">Job Title</th>
                                <th class="px-4 py-3">Job Description</th>
                                <th class="px-4 py-3">Salary</th>
                            </tr>
                        </thead>
                        <tbody
                            class="
                                bg-white
                                divide-y
                                dark:divide-gray-700 dark:bg-gray-800
                            "
                        >
                            <template v-for="item in jobs.data" :key="item.id">
                                <tr
                                    class="text-gray-700 dark:text-gray-400"
                                    v-if="
                                        item.id <= maxShow && item.id >= minShow
                                    "
                                >
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- Avatar with inset shadow -->
                                            <div
                                                class="
                                                    relative
                                                    hidden
                                                    w-8
                                                    h-8
                                                    mr-3
                                                    rounded-full
                                                    md:block
                                                "
                                            >
                                                <img
                                                    class="
                                                        object-cover
                                                        w-full
                                                        h-full
                                                        rounded-full
                                                    "
                                                    :src="item.logo"
                                                    :alt="item.company_name"
                                                    loading="lazy"
                                                />
                                                <div
                                                    class="
                                                        absolute
                                                        inset-0
                                                        rounded-full
                                                        shadow-inner
                                                    "
                                                    aria-hidden="true"
                                                ></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">
                                                    {{ item.company_name }}
                                                </p>
                                                <p
                                                    class="
                                                        text-xs text-gray-600
                                                        dark:text-gray-400
                                                    "
                                                >
                                                    {{ item.job_place }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ item.job_title }}
                                    </td>
                                    <td class="px-4 py-3 text-xs max-w-xs">
                                        {{ item.job_descrip }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        ${{ item.salary }}
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div
                    class="
                        grid
                        px-4
                        py-3
                        text-xs
                        font-semibold
                        tracking-wide
                        text-gray-500
                        uppercase
                        border-t
                        dark:border-gray-700
                        bg-gray-50
                        sm:grid-cols-9
                        dark:text-gray-400 dark:bg-gray-800
                    "
                >
                    <span class="flex items-center col-span-3">
                        Showing
                        {{ maxShow < jobs.count ? maxShow : jobs.count }} of
                        {{ jobs.count }}
                    </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span
                        class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end"
                    >
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                <li>
                                    <button
                                        class="
                                            px-3
                                            py-1
                                            rounded-md rounded-l-lg
                                            focus:outline-none
                                            focus:shadow-outline-purple
                                        "
                                        aria-label="Previous"
                                        @click="showLess"
                                    >
                                        <svg
                                            aria-hidden="true"
                                            class="w-4 h-4 fill-current"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                                fill-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </button>
                                </li>
                                <li
                                    v-for="n in Math.ceil(jobs.count / limit)"
                                    :key="n"
                                >
                                    <button
                                        class="
                                            px-3
                                            py-1
                                            rounded-md
                                            focus:outline-none
                                            focus:shadow-outline-purple
                                        "
                                        :class="
                                            n == currentPage
                                                ? 'bg-purple-500 text-white'
                                                : 'bg-transparent'
                                        "
                                        @click="changePage(n)"
                                    >
                                        {{ n }}
                                    </button>
                                </li>

                                <li>
                                    <button
                                        class="
                                            px-3
                                            py-1
                                            rounded-md rounded-r-lg
                                            focus:outline-none
                                            focus:shadow-outline-purple
                                        "
                                        aria-label="Next"
                                        @click="showMore"
                                    >
                                        <svg
                                            class="w-4 h-4 fill-current"
                                            aria-hidden="true"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                                fill-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </span>
                </div>
            </div>
            <!-- Charts -->
            <h2
                class="
                    my-6
                    text-2xl
                    font-semibold
                    text-gray-700
                    dark:text-gray-200
                "
            >
                Charts
            </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2">
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
                            text-gray-800
                            dark:text-gray-300
                        "
                    >
                        Job and aplly
                    </h4>
                    <div>
                        <!-- chart -->
                        <BarChart
                            v-if="loaded"
                            :jobs="{ ...jobs }"
                            :applied="{ ...appliedJobs }"
                            :listUser="{ ...listUser }"
                        />
                    </div>
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
                            text-gray-800
                            dark:text-gray-300
                        "
                    >
                        Traffic
                    </h4>
                    <canvas id="line"></canvas>
                    <div
                        class="
                            flex
                            justify-center
                            mt-4
                            space-x-3
                            text-sm text-gray-600
                            dark:text-gray-400
                        "
                    >
                        <!-- Chart legend -->
                        <div class="flex items-center">
                            <span
                                class="
                                    inline-block
                                    w-3
                                    h-3
                                    mr-1
                                    bg-teal-600
                                    rounded-full
                                "
                            ></span>
                            <span>Organic</span>
                        </div>
                        <div class="flex items-center">
                            <span
                                class="
                                    inline-block
                                    w-3
                                    h-3
                                    mr-1
                                    bg-purple-600
                                    rounded-full
                                "
                            ></span>
                            <span>Paid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import BarChart from "../components/Chart.vue";
export default {
    data() {
        return {
            jobs: {},
            appliedJobs: {},
            listUser: null,
            limit: 10,
            minShow: 1,
            maxShow: 10,
            currentPage: 1,
            loaded: false,
        };
    },

    async mounted() {
        this.loaded = false;
        try {
            const jobs = await this.$store.dispatch("job/getAllJob");
            const appliedJobs = await this.$store.dispatch(
                "job/getAppliedJobs"
            );
            const listUser = await this.$store.dispatch("auth/listUsers");
            this.listUser = listUser;
            this.jobs = jobs;
            this.appliedJobs = appliedJobs;
            this.loaded = true;
        } catch (error) {
            console.error(error);
        }
    },
    methods: {
        showMore() {
            if (this.maxShow < this.jobs.data.length) {
                this.minShow += this.limit;
                this.maxShow += this.limit;
                this.currentPage += 1;
            }
        },
        showLess() {
            if (this.minShow > 1) {
                this.minShow -= this.limit;
                this.maxShow -= this.limit;
                this.currentPage -= 1;
            }
        },
        changePage(page) {
            this.minShow = (page - 1) * this.limit + 1;
            this.maxShow = page * this.limit;
            this.currentPage = page;
        },
    },
    components: {
        BarChart,
    },
};
</script>
