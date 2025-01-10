import $ from "jquery";
import "bootstrap";
import { gsap } from "gsap";
import "../styles/styles.css";
import GSAPScripts from "./modules/GSAPScripts.js";
import SiteNavigationBar from "./modules/SiteNavigationBar.js";
import CrouselSliderScript from "./modules/CrouselSliderScript.js";
import imageParallax from './modules/imageParallax.js';

import SimpleLightboxClass from './modules/simplelightbox.js';

// let GSAPScriptsVAr = new GSAPScripts();
let CrouselSliderScriptVar = new CrouselSliderScript();
let SiteNavigationBarVar = new SiteNavigationBar();
// let PanzoomVar = new Panzoom()
let simplelightboxVAr = new SimpleLightboxClass()

let imageParallaxVar = new imageParallax()

//let VideoScriptVar = new VideoScript()
//import VideoScript from './modules/VideoScript.js';

if (module.hot) {
    module.hot.accept();
}