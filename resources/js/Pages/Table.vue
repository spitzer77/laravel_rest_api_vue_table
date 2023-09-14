<template>
    <div class="table-auto">
        <form>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">

                            <table class="min-w-full text-left text-sm font-light">
                                <tr>
                                    <td>
                                        <div class="flex items-center space-x-1">
                                            <div>
                                                <input type="text" v-model="filters.name"
                                                       class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Name">
                                            </div>
                                            <div>
                                                <input type="text" v-model="filters.price_from"
                                                       class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Price from">
                                            </div>
                                            <div>
                                                <input type="text" v-model="filters.price_to"
                                                       class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Price to">
                                            </div>
                                            <div>
                                                <input type="text" v-model="filters.bedrooms"
                                                       class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Bedrooms">
                                            </div>
                                            <div>
                                                <input type="text" v-model="filters.bathrooms"
                                                       class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Bathrooms">
                                            </div>
                                            <div>
                                                <input type="text" v-model="filters.storeys"
                                                       class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Storeys">
                                            </div>
                                            <div>
                                                <input type="text" v-model="filters.garages"
                                                       class="w-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Garages">
                                            </div>
                                            <button type="submit" @click.prevent="getData()"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Apply filter
                                            </button>
                                            <button type="submit" @click.prevent="clearFilters()"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Clear
                                            </button>
                                            <div class="text-center" v-if="filtering" style="margin-left: 10px;">
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div v-if="this.items && this.items.length > 0" class="mt-2">
                                Results: {{ this.items.length }}
                            </div>

                            <div v-if="this.error">
                                <div v-for="mess in message" class="mt-2" role="alert">
                                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2 ">
                                        Error
                                    </div>
                                    <div
                                        class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                                        <p>{{ mess }}</p>
                                    </div>
                                </div>
                            </div>

                            <table v-else-if="items" class="min-w-full text-left text-sm font-light mt-2">
                                <thead class="border-b font-medium dark:border-neutral-500 bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left">
                                        <button type="submit" @click.prevent="sortItems('name', 'asc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-up" :class="{ active: isAscActive.name }"></span>
                                        </button>
                                        Name
                                        <button type="submit" @click.prevent="sortItems('name', 'desc')"
                                                class="focus:outline-none">
                                            <span class="arrow-icon-down" :class="{ active: isDescActive.name }"></span>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left">
                                        <button type="submit" @click.prevent="sortItems('price', 'asc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-up" :class="{ active: isAscActive.price }"></span>
                                        </button>
                                        Price
                                        <button type="submit" @click.prevent="sortItems('price', 'desc')"
                                                class="focus:outline-none">
                                            <span class="arrow-icon-down"
                                                  :class="{ active: isDescActive.price }"></span>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        <button type="submit" @click.prevent="sortItems('bedrooms', 'asc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-up"
                                                  :class="{ active: isAscActive.bedrooms }"></span>
                                        </button>
                                        Bedrooms
                                        <button type="submit" @click.prevent="sortItems('bedrooms', 'desc')"
                                                class="focus:outline-none">
                                            <span class="arrow-icon-down"
                                                  :class="{ active: isDescActive.bedrooms }"></span>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        <button type="submit" @click.prevent="sortItems('bathrooms', 'asc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-up"
                                                  :class="{ active: isAscActive.bathrooms }"></span>
                                        </button>
                                        Bathrooms
                                        <button type="submit" @click.prevent="sortItems('bathrooms', 'desc')"
                                                class="focus:outline-none" :class="{ active: isDescActive.bathrooms }">
                                            <span class="arrow-icon-down"></span>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        <button type="submit" @click.prevent="sortItems('storeys', 'asc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-up" :class="{ active: isAscActive.storeys }"></span>
                                        </button>
                                        Storeys
                                        <button type="submit" @click.prevent="sortItems('storeys', 'desc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-down"
                                                  :class="{ active: isDescActive.storeys }"></span>
                                        </button>
                                    </th>
                                    <th scope="col" class="px-6 py-4">
                                        <button type="submit" @click.prevent="sortItems('garages', 'asc')"
                                                class="ml-1 focus:outline-none">
                                            <span class="arrow-icon-up" :class="{ active: isAscActive.garages }"></span>
                                        </button>
                                        Garages
                                        <button type="submit" @click.prevent="sortItems('garages', 'desc')"
                                                class="focus:outline-none">
                                            <span class="arrow-icon-down"
                                                  :class="{ active: isDescActive.garages }"></span>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in items" class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ item.name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ item.price }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ item.bedrooms }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ item.bathrooms }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ item.storeys }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ item.garages }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <div v-else
                                 class="mt-2 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                                 role="alert">
                                <div class="flex">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold">No result where found</p>
                                        <p class="text-sm">Make sure you know that you have filtered by existing data.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Table",
    layout: MainLayout,

    components: {},

    data() {
        return {
            items: [],
            error: '',
            message: '',
            filters: {
                name: '',
                price_from: '',
                price_to: '',
                bedrooms: '',
                bathrooms: '',
                storeys: '',
                garages: '',
            },

            sortBy: '',
            sortDirection: '',

            isAscActive: {
                name: false,
                price: false,
                bedrooms: false,
                bathrooms: false,
                storeys: false,
                garages: false,
            },

            isDescActive: {
                name: false,
                price: false,
                bedrooms: false,
                bathrooms: false,
                storeys: false,
                garages: false,
            },

            filtering: false,
        }
    },
    mounted() {
        document.querySelector(".arrow-icon-up").addEventListener("click", function () {
            this.classList.add("active");
        });

        document.querySelector(".arrow-icon-down").addEventListener("click", function () {
            this.classList.add("active");
        });

        this.getData()
    },

    methods: {
        getData() {

            this.filtering = true;

            axios.get('/api/data', {params: this.filters})
                .then((response) => {
                    this.items = response.data.data
                    this.error = response.data.error
                    this.message = response.data.message
                })
                .catch((error) => {
                    console.error(error);
                })
                .finally(() => {
                    this.filtering = false;
                })
        },

        sortItems(field, by) {
            for (const key in this.isAscActive) { this.isAscActive[key] = false }
            for (const key in this.isDescActive) { this.isDescActive[key] = false }

            this.isAscActive[field] = by === 'asc';
            this.isDescActive[field] = by === 'desc';

            this.filters.sortBy = by;
            this.filters.sortDirection = field;

            this.getData()
        },

        clearFilters() {
            for (const key in this.filters) {this.filters[key] = '' }
            for (const key in this.isAscActive) { this.isAscActive[key] = false }
            for (const key in this.isDescActive) {this.isDescActive[key] = false }

            this.filters.sortBy = ''
            this.filters.sortDirection = ''

            this.getData();
        },
    },
}
</script>

<style scoped>
@import "font-awesome/css/font-awesome.css";
.arrow-icon-down::after {
    content: "▼";
    color: grey;
}

.arrow-icon-down.active::after {
    content: "▼";
    color: black;
}

.arrow-icon-up::after {
    content: "▲";
    color: grey;
}

.arrow-icon-up.active::after {
    content: "▲";
    color: black;
}
</style>
