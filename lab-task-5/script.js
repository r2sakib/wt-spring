function analyzeText() 
{
    var text = document.getElementById("text").value;
    var length = text.length;
    var words = text.split(" ")
    var wordCount = words.length;
    var reversedText = text.split(' ').reverse().join(' ');
    var totalChar = document.getElementById("totalChar");
    totalChar.innerHTML = "Total Characters: " + length;
    var totalWords = document.getElementById("totalWords")
    totalWords.innerHTML = "Total Words: " + wordCount; 
    var result = document.getElementById("result");
    result.innerHTML = reversedText;
    result.setAttribute("src", "")
}