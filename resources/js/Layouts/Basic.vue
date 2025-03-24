<script setup>
import {Link} from "@inertiajs/vue3";

const links = [
    {
        name: 'Главная',
        url: '/',
    },
    {
        name: 'О компании',
        url: '/about',
    },
    {
        name: 'Контакты',
        url: '/contacts',
    },
];
</script>

<template>
    <div class="flex flex-col h-screen">
        <header>

            <div class="bg-gray-800">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="items-center flex py-2 justify-between">
                        <div class="flex">
                            <span class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium cursor-pointer"
                            aria-current="page"><svg viewBox="0 0 10.134 15.626" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-3 fill-white float-left mr-2"><path d="M7.873,0.853c-1.705-1.137-3.908-1.137-5.612,0C0.065,2.316-0.638,5.167,0.626,7.484l4.441,8.142l4.441-8.142  C10.772,5.167,10.07,2.316,7.873,0.853z M8.631,7.006l-3.563,6.533L1.504,7.006C0.49,5.146,1.053,2.859,2.816,1.685  C3.5,1.229,4.283,1,5.067,1s1.567,0.228,2.251,0.684C9.081,2.859,9.645,5.146,8.631,7.006z"></path><path
                            d="M5.067,2.083c-1.378,0-2.5,1.122-2.5,2.5s1.122,2.5,2.5,2.5s2.5-1.122,2.5-2.5S6.446,2.083,5.067,2.083z M5.067,6.083  c-0.827,0-1.5-0.673-1.5-1.5s0.673-1.5,1.5-1.5s1.5,0.673,1.5,1.5S5.894,6.083,5.067,6.083z"></path></svg><span
                            class="whitespace-nowrap text-ellipsis overflow-hidden">г Санкт-Петербург</span>
                            </span>
                        </div>
                        <div class="flex items-center">
                            <nav class="hidden items-baseline space-x-4 md:flex">
                                <Link :href="link.url" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium whitespace-nowrap text-ellipsis overflow-hidden" v-for="link in links">{{ link.name }}</Link>
                            </nav>
                        </div>
                        <div class="w-6 h-6 text-white cursor-pointer md:hidden block absolute right-4 top-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                            </svg>
                        </div>
                        <div class="bg-red-500 text-white rounded-md text-center mr-10 md:mr-0" id="odb_client_code">
                            <div class="text-md font-bold leading-5" id="odb_client_code_value">8766</div>
                            <div class="text-xs px-2 whitespace-nowrap">код клиента</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow">
                <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex space-x-6">
                        <a class="text-3xl font-bold tracking-tight text-red-600 hidden lg:block leading-5" href="/">
                            <span class="inline-block">БалтПромКомплект</span>
                            <span class="inline-block text-base text-gray-600">оптовые поставки</span>
                        </a>

                        <div class="w-full">
                            <form method="get" action="/search" class="-ml-4 md:ml-auto">
                                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                             class="w-6 h-6 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" autocomplete="off" name="query" id="default-search"
                                           class="block p-3 pl-12 w-full text-base text-gray-400 bg-gray-100 rounded-md border border-gray-200 focus:ring-gray-300 focus:border-gray-400"
                                           placeholder="поиск по каталогу" required=""><!----></div>
                            </form>
                        </div>


                        <Link
                            class="text-xs text-gray-600 hover:text-red-700 relative flex-col justify-center content-between items-center hidden md:flex"
                            href="/cart"><!---->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true" class="w-8 h-8 inline-flex">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                            </svg>
                            <span>Корзина</span></Link>

                    </div>

                    <div class="flex space-x-6 justify-between mt-6 whitespace-nowrap overflow-y-hidden overflow-x-auto">

                        <div class="flex flex-col md:flex-row justify-around w-full">
                            <a href="tel:+78124154045" class="font-bold md:text-xl whitespace-nowrap">
                                <span class="hidden-contact">8 (812) 415-40-45</span></a>
                            <span class="font-bold text-sm md:text-base text-gray-400">Санкт-Петербург</span>
                        </div>

                        <div class="flex flex-col md:flex-row justify-around w-full">
                            <a href="tel:+78124154045" class="font-bold md:text-xl whitespace-nowrap">
                                <span class="hidden-contact">8 (495) 780-77-98</span></a>
                            <span class="font-bold text-sm md:text-base text-gray-400">Москва</span>
                        </div>

                        <div class="flex flex-col md:flex-row justify-around w-full">
                            <a href="tel:+78124154045" class="font-bold md:text-xl whitespace-nowrap">
                                <span class="hidden-contact">8 (800) 3333 899</span></a>
                            <span class="font-bold text-sm md:text-base text-gray-400">Регионы</span>
                        </div>
                    </div>
                </div>
            </div>

        </header>


        <div class="flex-grow">
            <div class="mx-auto max-w-7xl px-6 py-6 sm:px-8 lg:px-8">
                <slot/>
            </div>
        </div>



        <footer class="bg-gray-800 text-white pb-8 md:pb-0">
            <div class="mx-auto max-w-7xl px-6 py-12 sm:px-8 lg:px-8">
                <div class="md:flex md:justify-between">
                    <div>
                        <div class="text-2xl mb-4">Навигация</div>
                        <ul>
                            <li class="mb-2" v-for="link in links">
                                <Link :href="link.url">{{ link.name }}</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="text-2xl mb-4">Наши филиалы</div>
                        <div class="mb-8"> Санкт-Петербург<br> ул. Короленко, д.7 лит.А<br><a
                            href="tel:88124540554"><span class="hidden-contact hidden-contact_dark" data-v-5cbb1e10="">(812) 454-05-54</span></a></div>
                        <div class="mb-8"> Москва<br>2-ая ул. Энтузиастов, д.3<br><a href="tel:84957807798"><span
                            class="hidden-contact hidden-contact_dark" data-v-5cbb1e10="">(495) 780-77-98</span></a></div>
                    </div>
                    <div>
                        <div class="text-2xl mb-4">Режим работы</div>
                        <div class="mb-8"> Работаем по будням<br> с 8:30 до 18:00 (Время московское)</div>
                        <div>
                            <a class="text-3xl block" href="tel:88003333899">
                                <span class="hidden-contact hidden-contact_dark">8 (800) 3333 899</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mb-6">© 2025 БалтПромКомплект — комплексные поставки высококачественной продукции
                промышленного и бытового назначения
            </div>
            <div class="text-center mb-6"><a href="https://bpks.ru/privacy-policy" about="_blank">Политика конфиденциальности</a>, <a
                href="https://bpks.ru/user-agreement" about="_blank">Согласие на обработку персональных данных</a></div>
        </footer>
    </div>
</template>
