//import Magnifier from 'magnifier';

import $ from 'jquery';

class FormValidations {
    constructor() {
        $AreYouBroker = document.querySelector('input[type=radio][name="MMERGE6"]');
        $AreYouBrokerInput = document.getElementById('NOB');
        $AreYouBrokerInputAttr = document.getElementById('NameofBroker');
        this.OnLoadEvent();
    }
    OnLoadEvent() {
        //this.AreYouBroker.forEach(el => el.addEventListener("change", e => this.AreYouBrokerAction(e)))
        this.AreYouBroker.addEventListener("change", () => this.AreYouBrokerAction())
    }
    AreYouBrokerAction() {
            $('input[type=radio][name=MMERGE6]').change(function() {
                if (this.value == 'Yes') {
                    $('#NOB').fadeIn();
                    $('.postal-code').hide();
                } else if (this.value == 'No') {
                    $('.broker-name').hide();
                    $('.postal-code').fadeIn();
                }
            });
        }
        // AreYouWorkingWithBrokerAction() {
        //     if ((this.AreYouWorkingWithBroker).value == 'Yes') {
        //         this.AreYouWorkingWithBrokerInput.classList.add("d-block");
        //         this.AreYouWorkingWithBrokerInput.classList.remove("d-none");
        //         this.AreYouWorkingWithBrokerInputAttr.setAttribute("required", "required");
        //         //$('#MMERGE8').attr("required", "required");

    //     } else {
    //         this.AreYouWorkingWithBrokerInput.classList.add("d-none");
    //         this.AreYouWorkingWithBrokerInput.classList.remove("d-block");
    //         this.AreYouWorkingWithBrokerInputAttr.removeAttribute("required", "required");
    //     }
    // }
}
export default FormValidations
// class FormValidations {
//     constructor() {
//         this.AreYouBroker = document.getElementById('AreYouBroker');
//         this.AreYouBrokerInput = document.getElementById('NOB');
//         this.AreYouBrokerInputAttr = document.getElementById('NameofBroker');
//         this.AreYouWorkingWithBroker = document.getElementById('AreyouWorkingWithBroker');
//         this.AreYouWorkingWithBrokerInput = document.getElementById('NOBRKG');
//         this.AreYouWorkingWithBrokerInputAttr = document.getElementById('WorkingWithBroker');
//         this.OnLoadEvent();
//     }
//     OnLoadEvent() {
//         this.AreYouBroker.addEventListener("change", () => this.AreYouBrokerAction())
//         this.AreYouWorkingWithBroker.addEventListener("change", () => this.AreYouWorkingWithBrokerAction())

//     }
//     AreYouBrokerAction() {
//         if ((this.AreYouBroker).value == 'Yes') {
//             this.AreYouBrokerInput.classList.add("d-block");
//             this.AreYouBrokerInput.classList.remove("d-none");
//             this.AreYouBrokerInputAttr.setAttribute("required", "required");
//             //$('#MMERGE8').attr("required", "required");

//         } else {
//             this.AreYouBrokerInput.classList.add("d-none");
//             this.AreYouBrokerInput.classList.remove("d-block");
//             this.AreYouBrokerInputAttr.removeAttribute("required", "required");
//         }
//     }
//     AreYouWorkingWithBrokerAction() {
//         if ((this.AreYouWorkingWithBroker).value == 'Yes') {
//             this.AreYouWorkingWithBrokerInput.classList.add("d-block");
//             this.AreYouWorkingWithBrokerInput.classList.remove("d-none");
//             this.AreYouWorkingWithBrokerInputAttr.setAttribute("required", "required");
//             //$('#MMERGE8').attr("required", "required");

//         } else {
//             this.AreYouWorkingWithBrokerInput.classList.add("d-none");
//             this.AreYouWorkingWithBrokerInput.classList.remove("d-block");
//             this.AreYouWorkingWithBrokerInputAttr.removeAttribute("required", "required");
//         }
//     }
// }
// export default FormValidations


// class FormValidations {
//     constructor() {
//         //alert("Testing Mobile Menu...");
//         //this.form_data = new FormData(document.querySelector("form"));
//         this.FormValidations()
//     }
//     FormValidations() {
//         var form_data = new FormData(document.querySelector("form"));
//         if (!form_data.has("group[14742][]")) {
//             document.getElementById("chk_option_error").style.visibility = "visible";
//             return false;
//         } else {
//             document.getElementById("chk_option_error").style.visibility = "hidden";
//             return true;
//         }
//     }
// }
// export default FormValidations