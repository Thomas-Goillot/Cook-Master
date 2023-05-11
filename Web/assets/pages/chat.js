$(document).ready(function () {
  
  var intId = null;
  
  async function displayConversation(idConversation) {
    await fetch("chat/displayConversation/" + idConversation)
      .then((response) => response.text())
      .then((html) => {
        $("#ConversationChatBox").html(html);

        $("#message").keypress(function (e) {
          if (e.which == 13) {
            $("#sendMessage").click();
          }
        });

        $("#sendMessage").on("click", async function () {
          let message = $("#message").val();

          if (message == "") {
            return;
          }

          $("#chatbox").append(`<div class="message user-1">${message}</div>`);
          
          await fetch("chat/sendMessage", {
            method: "POST",
            body: JSON.stringify({
              message: message,
              idConversation: idConversation,
            }),
            headers: {
              "Content-Type": "application/json",
            },
          }).then(() => {
            setTimeout(function () {
              $("#message").val("");
              objDiv = document.getElementById("chatbox");
              objDiv.scrollTop = objDiv.scrollHeight;
            }, 500);
          });
        });
      })
      .then(() => {
        objDiv = document.getElementById("chatbox");
        objDiv.scrollTop = objDiv.scrollHeight;
      })
      .catch((error) => console.error(error));
  }

  async function refreshConversation(idConversation) {
    await fetch("chat/refreshConversation/" + idConversation)
      .then((response) => response.text())
      .then((html) => $("#chatbox").html(html))
      .catch((error) => console.error(error));
  }

  $(".buttonDisplay").click(async function () {

    if (intId) {
      clearInterval(intId);
    }

    idConversation = $(this).data("idconversation");
    await displayConversation(idConversation);

    intId = setInterval(async function () {
      await refreshConversation(idConversation);
    }, 500);
  });
});
