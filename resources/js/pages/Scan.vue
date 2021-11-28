<template>
    <div class="bg-gray-700 min-h-screen h-auto relative">
        <div
            class="
                absolute
                top-1/2
                left-1/2
                -translate-x-1/2 -translate-y-1/2
                transform
            "
        >
            <form
                @submit.prevent="onSubmit"
                class="
                    p-4
                    shadow-md
                    rounded-md
                    border border-gray-200
                    bg-gray-200
                "
            >
                <div class="mb-4">
                    <label class="block">File</label>
                    <input
                        @change="onFileChange"
                        type="file"
                        name="file_cv"
                        required
                    />
                </div>
                <div class="mb-4">
                    <select
                        name="option_language"
                        class="rounded-md"
                        @change="onLanguageChange"
                    >
                        <option value="en">English</option>
                        <option value="vi">Vietnamese</option>
                        <option value="en_vi">Eng + Viet</option>
                    </select>
                </div>
                <button
                    class="
                        py-2
                        px-6
                        border
                        bg-pink-500
                        text-white
                        hover:bg-gray-200
                        hover:text-pink-500
                        hover:border-pink-500
                        rounded-xl
                        transition-all
                        duration-300
                    "
                >
                    Submit
                </button>
            </form>
            <div v-if="data" class="mt-5 text-gray-600 p-4 min-h-10">
                {{ data }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            file: null,
            language: "en",
            data: null,
        };
    },
    methods: {
        onSubmit() {
            const formData = new FormData();
            formData.append("file_cv", this.file);
            formData.append("lang", this.language);
            const res = this.$store.dispatch("job/scanCV", formData);
            res.then((res) => res.data)
                .then((res) => {
                    this.data = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        onFileChange(e) {
            this.file = e.target.files[0];
        },
        onLanguageChange(e) {
            this.language = e.target.value;
        },
    },
};
</script>
