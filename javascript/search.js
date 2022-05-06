$(document).ready(function() {
  $("#send").click(function(event){
    var input = document.getElementById("search_input").value;

    if(input !== ""){
      $.get(
        "Buscador/search.php",
        { name: input,
          filters: " "},
        function(data) {
          
          if (data === "") {
            alert("No se han encontrado resultados");
            
          }else{
            $('#results').html(data);
            removeHiddenClass();
          }
  
        }
      );
    }else{
      alert("Ingrese alguna palabra");
    }
    
  });

});

function removeHiddenClass() {
  
  var element = document.getElementById("rsult");
  element.classList.remove("hidden");
  var element = document.getElementById("leftid");
  element.classList.remove("hidden");
}
