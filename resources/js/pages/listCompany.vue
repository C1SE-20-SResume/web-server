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
                List Company
            </h2>
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
                                <th class="px-4 py-3">Logo</th>
                                <th class="px-4 py-3">Company name</th>
                                <th class="px-4 py-3">Total Job</th>
                            </tr>
                        </thead>
                        <tbody
                            class="
                                bg-white
                                divide-y
                                dark:divide-gray-700 dark:bg-gray-800
                            "
                        >
                            <template
                                v-for="item in companies.data"
                                :key="item.id"
                            >
                                <tr class="text-gray-700 dark:text-gray-400">
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
                                                    :src="item.logo_url"
                                                    loading="lazy"
                                                />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{ item.company_name }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ item.job_count }}
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            companies: {},
        };
    },
    async mounted() {
        try {
            const res = await this.$store.dispatch("job/getListCompany");
            this.companies = res;
        } catch (error) {
            console.log(error);
        }
    },
};
</script>
