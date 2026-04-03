/**
 * @typedef MarkerInstance
 *
 * @property {string} title
 * @property {string} text
 * @property {string} image
 * @property {string} lat
 * @property {string} long
 * @property {string} order
 */

/**
 * @typedef MapLibrariesInstances
 *
 * @property {google.maps.MarkerLibrary|null} marker
 * @property {google.maps.InfoWindow|null} infoWindow
 */

import { setOptions, importLibrary } from "@googlemaps/js-api-loader";

/**
 * @param {string} html
 * @param {boolean} trim
 *
 * @return {Element | HTMLCollection | null}
 */
const toHTMLElement = (html = '', trim = true) => {
    html = trim ? html.trim() : html

    if (!html) return null

    const template = document.createElement('template')
    template.innerHTML = html

    const result = template.content.children

    if (result.length === 1) return result[0]
    return result
}

const GOOGLE_MAP_LIBS = /** @type {WeakMap<HTMLElement,MapLibrariesInstances>}*/ new WeakMap()
const MAP_ELEMENTS = document.querySelectorAll('[data-map-key]')

MAP_ELEMENTS.forEach(createGoogleMap)

/**
 * @param {HTMLElement} element
 */
function createGoogleMap(element) {
    if (!element || !(element instanceof Element))
        return

    const {
        mapKey = '',
        mapLat = '',
        mapLng = '',
        mapPin = '',
        mapZoom = '',
        mapMarkers = '[]',
        mapLanguage = '',
        mapRegion = '',
    } = element.dataset

    // Configure the API key once before importing libraries
    setOptions({
        apiKey: mapKey,
        version: "3.59",
        language: mapLanguage,
        region: mapRegion,
    })

    const allowedBounds = {
        north: 85,
        east: 180,
        south: -85,
        west: -180,
    }

    importLibrary('maps')
        .then(async ({ Map, StyledMapType }) => {
            const markerLibrary = await importLibrary('marker')

            GOOGLE_MAP_LIBS.set(element, {
                marker: markerLibrary,
                infoWindow: null
            })

            const options = {
                center: new google.maps.LatLng(
                    parseFloat(mapLat),
                    parseFloat(mapLng),
                ),
                restriction: {
                    latLngBounds:   allowedBounds,
                    strictBounds:   true,
                },
                zoom:               parseFloat(mapZoom),
                minZoom:            1,
                mapTypeControl:     false,
                streetViewControl:  false,
                scrollwheel:        false,
                keyboardShortcuts:  false,
                mapId:              'DEMO_MAP_ID',
            }

            const map = new Map(element, options)

            try {
                addAdvancedMarker(map, {
                    markers: JSON.parse(mapMarkers),
                    icon: mapPin,
                })
            }
            catch (error) {
                console.warn('(ERROR) Parsing markers:', error)
                throw error
            }

            google.maps.event.addListener(map, 'click', () => {
                const MapLibraries = GOOGLE_MAP_LIBS.get(element)

                if (MapLibraries.infoWindow) {
                    MapLibraries.infoWindow.close()
                    MapLibraries.infoWindow = null
                }
            })

            google.maps.event.addListener(map, 'dragstart', () => {
                const MapLibraries = GOOGLE_MAP_LIBS.get(element)

                if (MapLibraries.infoWindow) {
                    MapLibraries.infoWindow.close()
                    MapLibraries.infoWindow = null
                }
            })
        })
        .catch(error => {
            console.warn('(ERROR) loading google map libraries:', error)
        })
}

/**
 * @param {google.maps.Map} map
 * @param {{markers: MarkerInstance[], icon: string}} options
 *
 * @return {google.maps.marker.AdvancedMarkerElement[]}
 */
function addAdvancedMarker(map, options) {
    const {
        markers = /** @type {MarkerInstance[]} */ [],
        icon = ''
    } = options

    const MapLibraries = GOOGLE_MAP_LIBS.get(map.getDiv())
    const LatLngBounds = new google.maps.LatLngBounds()

    if (!MapLibraries) {
        console.warn('(ERROR) Loading Lib Instances')
        return
    }

    const activeAdvancedMarkers = markers.reduce((accumulator, marker) => {
        const advancedMarkerElement = new MapLibraries.marker.AdvancedMarkerElement({
            map: map,
            position: new google.maps.LatLng(
                parseFloat(marker.lat),
                parseFloat(marker.long),
            ),
            ...(icon && { content: toHTMLElement(`<img src="${icon}" alt="marker_pin"/>`) })
        })

        const infoWindow = addInfoWindow(map, marker)

        advancedMarkerElement.addEventListener("gmp-click", () => {
            infoWindow.open({ map, anchor: advancedMarkerElement })
            map.panTo(advancedMarkerElement.position)
        })

        LatLngBounds.extend(advancedMarkerElement.position)
        accumulator.push(advancedMarkerElement)

        return accumulator
    }, /** @type google.maps.marker.AdvancedMarkerElement[] */ [])

    if (!LatLngBounds.isEmpty() && markers.length >= 2)
        map.fitBounds(LatLngBounds)

    return activeAdvancedMarkers
}

/**
 * @param {google.maps.Map} map
 * @param {MarkerInstance} options
 *
 * @returns {google.maps.InfoWindow|undefined}
 */
function addInfoWindow(map, options) {
    const {
        title = '',
        text = '',
        image = '',
    } = options

    const MapLibraries = GOOGLE_MAP_LIBS.get(map.getDiv())

    if (!MapLibraries) {
        console.warn('(ERROR) Loading Lib Instances')
        return
    }

    const content = /** @type Element */ toHTMLElement(`
        <div class="ccMapMarker flex flexWrap">
            <div class="locationsListItemImageContainer">
                <div class="locationsListItemImage">
                    ${image
        ? `<img src="${image}" alt="${title}"/>`
        : ''
    }
                </div>
            </div>
            <div class="locationsListItemBody flex flexColumn">
                <div class="locationsListItemTitle">${title}</div>
                <div class="locationsListItemText marginTop10">${text}</div>
            </div>
        </div>
    `)

    const infoWindow = new google.maps.InfoWindow({
        content: content,
        disableAutoPan: false,
    })

    infoWindow.addListener('gmp-infowindow-rendered', () => {
        if (MapLibraries.infoWindow && MapLibraries.infoWindow !== infoWindow) {
            MapLibraries.infoWindow.close()
            MapLibraries.infoWindow = null
        }

        MapLibraries.infoWindow = infoWindow
    })

    infoWindow.addListener('closeclick', () => {
        MapLibraries.infoWindow = null
    })

    return infoWindow
}
