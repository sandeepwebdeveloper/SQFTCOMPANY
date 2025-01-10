class registerPopup {
    constructor() {
        //alert("Testing Mobile Menu...");

        this.PopUpOpenButton = document.querySelectorAll(".popup-menu-btn")
        this.zindexmenu = document.querySelector(".register-popup__index")
        this.CloseButton = document.querySelector(".popup-close")
        this.FormWrapper = document.querySelector(".register-popup__wrap")
        this.FormOuter = document.querySelector(".register-popup")
        this.overlaymenu = document.querySelector(".overlaymenu__hide")

        this.PopUpevents()
    }
    PopUpevents() {
        this.CloseButton.addEventListener("click", () => this.toggleTheMenuButton())
        this.PopUpOpenButton.forEach(el => el.addEventListener("click", e => this.OpenPopup(e)))
    }
    toggleTheMenuButton() {
        this.FormWrapper.classList.remove("register-popup--visible");
        this.overlaymenu.classList.remove("overlaymenu__visible");
        this.FormOuter.classList.remove("register-popup__index");
        //this.onlyCustomer.classList.toggle("d-block");

        // this.formCustomer.classList.toggle("d-none");
        // this.formRealestateAgent.classList.toggle("d-block");

        //console.log("Hoorey - The icon was clicked");
    }
    OpenPopup(e) {
        this.FormWrapper.classList.toggle("register-popup--visible");
        this.overlaymenu.classList.toggle("overlaymenu__visible");
        this.FormOuter.classList.add("register-popup__index");
        console.log("Hoorey - The icon was clicked");
    }
}
export default registerPopup