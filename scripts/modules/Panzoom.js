import $ from 'jquery';
import Panzoom from '@panzoom/panzoom';
class PanzoomScript {
    constructor() {
        this.Zoombutton = document.querySelector('.zoom-in')
        this.ZoomOut = document.querySelector('.zoom-out')
        this.elem = document.querySelector('.panzoom img')
        this.eventsOnWindowLoad()
            ///this.OnClickChangeImages()
    }
    eventsOnWindowLoad() {
        window.addEventListener("load", () => this.MegniFierSelector())
    }
    MegniFierSelector() {
        const panzoom = Panzoom(this.elem, {
            minScale: 1,
            maxScale: 5,
            increment: 1,
            contain: 'outside',
            panOnlyWhenZoomed: true,
        })

        // Overrides disablePan and panOnlyWhenZoomed
        //panzoom.pan(50, 100, { force: true })
        // Overrides disableZoom
        //panzoom.zoom(1, { force: true })


        // Panning and pinch zooming are bound automatically (unless disablePan is true).
        // There are several available methods for zooming
        // that can be bound on button clicks or mousewheel.
        // this.Zoombutton.addEventListener('click', panzoom.zoomIn)
        // this.elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel)

        this.Zoombutton.addEventListener('click', panzoom.zoomIn)
        this.ZoomOut.addEventListener('click', panzoom.zoomOut)
            //this.elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel)

    }
}
export default PanzoomScript