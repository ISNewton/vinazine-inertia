import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'vite-plugin-laravel/inertia'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()

createInertiaApp({
	resolve: (name) => resolvePageComponent(name, import.meta.glob('../views/dashboard/**/*.vue')),
	setup({ el, app, props, plugin }) {
		createApp({ render: () => h(app, props) })
			.use(plugin)
			.mount(el)
	},
})