$(function(){
    $("#never").click(getQuestionsData);
    $("#rarely").click(getQuestionsData);
    $("#sometimes").click(getQuestionsData);
    $("#mostly").click(getQuestionsData);
    $("#always").click(getQuestionsData);
})

function getQuestionsData() {
    alert("hello");
    //window.location.href = "http://localhost/webPage/index.php/questionnairecontroller/home";
    // $("#container").load("http://localhost/PotluckCI/index.php/potluckcontroller/events/json")
}