import { overlay_store, resize_directive } from "@codicagr/cms-core"

export default function (Alpine) {
    Alpine.store('overlay_store', overlay_store)
    Alpine.directive('resize', resize_directive)
}
