<template>
    <div class="container w-full h-full border-4 align-center mx-auto">
        <div class="max-h-10 mb-4 ml-4">
            <GoBack class="" />
        </div>

        <div
            class="items-center text-center text-white font-extrabold bg-slate-600 px-2 py-2 rounded-md"
        >
            <h1 class="px-2 py-3 bg-black-50 col-span-2">Test Page</h1>
        </div>

        <div class="input m-4">
            <label for="" class="m-2">Enter a fruit name</label>
            <input type="text" v-model="fruit" />
        </div>

        <div v-if="correctAnswer">
            <p>{{ this.message }}</p>
        </div>
        <button
            class="m-3 border-gray-500 border-2 bg-green-500 rounded-md p-1 text-white"
            @click="changeQueryString"
        >
            Update Query String
        </button>
        <button
            class="m-3 border-gray-500 border-2 bg-slate-500 rounded-md p-1 text-white"
            @click="removeQueryString"
        >
            Remove Query String
        </button>

        <div class="ml-4 mb-4">
            <p>FORECAST</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import GoBack from "../utils/GoBack.vue";

export default {
    components: {
        GoBack,
    },

    data() {
        return {
            fruit: "",
            correctAnswer: null,
            message: "",
        };
    },

    methods: {
        changeQueryString() {
            this.$router.replace({
                query: { fruit: this.fruit.toLocaleLowerCase() },
            });
            this.fruit = "";
        },

        removeQueryString() {
            this.$router.replace({ name: "test_page" });
        },
    },
    watch: {
        $route() {
            if(this.$route.query.fruit === "apple") {
                this.correctAnswer = !this.correctAnswer;
                this.message = "congrats, you found the lucky fruit";
            } else {
                this.correctAnswer = null;
            }
        },
    },
};
</script>
