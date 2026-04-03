import Alpine       from 'alpinejs'
import focus        from '@alpinejs/focus'
import collapse     from '@alpinejs/collapse'

Alpine.plugin(focus)
Alpine.plugin(collapse)

window.addEventListener('DOMContentLoaded',() => {
    Alpine.start()
}, { once: true })

window.addEventListener('alpine:init', () => {
    console.log("Alpine", Alpine.version)
})

export default Alpine;
