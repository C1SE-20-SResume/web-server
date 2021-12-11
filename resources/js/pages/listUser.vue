<template>
    <main class="h-full overflow-y-auto relative">
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
            <h3
                class="
                    my-6
                    text-lg
                    font-semibold
                    text-gray-700
                    dark:text-gray-200
                "
            >
                Recruiter List
            </h3>
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
                                <th class="px-4 py-3">User ID</th>
                                <th class="px-4 py-3">Company Name</th>
                                <th class="px-4 py-3">Full Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Phone Number</th>
                                <th class="px-4 py-3">Gender</th>
                                <th class="px-4 py-3">Date Of Birth</th>
                            </tr>
                        </thead>
                        <tbody
                            v-if="recruiters.length > 0"
                            class="
                                bg-white
                                divide-y
                                dark:divide-gray-700 dark:bg-gray-800
                            "
                        >
                            <template
                                v-for="recruiter in recruiters"
                                :key="recruiter.user_id"
                            >
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p
                                                class="
                                                    font-semibold
                                                    dark:text-white
                                                    capitalize
                                                "
                                            >
                                                {{ recruiter.user_id }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{ recruiter.company_name }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{ recruiter.full_name }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{ recruiter.email }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            0{{ recruiter.phone_number }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                                capitalize
                                            "
                                        >
                                            {{
                                                recruiter.gender === "o"
                                                    ? "other"
                                                    : ""
                                            }}
                                            {{
                                                recruiter.gender === "f"
                                                    ? "female"
                                                    : ""
                                            }}
                                            {{
                                                recruiter.gender === "m"
                                                    ? "male"
                                                    : ""
                                            }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{
                                                new Date(
                                                    recruiter.date_birth
                                                ).toLocaleDateString()
                                            }}
                                        </p>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div
                        v-if="!recruiters.length > 0"
                        class="w-full text-center"
                    >
                        <p
                            class="
                                text-gray-700
                                dark:text-gray-400
                                text-sm
                                font-semibold
                                tracking-wide
                            "
                        >
                            Loading...
                        </p>
                    </div>
                </div>
            </div>
            <h3
                class="
                    my-6
                    text-lg
                    font-semibold
                    text-gray-700
                    dark:text-gray-200
                "
            >
                Candidate List
            </h3>
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
                                <th class="px-4 py-3">User ID</th>
                                <th class="px-4 py-3">Full Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Phone Number</th>
                                <th class="px-4 py-3">Gender</th>
                                <th class="px-4 py-3">Date Of Birth</th>
                            </tr>
                        </thead>
                        <tbody
                            v-if="candidates.length > 0"
                            class="
                                bg-white
                                divide-y
                                dark:divide-gray-700 dark:bg-gray-800
                            "
                        >
                            <template
                                v-for="candidate in candidates"
                                :key="candidate.user_id"
                            >
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p
                                                class="
                                                    font-semibold
                                                    dark:text-white
                                                    capitalize
                                                "
                                            >
                                                {{ candidate.user_id }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{ candidate.full_name }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{ candidate.email }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            0{{ candidate.phone_number }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                                capitalize
                                            "
                                        >
                                            {{
                                                candidate.gender === "o"
                                                    ? "other"
                                                    : ""
                                            }}
                                            {{
                                                candidate.gender === "f"
                                                    ? "female"
                                                    : ""
                                            }}
                                            {{
                                                candidate.gender === "m"
                                                    ? "male"
                                                    : ""
                                            }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <p
                                            class="
                                                font-semibold
                                                dark:text-white
                                            "
                                        >
                                            {{
                                                new Date(
                                                    candidate.date_birth
                                                ).toLocaleDateString()
                                            }}
                                        </p>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div
                        v-if="!candidates.length > 0"
                        class="w-full text-center"
                    >
                        <p
                            class="
                                text-gray-700
                                dark:text-gray-400
                                text-sm
                                font-semibold
                                tracking-wide
                            "
                        >
                            Loading...
                        </p>
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
            recruiters: [],
            candidates: [],
        };
    },
    async mounted() {
        const res = await this.$store.dispatch("job/getListUser");
        this.recruiters = [...res.recruiter];
        this.candidates = [...res.candidate];
        console.log(this.recruiters);
    },
};
</script>
