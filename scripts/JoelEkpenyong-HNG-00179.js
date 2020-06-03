//object containing all my information
var ID = {
    fullName: "Joel Ekpenyong",
    HngID: "HNG-00179",
    lng: "javascript",
    email: "jayekpenyong0@gmail.com"
};
var text;

// concatenates the information and updates the text variable
function formText(){
    text = "Hello World, this is " + ID.fullName + " with HNGi7 ID " + ID.HngID + " and email " + ID.email + " using " + ID.lng + " for stage 2 task";
    return text;
};
//runs the function on page load printing the specified text to the console
window.onload = function(){
    console.log(formText());
};
