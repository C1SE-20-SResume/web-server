<template>
    <!-- Desktop sidebar -->
    <aside
        class="
            z-20
            hidden
            w-64
            overflow-y-auto
            bg-white
            dark:bg-gray-800
            md:block
            flex-shrink-0
        "
    >
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a
                class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                href="#"
            >
                Sresume Admin
            </a>
            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <router-link
                        :to="{ name: 'dashboard' }"
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        exactActive-class="active text-gray-800 dark:text-gray-100"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            ></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </router-link>
                </li>
                <li class="relative px-6 py-3">
                    <router-link
                        :to="{ name: 'list-company' }"
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        exactActive-class="active text-gray-800 dark:text-gray-100"
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
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                            />
                        </svg>
                        <span class="ml-4">List Company</span>
                    </router-link>
                </li>
                <li class="relative px-6 py-3">
                    <router-link
                        :to="{ name: 'list-question' }"
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        exactActive-class="active text-gray-800 dark:text-gray-100"
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
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <span class="ml-4">List Question</span>
                    </router-link>
                </li>
                <li class="relative px-6 py-3">
                    <router-link
                        :to="{ name: 'list-user' }"
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        exactActive-class="active text-gray-800 dark:text-gray-100"
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
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                            />
                        </svg>
                        <span class="ml-4">List User</span>
                    </router-link>
                </li>
            </ul>
            <ul>
                <!-- <li class="relative px-6 py-3">
                    <a
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        href="forms.html"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                            ></path>
                        </svg>
                        <span class="ml-4">Forms</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        href="cards.html"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                            ></path>
                        </svg>
                        <span class="ml-4">Cards</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        href="charts.html"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                            ></path>
                            <path
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"
                            ></path>
                        </svg>
                        <span class="ml-4">Charts</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        href="buttons.html"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"
                            ></path>
                        </svg>
                        <span class="ml-4">Buttons</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a
                        class="
                            inline-flex
                            items-center
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        href="modals.html"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                            ></path>
                        </svg>
                        <span class="ml-4">Modals</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <button
                        class="
                            inline-flex
                            items-center
                            justify-between
                            w-full
                            text-sm
                            font-semibold
                            transition-colors
                            duration-150
                            hover:text-gray-800
                            dark:hover:text-gray-200
                        "
                        @click="togglePostsMenu"
                        aria-haspopup="true"
                    >
                        <span class="inline-flex items-center">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"
                                ></path>
                            </svg>
                            <span class="ml-4">Posts</span>
                        </span>
                        <svg
                            class="w-4 h-4"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                    <transition
                        enter-active-class="transition-all ease-in-out duration-300"
                        enter-from-class="opacity-25 max-h-0"
                        enter-to-class="opacity-100 max-h-xl"
                        leave-active-class="transition-all ease-in-out duration-300"
                        leave-from-class="opacity-100 max-h-xl"
                        leave-to-class="opacity-0 max-h-0"
                    >
                        <ul
                            v-if="isPostsMenuOpen"
                            class="
                                p-2
                                mt-2
                                space-y-2
                                overflow-hidden
                                text-sm
                                font-medium
                                text-gray-500
                                rounded-md
                                shadow-inner
                                bg-gray-50
                                dark:text-gray-400 dark:bg-gray-900
                            "
                            aria-label="submenu"
                        >
                            <li
                                class="
                                    px-2
                                    py-1
                                    transition-colors
                                    duration-150
                                    hover:text-gray-800
                                    dark:hover:text-gray-200
                                "
                            >
                                <router-link
                                    :to="{ name: 'create-post' }"
                                    class="w-full"
                                    exactActive-class="active text-gray-800 dark:text-gray-100"
                                >
                                    New Post
                                </router-link>
                            </li>
                            <li
                                class="
                                    px-2
                                    py-1
                                    transition-colors
                                    duration-150
                                    hover:text-gray-800
                                    dark:hover:text-gray-200
                                "
                            >
                                <router-link
                                    :to="{ name: 'list-post' }"
                                    class="w-full"
                                    exactActive-class="active text-gray-800 dark:text-gray-100"
                                >
                                    List Post
                                </router-link>
                            </li>
                            <li
                                class="
                                    px-2
                                    py-1
                                    transition-colors
                                    duration-150
                                    hover:text-gray-800
                                    dark:hover:text-gray-200
                                "
                            >
                                <router-link
                                    :to="{ name: 'list-category' }"
                                    class="w-full"
                                    exactActive-class="active text-gray-800 dark:text-gray-100"
                                >
                                    Categories
                                </router-link>
                            </li>
                        </ul>
                    </transition>
                </li> -->
            </ul>
        </div>
    </aside>
</template>

<script>
export default {
    data() {
        return {
            isPagesMenuOpen: false,
            isPostsMenuOpen: false,
        };
    },
    methods: {
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen;
        },
        togglePostsMenu() {
            this.isPostsMenuOpen = !this.isPostsMenuOpen;
        },
    },
};
</script>
