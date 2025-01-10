import '/node_modules/fullpage.js/dist/fullpage.js';
class DotNavigationScript {
    constructor() {
            //alert("Testing Mobile Menu...");
            this.DotSelector = document.querySelectorAll("#fullpage");
            this.NavFunction()
        }
        // events() {
        //     this.ButtonOnClick.addEventListener("click", () => this.toggleTheMenu())
        // }
    NavFunction() {
        const myFullpage = new fullpage(this.DotSelector, {
            anchors: ['firstPage', 'secondPage', '3rdPage'],
            sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C'],
            navigation: true,
            navigationPosition: 'left',
            navigationTooltips: ['First page', 'Second page', 'Third and last page']
        });
    }
}
export default DotNavigationScript