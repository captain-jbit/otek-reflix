function volumeToggle(button){
    var muted = $(".previewVideo").prop("muted");//get the property
    $(".previewVideo").prop("muted",!muted);

    //toggle the sound button
    $(button).find("i").toggleClass("fa-toggle-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnded(){
    $(".previewVideo").toggle();
    $(".previewImage").toggle();

}
