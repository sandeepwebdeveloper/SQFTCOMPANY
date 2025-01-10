import $ from 'jquery';
class VideoScript {
    constructor() {
        //alert("Testing Mobile Menu...");
        this.videobtn = document.getElementById("myBtn");
        this.video = document.querySelector('#myVideo');
        this.OnClicktoggleMute()

    }
    OnClicktoggleMute() {
        this.videobtn.addEventListener("click", () => this.toggleMute())
    }
    toggleMute() {

        this.video.play();

        this.video.muted = !this.video.muted;

        var pause_video_img = "/wp-content/themes/unie/images/play-icon.png";
        var play_video_img = "/wp-content/themes/unie/images/pause-icon.png";
        if (this.video.muted) {
            //video.muted();
            //btn.innerHTML = "Pause";
            $("#myBtn img").attr("src", play_video_img);
        } else {
            //video.muted();
            //btn.innerHTML = "Play";
            $("#myBtn img").attr("src", pause_video_img);

        }
    }
}
export default VideoScript