
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // document.addEventListener("beforeunload", function() {
      //   modal.style.display = "none";

      // });



      // When the user clicks on <span> (x), close the modal
      span.addEventListener("click", (event) => {

        modal.style.display = "none";
        event.preventDefault();
      });

      function notDisplay() {

        var modalMessage = document.getElementById("modal_message");
        modalMessage.innerHTML = "";
        modal.style.display = "none";
        const event = new Event("preventDefault");
        event.preventDefault();
      }
      // Show the modal with a message

      function showError(message) {
        const modalMessage = document.getElementById("modal_message");
        modalMessage.innerHTML = message;
        modal.style.display = "block";
        console.log(message);
        const event = new Event("preventDefault");
        event.preventDefault();
      }
    