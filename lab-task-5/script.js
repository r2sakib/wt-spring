function analyzeText() {
    var input = document.getElementById("input").value;

    var length = input.length;
    var words = input.split(" ")
    var wordCount = words.length;

    var inputReversed = input.split(' ').reverse().join(' ');

    var char = document.getElementById("char");
    char.innerHTML = "Total Characters: " + length;

    var words = document.getElementById("words")
    words.innerHTML = "Total Words: " + wordCount; 

    var output = document.getElementById("output");
    output.innerHTML = inputReversed;


}