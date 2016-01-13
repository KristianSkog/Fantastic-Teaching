//FORMATTING

$('input:button').click(function() {
    
    var myTextAreaValue = $('#my_textarea').val();
    var selectedText = getInputSelection($('#my_textarea'));
    var updatedText = '<'+$(this).val()+'>' + selectedText + '</'+$(this).val()+'>';
    myTextAreaValue = myTextAreaValue.replace(selectedText, updatedText);
    $('#my_textarea').val(myTextAreaValue)
});

function getInputSelection(elem){
 if(typeof elem != "undefined"){
  s=elem[0].selectionStart;
  e=elem[0].selectionEnd;
  return elem.val().substring(s, e);
 }else{
  return '';
 }
}


//LIVE PREVIEW

var wpcomment = document.getElementById('my_textarea');

wpcomment.onkeyup = wpcomment.onkeypress = function(){
    document.getElementById('preview').innerHTML = this.value;
}