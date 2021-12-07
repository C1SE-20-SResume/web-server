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
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Content</th>
                                <th></th>
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
                                v-for="item in question.aptitude"
                                :key="item.ques_id"
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
                                                {{ item.type_name }}
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
                                            {{ item.ques_content }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        <button
                                            @click="
                                                (e) => {
                                                    e.preventDefault();
                                                    oForm(item.ques_option);
                                                }
                                            "
                                            class="dark:hover:text-white"
                                        >
                                            View more
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div
            v-show="openForm"
            class="
                absolute
                top-1/2
                left-1/2
                -translate-y-1/2 -translate-x-1/2
                transform
                bg-white
                rounded-xl
                p-6
                shadow-xl
            "
            id="formView"
        ></div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            question: {},
            openForm: false,
        };
    },
    async mounted() {
        try {
            const res = await this.$store.dispatch("job/getListQuestion");
            this.question = res;
        } catch (error) {
            console.log(error);
        }
    },

    methods: {
        oForm(data) {
            this.openForm = true;
            // insert data to ref Form
            let form = document.getElementById("formView");
            let title = document.createElement("h3");
            title.className = "text-2xl font-semibold text-gray-800 mb-4";
            title.innerHTML = "List Option";
            form.appendChild(title);
            data.forEach((item) => {
                let div = document.createElement("div");
                div.className = "flex flex-col";
                div.innerHTML = `
                    <div class="flex flex-col mb-4">
                        <p class="text-gray-800">
                            - ${item.option_content}
                        </p>
                    </div>
                `;
                form.appendChild(div);
            });
            let close = document.createElement("button");
            close.className =
                "text-white bg-gray-800 px-5 py-1 rounded-full mt-4 hover:text-gray-800 hover:bg-gray-200 transition-all duration-300";
            close.innerHTML = "Close";
            close.addEventListener("click", () => {
                this.openForm = false;
                form.innerHTML = "";
            });
            form.appendChild(close);
        },
    },
};
</script>
