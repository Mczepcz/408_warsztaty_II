document.addEventListener("DOMContentLoaded",function(){
    var tweetInput = document.querySelector("#tweet");
    var counterDisplay = document.querySelector("#counter");
    
    tweetInput.addEventListener("keyup",function(event){
       counterDisplay.innerHTML = this.value.length;
    });
});