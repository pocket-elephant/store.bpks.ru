import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import DaDataNext from 'vue-dadata-3';


createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(DaDataNext, {
                token: 'b9d28ab5a7223f86589fce08352230f5f489dd10',
            })
            .mount(el)
    },
})

if (process.env.NODE_ENV === 'production') {

    let referrer = document.referrer;

    Inertia.on('navigate', (event) => {
        ym(102049974, 'hit', window.location.href, {
            referer: referrer,
            callback: () => {
                referrer = window.location.href;
            },
        });
    })
}
