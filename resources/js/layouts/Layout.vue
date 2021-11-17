<template>
    <div
        class="flex h-auto min-h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        <SideBar />
        <div class="flex flex-col flex-1 w-full">
            <Header />
            <router-view />
        </div>
    </div>
</template>

<script>
import { Header, SideBar } from "../components";
export default {
    data() {
        return {
            isSideMenuOpen: false,
        };
    },
    components: {
        Header,
        SideBar,
    },
};
</script>
